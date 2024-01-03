<div id="create-book-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 bg-gray-800/50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        
        <!-- Modal content -->
        <div class="relative bg-gray-700 rounded-lg shadow-md">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-100">
                    Create New Book
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="create-book-modal">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="categories" class="block mb-2 text-sm font-medium text-gray-100">Select category</label>
                        <select
                        multiple 
                        id="categories" 
                        name="categories[]" 
                        class="
                        bg-gray-700
                        border 
                        border-gray-600 
                        text-gray-100
                        text-sm 
                        rounded-lg 
                        focus:ring-green-500 
                        focus:border-green-500 
                        block 
                        w-full 
                        p-2.5 
                        "
                        >
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="isbn" class="block mb-2 text-sm font-medium text-gray-100">ISBN</label>
                        <input 
                        type="text" 
                        name="isbn" 
                        id="isbn" 
                        class="
                        bg-gray-600
                        border 
                        border-gray-500 
                        text-gray-100 
                        placeholder-gray-400
                        text-sm 
                        rounded-lg 
                        focus:ring-green-400
                        focus:border-green-500 
                        block w-full p-2.5  
                        "
                        placeholder="ISBN number..." 
                        required />
                    </div>
                    <div class="col-span-2">
                        <label for="image_cover" class="block mb-2 text-sm font-medium text-gray-100">Image Cover</label>
                        <input 
                        class="
                        block 
                        w-full 
                        text-sm 
                        text-gray-400 
                        border 
                        border-gray-500 
                        rounded-lg 
                        cursor-pointer 
                        bg-gray-600
                        focus:outline-none 
                        placeholder-gray-400" 
                        aria-describedby="file_input_help" 
                        id="image_cover"
                        name="image_cover" 
                        type="file"
                        required
                        >
                    </div>
                    <div class="col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-100">Title</label>
                        <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="
                        bg-gray-600
                        border 
                        border-gray-500 
                        text-gray-100 
                        placeholder-gray-400
                        text-sm 
                        rounded-lg 
                        focus:ring-green-400
                        focus:border-green-500 
                        block w-full p-2.5  
                        "
                        placeholder="Book title..." 
                        required />
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-100">Description</label>
                        <textarea 
                        id="description" 
                        class="
                        block 
                        p-2.5 
                        w-full
                        text-gray-100
                        bg-gray-600
                        border-gray-500 
                        focus:border-green-500
                        focus:ring-green-400
                        placeholder-gray-400
                        rounded-lg
                        " 
                        type="text" 
                        name="description" 
                        placeholder="Description"
                        required 
                        autofocus
                        ></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="synopsis" class="block mb-2 text-sm font-medium text-gray-100">Synopsis</label>
                        <textarea 
                        id="synopsis" 
                        class="
                        block 
                        p-2.5 
                        w-full
                        text-gray-100
                        bg-gray-600
                        border-gray-500 
                        focus:border-green-500
                        focus:ring-green-400
                        placeholder-gray-400
                        rounded-lg
                        " 
                        type="text" 
                        name="synopsis" 
                        placeholder="Synopsis"
                        required 
                        autofocus
                        ></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="page_count" class="block mb-2 text-sm font-medium text-gray-100">Pages</label>
                        <input 
                        type="number" 
                        id="page_count"
                        name="page_count" 
                        aria-describedby="helper-text-explanation" 
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
                        p-2.5 
                        placholder-gray-400
                        "
                        placeholder="0" 
                        required
                        />
                    </div>
                    <div class="col-span-2">
                        <label for="author_name" class="block mb-2 text-sm font-medium text-gray-100">Author</label>
                        <input 
                        type="text" 
                        name="author_name" 
                        id="author_name" 
                        class="
                        bg-gray-600
                        border 
                        border-gray-500 
                        text-gray-100 
                        placeholder-gray-400
                        text-sm 
                        rounded-lg 
                        focus:ring-green-400
                        focus:border-green-500 
                        block w-full p-2.5  
                        "
                        placeholder="Author name" 
                        required
                        autocomplete="name" 
                        />
                    </div>
                    <div class="col-span-2">
                        <label for="publisher" class="block mb-2 text-sm font-medium text-gray-100">Publisher</label>
                        <input 
                        type="text" 
                        name="publisher" 
                        id="publisher" 
                        class="
                        bg-gray-600
                        border 
                        border-gray-500 
                        text-gray-100 
                        placeholder-gray-400
                        text-sm 
                        rounded-lg 
                        focus:ring-green-400
                        focus:border-green-500 
                        block w-full p-2.5  
                        "
                        placeholder="Publisher" 
                        required 
                        />
                    </div> 
                    <div class="col-span-2">
                        <label for="published" class="block mb-2 text-sm font-medium text-gray-100">Published Date</label>
                        <input 
                        type="date" 
                        name="published" 
                        id="published" 
                        class="
                        bg-gray-600
                        border 
                        border-gray-500 
                        text-gray-100 
                        placeholder-gray-400
                        text-sm 
                        rounded-lg 
                        focus:ring-green-400
                        focus:border-green-500 
                        block w-full p-2.5  
                        "
                        placeholder="mm/dd/yyyy" 
                        required 
                        />
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-100" for="uploaded_file">Upload file <span class="text-xs">(optional)</span></label>
                        <input 
                        class="
                        block 
                        w-full 
                        text-sm 
                        text-gray-400 
                        border 
                        border-gray-500 
                        rounded-lg 
                        cursor-pointer 
                        bg-gray-600
                        focus:outline-none 
                        placeholder-gray-400" 
                        aria-describedby="file_input_help" 
                        id="uploaded_file"
                        name="uploaded_file" 
                        type="file"
                        required
                        >
                    </div>
                </div>
                <button 
                type="submit" 
                class="
                text-gray-100
                inline-flex 
                items-center 
                bg-green-600
                font-medium 
                rounded-lg 
                text-sm 
                px-5 py-2.5 
                text-center 
                hover:bg-green-400 
                hover:text-gray-700
                focus:ring-4 
                focus:outline-none 
                focus:ring-green-500 
                transition-colors
                duration-200
                ease-in-out
                "
                >
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new book
                </button>
            </form>
        </div>
    </div>
</div> 