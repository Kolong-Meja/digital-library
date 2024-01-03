<?php

namespace App\Interfaces;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

interface CategoryInterface {
    public function indexView(): View;

    public function storeNewCategory(CategoryRequest $categoryRequest): RedirectResponse;

    public function updateRecentCategory(CategoryRequest $categoryRequest): RedirectResponse;

    public function removeOneCategoryById(string $id): RedirectResponse;
}