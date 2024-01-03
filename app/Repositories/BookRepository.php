<?php

namespace App\Repositories;

use App\Enums\BookStatus;
use App\Interfaces\BookInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;

class BookRepository implements BookInterface {
    
    protected const MAX_PAGINATE = 10;

    /**
     * Display book table
     * 
     * @return Illuminate\View\View
     */
    public function indexView(): View
    {
        $searchRequest = request('search');
        $categoryRequest = request('category');

        if (!$searchRequest && !$categoryRequest) {
            $books = Book::select('*')->paginate($this::MAX_PAGINATE); 
        }

        if ($searchRequest) {
            $books = Book::select('*')
                ->when($searchRequest, function (Builder $query) use ($searchRequest) {
                    $query->where('id', 'ILIKE', '%' . $searchRequest . '%')
                        ->orWhere('title', 'ILIKE', '%' . $searchRequest . '%')
                        ->orWhere('isbn', 'ILIKE', '%' . $searchRequest . '%')
                        ->orWhere('author_name', 'ILIKE', '%' . $searchRequest . '%');
                })->paginate($this::MAX_PAGINATE);
        }

        if ($categoryRequest) {
            $books = Book::with('categories')
            ->whereHas('categories', function (Builder $query) use ($categoryRequest) {
                $query->where('name', 'ILIKE', '%' . $categoryRequest . '%');
            })->paginate($this::MAX_PAGINATE);
        }

        // Categories data for filter
        $filterCategory = DB::table('categories')
        ->orderByDesc('created_at')
        ->limit(5)
        ->get(); 
        
        // Categories data for create modal
        $categories = DB::table('categories')->get();

        return view('admin.book.index', compact(
            'books', 
            'categories',
            'filterCategory',
        ));
    }

    /**
     * Store new book data
     * 
     * @param Illuminate\Http\Request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function storeNewBook(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'isbn' => ['required', 'string', 'max:13'],
            'image_cover' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:4096'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'synopsis' => ['required', 'string'],
            'page_count' => ['required', 'numeric'],
            'author_name' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'published' => ['required', 'date'],
            'uploaded_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:4096'],
        ]);

        // Upload image cover
        $uploadedImage = $request->file('image_cover');

        $getOriginalImageName = $uploadedImage->getClientOriginalName();

        $uploadedImage->move(public_path('images/'), $getOriginalImageName);

        // Upload file
        $uploadedFile = $request->file('uploaded_file');
        
        $getOriginalFileName = $uploadedFile->getClientOriginalName();

        $uploadedFile->move(public_path('files/'), $getOriginalFileName);

        $book = Book::create([
            'isbn' => $validatedData['isbn'],
            'image_cover' => $getOriginalImageName,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'synopsis' => $validatedData['synopsis'],
            'page_count' => $validatedData['page_count'],
            'author_name' => $validatedData['author_name'],
            'publisher' => $validatedData['publisher'],
            'published' => $validatedData['published'],
            'uploaded_file' => $getOriginalFileName,
            'status' => BookStatus::DISPLAYED,
        ]);

        $book->categories()->attach($request->input('categories'));

        session()->flash('success', 'Book has been successfully created!');

        return redirect()->route('book.index');
    }

    public function viewBookDataPdf(): mixed
    {
        $booksData = Book::select(
            'id',
            'isbn',
            'image_cover',
            'title',
            'description',
            'synopsis',
            'page_count',
            'author_name',
            'publisher',
            'published',
            'uploaded_file',
            'status',
            'updated_at'
        )->get();

        foreach ($booksData as $book) {
            $publishedDate = DateTime::createFromFormat('Y-m-d H:i:s', $book->published);
        }

        $pdfFile = Pdf::loadView('pdf.bookDetails', array(
            'booksData' => $booksData,
            'publishedDate' => $publishedDate
        ))
        ->setPaper('a4', 'landscape')
        ->save('books-reports.pdf');

        return $pdfFile->stream();
    }


    /**
     * Store updated book data
     * 
     * @param Illuminate\Http\Request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function updateRecentBook(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id' => ['required', 'exists:books,id'],
            'isbn' => ['required', 'string', 'max:13'],
            'image_cover' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:4096'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'synopsis' => ['required', 'string'],
            'page_count' => ['required', 'numeric'],
            'author_name' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'published' => ['required', 'date'],
            'uploaded_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:4096'],
            'status' => ['required', new Enum(BookStatus::class)],
        ]);

        $bookData = Book::findOrFail($validatedData['id']);

        // Upload image cover
        $uploadedImage = $request->file('image_cover');

        $getOriginalImageName = $uploadedImage->getClientOriginalName();

        $uploadedImage->move(public_path('images/'), $getOriginalImageName);

        // Upload file
        $uploadedFile = $request->file('uploaded_file');
        
        $getOriginalFileName = $uploadedFile->getClientOriginalName();

        $uploadedFile->move(public_path('files/'), $getOriginalFileName);

        $bookData->update([
            'isbn' => $validatedData['isbn'],
            'image_cover' => $getOriginalImageName,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'synopsis' => $validatedData['synopsis'],
            'page_count' => $validatedData['page_count'],
            'author_name' => $validatedData['author_name'],
            'publisher' => $validatedData['publisher'],
            'published' => $validatedData['published'],
            'uploaded_file' => $getOriginalFileName,
            'status' => $validatedData['status'],
        ]);

        if (!is_null($bookData->categories())) {
            $bookData->categories()->syncWithoutDetaching($request->input('categories'));
        } else {
            $bookData->categories()->attach($request->input('categories'));
        }

        session()->flash('success', 'Book data has been successfully updated!');

        return redirect()->route('book.index');
    }


    /**
     * Remove book data
     * 
     * @param string $id Book id
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function removeOneBookById(string $id): RedirectResponse
    {
        $bookData = Book::findOrFail($id);

        $bookData->delete();

        session()->flash('success', 'Book has been successfully removed!');
        
        return redirect()->route('book.index');
    }
}