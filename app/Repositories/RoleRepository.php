<?php

namespace App\Repositories;

use App\Enums\RoleStatus;
use App\Http\Requests\RoleRequest;
use App\Interfaces\RoleInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleRepository implements RoleInterface {
    
    protected const MAX_PAGINATE = 10;

    /**
     * Role page view
     * 
     * @return Illuminate\View\View
     */
    public function indexView(): View
    {

        $searchRequest = request('title');
        $orderByStatusRequest = request('status');

        if (!$searchRequest && !$orderByStatusRequest) {
            $roles = Role::select('*')->paginate($this::MAX_PAGINATE);
        }

        if ($searchRequest) {
            $roles = Role::select('*')
                ->when($searchRequest, function (Builder $query) use ($searchRequest) {
                    $query->where('title', 'ILIKE', '%' . $searchRequest . '%');
                })->paginate($this::MAX_PAGINATE);
        }

        if ($orderByStatusRequest && $orderByStatusRequest !== "offline") {
            $roles = Role::select('*')
                ->when($orderByStatusRequest, function (Builder $query) use ($orderByStatusRequest) {
                    $query->where('status', 'ILIKE', '%' . $orderByStatusRequest . '%');
                })->paginate($this::MAX_PAGINATE);
        }

        if ($orderByStatusRequest && $orderByStatusRequest !== "online") {
            $roles = Role::select('*')
                ->when($orderByStatusRequest, function (Builder $query) use ($orderByStatusRequest) {
                    $query->where('status', 'ILIKE', '%' . $orderByStatusRequest . '%');
                })->paginate($this::MAX_PAGINATE);
        }

        return view('admin.role.index', compact('roles'));
    }

    /**
     * Store new role data.
     * 
     * @param App\Http\Requests\RoleRequest Request data for role
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function storeNewRole(RoleRequest $roleRequest): RedirectResponse
    {
        $validatedData = $roleRequest->validated();
        
        $abilitiesData = $roleRequest->has('abilities') ? $roleRequest->input('abilities') : [];
    
        $abilities = implode(", ", $abilitiesData);
    
        Role::create([
            'title' => $validatedData['title'],
            'abilities' => $abilities,
            'status' => RoleStatus::ACTIVE
        ]);
    
        session()->flash('success', 'Role has been successfully created!');
        
        return redirect()->route('role.index');
    }

    /**
     * Update recent role.
     * 
     * @param Illuminate\Http\Request Request data for role
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function updateRecentRole(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:roles,id',
            'title' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $roleData = Role::findOrFail($validatedData['id']);

        $abilitiesData = $request->has('abilities') ? $request->input('abilities') : [];
    
        $abilities = implode(", ", $abilitiesData);

        $roleData->update([
            'title' => $validatedData['title'],
            'abilities' => $abilities,
            'status' => $validatedData['status'],
        ]);

        session()->flash('success', 'Role has been successfully updated!');

        return redirect()->route('role.index');
    }

    /**
     * Remove recent role.
     * 
     * @param string $id role id that will be removed.
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function removeOneRoleById(string $id): RedirectResponse
    {
        $roleData = Role::findOrFail($id);

        $roleData->delete();

        session()->flash('success', 'Role has been successfully removed!');

        return redirect()->route('role.index');
    }
}