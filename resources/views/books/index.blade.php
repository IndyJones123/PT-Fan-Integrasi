<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-row lg:justify-center">
                        <form action="{{ route('books.index') }}" method="GET" class="flex flex-row">
                            <input type="text" id="search" name="search" value="{{ request()->input('search') }}" class="border rounded-lg py-2 px-4 w-full max-w-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black" placeholder="Search your books...">
                            <button type="submit" class="ml-2 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </form>
                        <div class="col-md-12">
                            <a href="{{ route('books.create') }}" class="ml-3 bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                                </svg> 
                                <h1 class="hidden lg:block">Add New Book</h1>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 m-5 lg:grid-cols-3">
                @foreach($books as $data)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg flex flex-col justify-between items-center">
                    <div class="flex flex-col lg:flex-row m-5 p-2 gap-3 justify-center lg:justify-start">
                        <div class="flex flex-col gap-5 justify-center lg:justify-start">
                            <img class="w-10 h-10 lg:w-20 lg:h-20 rounded-lg" src="{{ asset($data->thumbnail) }}" alt="">
                        </div>
                        <div class="flex flex-col gap-5 flex-1">
                            <p class="text-black dark:text-white text-xs truncate">Title: {{ $data->title }}</p>
                            <p class="text-black dark:text-white text-xs truncate">Author: {{ $data->author->name }}</p>
                            <p class="text-black dark:text-white text-xs overflow-hidden text-ellipsis" style="max-height: 3rem;">Description: {{ $data->description }}</p>
                            <p class="text-black dark:text-white text-xs">
                                Rating:  
                                @switch($data->rating)
                                    @case(1)
                                        ⭐★★★★
                                        @break
                                    @case(2)
                                        ⭐⭐★★★
                                        @break
                                    @case(3)
                                        ⭐⭐⭐★★
                                        @break
                                    @case(4)
                                        ⭐⭐⭐⭐★
                                        @break
                                    @case(5)
                                        ⭐⭐⭐⭐⭐
                                        @break
                                    @default
                                        No rating
                                @endswitch
                            </p>
                            <div class="flex flex-col lg:flex-row gap-2 mt-2">
                                <a href="{{ route('books.edit', $data->id) }}" class="text-xs font-semibold text-white bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 px-4 py-2 rounded">📝 Edit</a>
                                <form action="{{ route('books.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-white bg-red-500 hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 px-4 py-2 rounded">🗑️ Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="px-6 py-4 mb-8 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                <div>
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold text-black dark:text-black">{{ $books->total() }}</span> results
                    </p>
                </div>
                <div>
                    <div class="inline-flex gap-x-2">
                        <!-- Previous Page Button -->
                        @if($books->onFirstPage())
                            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" disabled>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"/></svg>
                                Prev
                            </button>
                        @else
                            <a href="{{ $books->previousPageUrl() }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"/></svg>
                                Prev
                            </a>
                        @endif

                        <!-- Next Page Button -->
                        @if($books->hasMorePages())
                            <a href="{{ $books->nextPageUrl() }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                                Next
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        @else
                            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" disabled>
                                Next
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"/></svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
