<?php

namespace App\Repositories;

use App\Enums\UserStatus;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class UserRepository implements UserInterface {
    
    protected const MAX_PAGINATE = 10;

    /**
     * Display user index view page
     * 
     * @return Illuminate\View\View
     */
    public function indexView(): View
    {
        $searchRequest = request('search');
        $orderByStatusRequest = request('status');

        if (!$searchRequest && !$orderByStatusRequest) {
            $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select(
                'users.id', 
                'users.role_id', 
                'users.username', 
                'users.email', 
                'users.phone_number', 
                'users.address', 
                'users.last_login_at',
                'users.status',
                'users.updated_at',
                'roles.id AS roles_id',
                'roles.title AS role_title', 
            )
            ->paginate($this::MAX_PAGINATE);
        }

        if ($searchRequest) {
            $users = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->select(
                    'users.id', 
                    'users.role_id', 
                    'users.username', 
                    'users.email', 
                    'users.phone_number', 
                    'users.address', 
                    'users.last_login_at',
                    'users.status',
                    'users.updated_at',
                    'roles.id AS roles_id',
                    'roles.title AS role_title', 
                )
                ->when($searchRequest, function (Builder $query) use ($searchRequest) {
                    $query->where('users.id', 'ILIKE', '%' . $searchRequest . '%')
                        ->orWhere('users.username', 'ILIKE', '%' . $searchRequest . '%')
                        ->orWhere('users.email', 'ILIKE', '%' . $searchRequest . '%');
                })
                ->paginate($this::MAX_PAGINATE);
        }

        if ($orderByStatusRequest) {
            $users = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->select(
                    'users.id', 
                    'users.role_id', 
                    'users.username', 
                    'users.email', 
                    'users.phone_number', 
                    'users.address', 
                    'users.last_login_at',
                    'users.status',
                    'users.updated_at',
                    'roles.id AS roles_id',
                    'roles.title AS role_title', 
                )
                ->when($orderByStatusRequest, function (Builder $query) use ($orderByStatusRequest) {
                    $query->where('users.status', 'ILIKE', '%' . $orderByStatusRequest . '%');
                })
                ->paginate($this::MAX_PAGINATE);
        }

        $roles = DB::table('roles')
        ->select('id', 'title', 'status')
        ->get();

        return view('admin.user.index', compact('users', 'roles'));
    }

    /**
     * Store new user data
     * 
     * @param App\Http\Requests\UserRequest validate user data
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function storeNewUser(UserRequest $userRequest): RedirectResponse
    {
        $validatedData = $userRequest->validated();

        User::create([
            'role_id' => $userRequest->input('role'),
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make($validatedData['password']),
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'status' => UserStatus::OFFLINE,
        ]);

        session()->flash('success', 'User has been successfully created!');

        return redirect()->route('user.index');
    }

    /**
     * Store recent update of user data
     * 
     * @param Illuminate\Http\Request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function updateRecentUser(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id' => ['required', 'exists:users,id'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'unique:users,phone_number'],
            'address' => ['required', 'string'],
            'password' => ['required', 'string', Rules\Password::defaults()],
        ]);

        $userData = User::findOrFail($validatedData['id']);

        $userData->update([
            'role_id' => $request->input('role'),
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'password' => Hash::make($validatedData['password']),
        ]);

        session()->flash('success', 'User has been successfully updated!');

        return redirect()->route('user.index');
    }

    /**
     * Remove recent user by ID
     * 
     * @param string $id ID of the user
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function removeOneUserById(string $id): RedirectResponse
    {
        $userData = User::findOrFail($id);

        $userData->delete();

        session()->flash('success', 'User has been successfully removed!');
        
        return redirect()->route('user.index');
    }
}