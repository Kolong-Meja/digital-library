<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

interface UserInterface {
    public function indexView(): View;

    public function storeNewUser(UserRequest $userRequest): RedirectResponse;
    
    public function updateRecentUser(Request $userRequest): RedirectResponse;

    public function removeOneUserById(string $id): RedirectResponse;
}