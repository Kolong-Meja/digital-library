<?php

namespace App\Http\Controllers;

use App\Models\Book;
use DateTime;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $booksData = Book::with('categories')
            ->select('*')
            ->get();
        
        $publishedDate = "";
        
        foreach ($booksData as $bookData) {
            $publishedDate = DateTime::createFromFormat('Y-m-d H:i:s', $bookData->published);
        }

        return view('admin.dashboard', compact('booksData', 'publishedDate'));
    }
}
