@section('title')
    Dashboard
@stop
@section('description')
    For analyst data purpose.
@stop
<x-app-layout>
    @section('content')
        <header class="bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </header>

        <div class="py-12">
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
                
                <h1 class="text-gray-100 text-3xl font-semibold text-center mb-6">List of Books</h1>
                <div class="grid grid-cols-1 px-5 md:grid-cols-3 md:px-0 gap-4">
                    @forelse ($booksData as $bookData)
                        <div class="max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg" src="{{ asset('images/'. $bookData->image_cover) }}" alt="Book image cover"/>
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $bookData->title }}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-400">{{ $bookData->synopsis }}</p>
                                <p class="mb-3 font-normal text-gray-100"><span class="font-semibold">Author:</span> {{ $bookData->author_name }}</p>
                                <p class="mb-3 font-normal text-gray-100"><span class="font-semibold">Published:</span> {{ $publishedDate->format('Y-m-d') }}</p>
                                <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    View Detail
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </div>
    @stop
</x-app-layout>
