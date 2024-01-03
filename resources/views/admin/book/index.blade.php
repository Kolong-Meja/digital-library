@section('title')
    Books
@stop
@section('description')
    For manage books data.
@stop
<x-app-layout>
    @section('content')
        <div class="min-h-screen bg-gray-900">
            {{-- Create Role Modal --}}
            @include('components.book.create-book-modal')

            {{-- Update Role Modal --}}
            @include('components.book.update-book-modal')

            {{-- Header --}}
            <header class="bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                        {{ __('Books Table') }}
                    </h2>
                </div>
            </header>
            
            {{-- Main section --}}
            <main>
                <section class="py-12">
                    <div class="max-w-full mx-auto sm:px-6 lg:px-8">

                        @if (session()->has("success"))
                            <div class="flex items-center p-4 mb-4 text-sm text-gray-50 border border-none rounded-lg bg-green-600" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-bold">Success!</span> {{ session()->get("success") }}
                                </div>
                            </div>
                        @elseif (session()->has("error"))
                            <div class="container mx-auto">
                                <div class="flex items-center p-4 mb-4 text-sm text-gray-50 border border-none rounded-lg bg-red-500" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-bold">Not Permitted!</span> {{ session()->get("error") }}
                                    </div>
                                </div>  
                            </div> 
                        @endif

                        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                           
                            <div class="p-6 text-gray-100">
                                
                                {{-- Actions --}}
                                <div class="flex flex-row items-center justify-center md:items-center md:justify-start space-x-4 mb-4">
                                    <button 
                                    type="button" 
                                    class=" 
                                    underline 
                                    text-gray-100 
                                    hover:text-gray-300 
                                    transition-colors 
                                    duration-200 
                                    ease-in-out
                                    "
                                    data-modal-target="create-book-modal" 
                                    data-modal-toggle="create-book-modal"
                                    >
                                    Create new book
                                    </button>
                                    <button 
                                    type="button" 
                                    class=" 
                                    underline 
                                    text-gray-100 
                                    hover:text-gray-300 
                                    transition-colors 
                                    duration-200 
                                    ease-in-out
                                    "
                                    data-modal-target="update-book-modal" 
                                    data-modal-toggle="update-book-modal"
                                    >
                                    Update recent book
                                    </button>

                                    {{-- Export into PDF --}}
                                    <button 
                                        type="button" 
                                        class=" 
                                        underline 
                                        text-gray-100 
                                        hover:text-gray-300 
                                        transition-colors 
                                        duration-200 
                                        ease-in-out
                                        "
                                        >
                                        <a href="{{ route('book.view') }}">
                                            Export into PDF
                                        </a>
                                    {{-- Filter by category --}}
                                    <button 
                                    type="button" 
                                    id="dropdownRadioHelperButton" 
                                    data-dropdown-toggle="dropdownRadioHelper" 
                                    data-dropdown-placement="bottom"
                                    class="
                                    hidden
                                    md:flex 
                                    md:flex-row 
                                    md:items-center 
                                    md:justify-center 
                                    md:space-x-2 
                                    bg-green-500 
                                    p-2.5 
                                    rounded-lg 
                                    text-gray-900
                                    "
                                    >
                                        <p>Filter By Category</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-caret-down-fill w-3 h-3 text-gray-900" viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                        </svg>
                                    </button>

                                    {{-- Dropdown filter --}}
                                    <div id="dropdownRadioHelper" class="z-10 hidden shadow-xl bg-gray-700 rounded-lg w-60">
                                        <form autocomplete="on" action="{{ route('book.index') }}" method="GET" id="bookSearchForm" class="border-b border-gray-600">
                                            <div class="p-3">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                        </svg>
                                                    </div>
                                                    <input 
                                                    type="search" 
                                                    id="categorySearch" 
                                                    name="category" 
                                                    class="
                                                    block 
                                                    w-full 
                                                    p-2 
                                                    ps-10 
                                                    text-sm 
                                                    text-gray-100
                                                    border 
                                                    border-gray-500 
                                                    rounded-lg 
                                                    placeholder-gray-400
                                                    bg-gray-600 
                                                    focus:ring-green-500 
                                                    focus:border-green-500 
                                                    " 
                                                    placeholder="Search by category..."
                                                    />
                                                </div>
                                            </div> 
                                        </form>
                                        <form class="mt-2" autocomplete="on" action="{{ route('book.index') }}" method="GET" id="bookFilterForm">                                       
                                            <div class="flex items-center justify-center">
                                                <p class="text-sm font-semibold">Or pick one category</p>
                                            </div>
                                            <ul 
                                            id="categoryFilter"
                                            class="
                                            p-3 
                                            space-y-1 
                                            text-sm 
                                            text-gray-100 
                                            border-b-2 
                                            border-gray-600
                                            " 
                                            aria-labelledby="dropdownRadioHelperButton"
                                            >
                                                @foreach ($filterCategory as $category)
                                                    <li>
                                                        <div class="flex p-2 rounded hover:bg-gray-600">
                                                            <div class="flex items-center h-5">
                                                                <input 
                                                                id="filter-category-{{ $category->id }}" 
                                                                name="category" 
                                                                type="radio" 
                                                                value="{{ $category->name }}" 
                                                                class="
                                                                w-4 
                                                                h-4 
                                                                text-green-500 
                                                                bg-gray-600 
                                                                border-gray-500 
                                                                ring-offset-gray-700
                                                                focus:ring-green-500
                                                                focus:ring-offset-gray-700
                                                                focus:ring-2 
                                                                "
                                                                >
                                                            </div>
                                                            <div class="ms-2 text-sm">
                                                                <label for="filter-category-{{ $category->id }}" class="font-medium text-gray-100">{{ $category->name }}</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="p-2 flex justify-center">
                                                <button type="submit" id="submitSearchButton" class="bg-green-500 block p-2.5 w-full rounded-lg">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    {{-- Search by title --}}
                                    <form class="hidden md:flex md:items-center" autocomplete="on" action="{{ route('book.index') }}" method="GET">
                                        <div class="relative w-full">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input 
                                            type="search" 
                                            id="search" 
                                            name="search" 
                                            class="
                                            bg-gray-600
                                            border 
                                            border-gray-500
                                            text-gray-100
                                            text-sm 
                                            rounded-lg 
                                            focus:ring-green-400 
                                            focus:border-green-500 
                                            block 
                                            w-full 
                                            pl-10 
                                            p-2
                                            placeholder-gray-400
                                            " 
                                            placeholder="ID, ISBN, title, author..."
                                            >
                                        </div>
                                    </form>
                                </div>
                                <div class="overflow-x-auto w-max-full">
                                    <table class="min-w-full table-auto text-sm text-left text-gray-400">
                                        <thead class="text-sm text-gray-100 uppercase bg-gray-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">ID</th>
                                                <th scope="col" class="px-6 py-3">ISBN</th>
                                                <th scope="col" class="px-6 py-3">Author</th>
                                                <th scope="col" class="px-6 py-3">Title</th>
                                                <th scope="col" class="px-6 py-3">Description</th>
                                                <th scope="col" class="px-6 py-3">Synopsis</th>
                                                <th scope="col" class="px-6 py-3">Pages</th>
                                                <th scope="col" class="px-6 py-3">Publisher</th>
                                                <th scope="col" class="px-6 py-3">Published</th>
                                                <th scope="col" class="px-6 py-3">Status</th>
                                                <th scope="col" class="px-6 py-3">Modified At</th>
                                                <th scope="col" class="px-6 py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($books as $book)
                                                <tr 
                                                class="
                                                bg-transparent
                                                border-b 
                                                text-gray-100
                                                text-sm
                                                border-gray-700
                                                hover:bg-gray-700
                                                transition-colors
                                                duration-200
                                                ease-in-out
                                                "
                                                >
                                                    <td class="px-6 py-4">
                                                        <span class="font-semibold">{{ $book->id }}</span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $book->isbn }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $book->author_name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $book->title }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $book->description }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $book->synopsis }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $book->page_count }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $book->publisher }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $book->published }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @php
                                                            $statusAreaClass = ($book->status !== "displayed") ? "relative flex items-center bg-yellow-900 text-yellow-300 text-sm font-medium px-2.5 py-0.5 rounded-full" : "relative flex items-center bg-green-900 text-green-300 text-sm font-medium px-2.5 py-0.5 rounded-full";
                                                            $pingStatusClass = ($book->status !== "displayed") ? "animate-ping absolute inline-flex h-2 w-2 rounded-full bg-yellow-500 opacity-75" : "animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-500 opacity-75";
                                                            $circleDotStatusClass = ($book->status !== "displayed") ? "relative inline-flex rounded-full h-2 w-2 bg-yellow-500" : "relative inline-flex rounded-full h-2 w-2 bg-green-500";
                                                        @endphp
                                                        <span class="{{ $statusAreaClass }}">
                                                            <span class="{{ $pingStatusClass }}"></span>
                                                            <span class="{{ $circleDotStatusClass }}"></span>
                                                            <span class="ml-1">{{ $book->status }}</span>
                                                        </span>
                                                    </td>       
                                                    <td class="px-6 py-4">
                                                        {{ $book->updated_at }}
                                                    </td>                                           
                                                    <td class="px-6 py-4">
                                                        <form onsubmit="return confirm('Are you sure to remove this role?');" action="{{ route('book.delete', $book->id) }}" method="POST">
                                                            <div class="inline-flex shadow-sm gap-2" role="group">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="px-4 py-2 text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 hover:text-gray-900 transition-colors duration-300 ease-in-out focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-white">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <div 
                                                class="
                                                flex 
                                                items-center 
                                                p-4 mb-4 
                                                text-sm 
                                                bg-red-500
                                                text-gray-100
                                                rounded-lg 
                                                "
                                                role="alert"
                                                >
                                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                    </svg>
                                                    <span class="sr-only">Info</span>
                                                    <div class="text-sm">
                                                        <span class="font-bold">Danger alert!</span> Books table is empty, please create new one.
                                                    </div>
                                                </div>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{ $books->links('vendor.pagination.simple-tailwind') }}
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    @stop
</x-app-layout>