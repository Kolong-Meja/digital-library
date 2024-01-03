@section('title')
    Categories
@stop
@section('description')
    For manage book categories data.
@stop
<x-app-layout>
    @section('content')
        <div class="min-h-screen bg-gray-900">
            {{-- Create Role Modal --}}
            @include('components.category.create-category-modal')

            {{-- Update Role Modal --}}
            @include('components.category.update-category-modal')

            {{-- Header --}}
            <header class="bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                        {{ __('Categories Table') }}
                    </h2>
                </div>
            </header>
            
            {{-- Main section --}}
            <main>
                <section class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                <div class="flex flex-row space-x-4 mb-4">
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
                                    data-modal-target="create-category-modal" 
                                    data-modal-toggle="create-category-modal"
                                    >
                                    Create new category
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
                                    data-modal-target="update-category-modal" 
                                    data-modal-toggle="update-category-modal"
                                    >
                                    Update recent category
                                    </button>
                                    
                                    {{-- Filter --}}
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
                                    px-2.5
                                    py-1 
                                    rounded-lg 
                                    text-gray-900
                                    "
                                    >
                                        <p>Filter</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-caret-down-fill w-3 h-3 text-gray-900" viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                        </svg>
                                    </button>
                                    <div id="dropdownRadioHelper" class="z-10 hidden shadow-xl bg-gray-700 rounded-lg w-60">
                                        <form autocomplete="on" action="{{ route('category.index') }}" method="GET" id="categorySearchForm" class="border-b border-gray-600">
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
                                                    name="search" 
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
                                                    placeholder="Search by ID, name..."
                                                    />
                                                </div>
                                            </div> 
                                        </form>
                                        <form class="mt-2" autocomplete="on" action="{{ route('category.index') }}" method="GET" id="categoryFilterForm">                                       
                                            </ul>
                                            <div class="flex items-center justify-center">
                                                <p class="text-sm font-semibold">Or filter by status</p>
                                            </div>
                                            <ul 
                                            id="categoryStatusOrderFilter"
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
                                                {{-- Status order --}}
                                                <li>
                                                    <div class="flex p-2 rounded hover:bg-gray-600">
                                                        <div class="flex items-center h-5">
                                                            <input 
                                                            id="order-category-deprecated" 
                                                            name="status" 
                                                            type="radio" 
                                                            value="deprecated" 
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
                                                            <label for="order-category-deprecated" class="font-medium text-gray-100">deprecated</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex p-2 rounded hover:bg-gray-600">
                                                        <div class="flex items-center h-5">
                                                            <input 
                                                            id="order-category-active" 
                                                            name="status" 
                                                            type="radio" 
                                                            value="active" 
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
                                                            <label for="order-category-active" class="font-medium text-gray-100">active</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="p-2 flex justify-center">
                                                <button type="submit" id="submitSearchButton" class="bg-green-500 block p-2.5 w-full rounded-lg">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="overflow-x-auto w-max-full">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead class="text-sm text-gray-100 uppercase bg-gray-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">ID</th>
                                                <th scope="col" class="px-6 py-3">Name</th>
                                                <th scope="col" class="px-6 py-3">Meta Title</th>
                                                <th scope="col" class="px-6 py-3">Description</th>
                                                <th scope="col" class="px-6 py-3">Meta Description</th>
                                                <th scope="col" class="px-6 py-3">Status</th>
                                                <th scope="col" class="px-6 py-3">Modified At</th>
                                                <th scope="col" class="px-6 py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $category)
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
                                                        <span class="font-semibold">{{ $category->id }}</span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $category->name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $category->meta_title }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $category->description }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $category->meta_description }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @php
                                                            $statusAreaClass = ($category->status !== 'active') 
                                                            ? "
                                                            relative 
                                                            flex 
                                                            items-center 
                                                            bg-red-900 
                                                            text-red-300 
                                                            text-sm 
                                                            font-medium 
                                                            px-2.5 py-0.5 
                                                            rounded-full
                                                            " : "
                                                            relative 
                                                            flex 
                                                            items-center 
                                                            bg-green-900
                                                            text-green-300 
                                                            text-sm 
                                                            font-medium 
                                                            px-2.5 py-0.5 
                                                            rounded-full
                                                            ";

                                                            $pingStatusClass = ($category->status !== "active") 
                                                            ? "
                                                            animate-ping 
                                                            absolute 
                                                            inline-flex 
                                                            h-2 w-2 
                                                            rounded-full 
                                                            bg-red-500 
                                                            opacity-75
                                                            " : "
                                                            animate-ping 
                                                            absolute 
                                                            inline-flex 
                                                            h-2 w-2 
                                                            rounded-full 
                                                            bg-green-500
                                                            opacity-75
                                                            ";

                                                            $circleDotStatusClass = ($category->status !== "active")
                                                            ? "
                                                            relative 
                                                            inline-flex 
                                                            rounded-full 
                                                            h-2 w-2 
                                                            bg-red-500
                                                            " : "
                                                            relative 
                                                            inline-flex 
                                                            rounded-full 
                                                            h-2 w-2 
                                                            bg-green-500
                                                            ";
                                                        @endphp
                                                        <span class="{{ $statusAreaClass }}">
                                                            <span class="{{ $pingStatusClass }}"></span>
                                                            <span class="{{ $circleDotStatusClass }}"></span>
                                                            <span class="ml-1">{{ $category->status }}</span>
                                                        </span>
                                                    </td>                                                  
                                                    <td class="px-6 py-4">
                                                        {{ $category->updated_at }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <form onsubmit="return confirm('Are you sure to remove this role?');" action="{{ route('category.delete', $category->id) }}" method="POST">
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
                                                        <span class="font-bold">Danger alert!</span> Categories table is empty, please create new one.
                                                    </div>
                                                </div>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{ $categories->links('vendor.pagination.simple-tailwind') }}
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    @stop
</x-app-layout>