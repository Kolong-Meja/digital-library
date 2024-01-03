<?php

namespace App\Interfaces;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

interface BookInterface {
    public function indexView(): View;

    public function storeNewBook(Request $request): RedirectResponse;

    public function viewBookDataPdf(): mixed; 

    public function updateRecentBook(Request $request): RedirectResponse;

    public function removeOneBookById(string $id): RedirectResponse;
}