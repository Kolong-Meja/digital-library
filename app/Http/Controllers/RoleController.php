<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Interfaces\RoleInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    protected RoleInterface $roleInterface;

    public function __construct(RoleInterface $roleInterface)
    {
        $this->roleInterface = $roleInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return $this->roleInterface->indexView();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $roleRequest): RedirectResponse
    {
        return $this->roleInterface->storeNewRole($roleRequest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        return $this->roleInterface->updateRecentRole($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        return $this->roleInterface->removeOneRoleById($id);
    }
}
