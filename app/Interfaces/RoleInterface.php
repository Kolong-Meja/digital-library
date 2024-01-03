<?php

namespace App\Interfaces;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

interface RoleInterface {
    public function indexView(): View;

    public function storeNewRole(RoleRequest $roleRequest): RedirectResponse;

    public function updateRecentRole(Request $request): RedirectResponse;

    public function removeOneRoleById(string $id): RedirectResponse;
}