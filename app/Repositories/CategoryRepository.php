<?php

namespace App\Repositories;

use App\Enums\CategoryStatus;
use App\Interfaces\CategoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryRepository implements CategoryInterface {
    
    protected const MAX_PAGINATE = 10;

    /**
     * Display category table view
     * 
     * @return Illuminate\View\View
     */
    public function indexView(): View
    {
        $searchRequest = request('search');
        $orderByStatusRequest = request('status');

        if (!$searchRequest && !$orderByStatusRequest) {
            $categories = DB::table('categories')
            ->select(
                'id',
                'name', 
                'meta_title',
                'description',
                'meta_description',
                'status',
                'updated_at',
            )
            ->paginate($this::MAX_PAGINATE);
        }

        if ($searchRequest) {
            $categories = DB::table('categories')
            ->select(
                'id',
                'name', 
                'meta_title',
                'description',
                'meta_description',
                'status',
                'updated_at',
            )->when($searchRequest, function (Builder $query) use ($searchRequest) {
                $query->where('id', 'ILIKE', '%' . $searchRequest . '%')
                ->orWhere('name', 'ILIKE', '%' . $searchRequest . '%');
            })
            ->paginate($this::MAX_PAGINATE);
        }

        if ($orderByStatusRequest) {
            $categories = DB::table('categories')
            ->select(
                'id',
                'name', 
                'meta_title',
                'description',
                'meta_description',
                'status',
                'updated_at',
            )->when($orderByStatusRequest, function (Builder $query) use ($orderByStatusRequest) {
                $query->where('status', 'ILIKE', '%' . $orderByStatusRequest . '%');
            })
            ->paginate($this::MAX_PAGINATE);
        }
        
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Store new category data
     * 
     * @param App\Http\Requests\CategoryRequest
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function storeNewCategory(CategoryRequest $categoryRequest): RedirectResponse
    {
        $validatedData = $categoryRequest->validated();

        Category::create([
            'name' => $validatedData['name'],
            'meta_title' => $validatedData['meta_title'],
            'description' => $validatedData['description'],
            'meta_description' => $validatedData['meta_description'],
            'status' => CategoryStatus::ACTIVE,
        ]);

        session()->flash('success', 'Category has been successfully created!');

        return redirect()->route('category.index');
    }

    /**
     * Store updated category data
     * 
     * @param Illuminate\Http\Request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function updateRecentCategory(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'meta_title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'meta_description' => ['required', 'string'],
            'status' =>  ['required', 'string', 'max:255'],
        ]);

        $categoryData = Category::findOrFail($validatedData['id']);

        $categoryData->update([
            'name' => $validatedData['name'],
            'meta_title' => $validatedData['meta_title'],
            'description' => $validatedData['description'],
            'meta_description' => $validatedData['meta_description'],
            'status' => $validatedData['status'], 
        ]);

        session()->flash('success', 'Category has been successfully updated!');

        return redirect()->route('category.index');
    }

    /**
     * Remove recent category data
     * 
     * @param string $id Category id
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function removeOneCategoryById(string $id): RedirectResponse
    {
        $recentCategory = Category::findOrFail($id);

        $recentCategory->delete();

        session()->flash('success', 'Category has been successfully removed!');
        
        return redirect()->route('category.index');
    }
}