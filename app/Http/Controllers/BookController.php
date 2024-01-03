<?php

namespace App\Http\Controllers;

use App\Interfaces\BookInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    protected BookInterface $bookInterface;

    public function __construct(BookInterface $bookInterface)
    {
        $this->bookInterface = $bookInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return $this->bookInterface->indexView();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        return $this->bookInterface->storeNewBook($request);
    }

    /**
     * Display the specified resource.
     */
    public function view(): mixed
    {
        return $this->bookInterface->viewBookDataPdf();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        return $this->bookInterface->updateRecentBook($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        return $this->bookInterface->removeOneBookById($id);
    }
}
