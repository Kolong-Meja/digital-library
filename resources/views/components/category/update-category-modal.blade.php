<div id="update-category-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 bg-gray-800/50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        
        <!-- Modal content -->
        <div class="relative bg-gray-700 rounded-lg shadow-md">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update Recent Category
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="update-category-modal">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('category.update') }}" method="POST" autocomplete="on">
                @csrf
                @method('PUT')
                
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category ID</label>
                        <input 
                        type="text" 
                        name="id" 
                        id="id" 
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
                        placeholder="Category ID should be exist..." 
                        required />
                    </div>
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input 
                        type="text" 
                        name="name" 
                        id="name" 
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
                        autocomplete="name"
                        placeholder="Category name..." 
                        required 
                        />
                    </div>
                    <div class="col-span-2">
                        <label for="meta_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta Title</label>
                        <input 
                        type="text" 
                        name="meta_title" 
                        id="meta_title" 
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
                        placeholder="Meta title..." 
                        required 
                        />
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
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
                        placeholder="Description..."
                        required 
                        autofocus
                        ></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="meta_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta Description</label>
                        <textarea 
                        id="meta_description" 
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
                        name="meta_description" 
                        placeholder="Meta description..."
                        required 
                        autofocus
                        ></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-100">Select role status</label>
                        <select 
                        id="status" 
                        name="status" 
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
                            <option selected>Category status</option>
                            <option value="active">Active</option>
                            <option value="deprecated">Deprecated</option>
                        </select>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cloud-arrow-up-fill me-1 -ms-1 w-5 h-5" viewBox="0 0 16 16">
                        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Update recent category
                </button>
            </form>
        </div>
    </div>
</div> 