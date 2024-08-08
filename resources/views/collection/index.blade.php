@extends('layouts.anymous')

<body class="antialiased text-white">
    <livewire:navigation />
    <hr class="border-t mb-3 border-gray-300">
    <div class="bg-white-200">
        <div class="flex flex-col lg:flex-row gap-1 lg:gap-5 p-5">
            <div class="flex-1 lg:w-1/2 bg-gray-300 px-5 py-5 rounded-lg">
                <div class="flex flex-row gap-1">
                <!-- Search Form -->
                <form action="{{ route('collection.index') }}" method="GET" class="flex-1 w-3/4 mb-4">
                    <input type="text" id="search" name="search" value="{{ request()->input('search') }}" class="border rounded-lg py-2 px-4 w-full max-w-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black" placeholder="Search your books or author..." oninput="filterResults()">
                </form>
                </div>
             <!-- Rating Toggle Button -->
                <button id="ratingToggle" class="bg-blue-500 text-white  rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex-1 w-1/8 items-center">
                    ⭐
                </button>
                <div id="ratingFilter" class="hidden flex flex-col mt-2">
                    <select id="rating" name="rating" class="border rounded-lg py-2 px-4 w-full max-w-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black" onchange="filterResults()">
                        <option value="">Select Rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ request()->input('rating') == $i ? 'selected' : '' }}>
                                @for ($j = 1; $j <= 5; $j++)
                                    {!! $i >= $j ? '⭐' : '☆' !!}
                                @endfor
                                - {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Date Uploaded Toggle Button -->
                <button id="dateToggle" class="bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex-1 w-1/8 items-center mt-4">
                    📅
                </button>
                <div id="dateFilter" class="hidden flex flex-col mt-2">
                    <input type="date" id="date_uploaded" name="date_uploaded" value="{{ request()->input('date_uploaded') }}" class="border rounded-lg py-2 px-4 w-full max-w-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black" onchange="filterResults()">
                </div>

                </div>
            <div class="flex-1 lg:w-1/2 bg-gray-300 rounded-lg">
                <div class="grid grid-cols-2 gap-3 m-5 lg:grid-cols-3">
                    @foreach($books as $data)
                    <div class="bg-white  overflow-hidden shadow-sm rounded-lg flex flex-col items-center">
                        <div class="flex flex-col lg:flex-row m-5 p-2 gap-3  lg:justify-start">
                            <div class="flex flex-col gap-5 justify-center lg:justify-start">
                                <img class="w-20 h-20 lg:w-50 lg:h-50 rounded-lg justify-center lg:justify-start" src="{{ asset($data->thumbnail) }}" alt="">
                            </div>
                            <div class="flex flex-col gap-5 flex-1">
                                <p class="text-black text-xs ">Title: {{ $data->title }}</p>
                                <p class="text-black text-xs ">Author: {{ $data->author->name }}</p>
                                <p class="text-black text-xs">
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
                                <p class="text-black text-xs">Published : {{ $data->created_at->format('Y-m-d') }}</p>
                                <div class="flex flex-row lg:flex-row  mt-2 justify-center lg:justify-start">
                                    <form action="{{ route('collection.like', $data->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs font-semibold text-white bg-green-500 hover:bg-green-600 dark:bg-green-700 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 px-4 py-2 rounded">👍{{$data->like->count()}} Likes</button>
                                    </form>
                                    <form action="{{ route('collection.dislike', $data->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs font-semibold text-white bg-red-500 hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 px-4 py-2 rounded">👎{{$data->dislike->count()}} Dislikes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                <div>
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold text-black dark:text-white">{{ $books->total() }}</span> results
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
        
    </div>

    <script>
        // Toggle filter visibility
        document.getElementById('ratingToggle').addEventListener('click', function() {
            const ratingFilter = document.getElementById('ratingFilter');
            ratingFilter.classList.toggle('hidden');
        });

        document.getElementById('dateToggle').addEventListener('click', function() {
            const dateFilter = document.getElementById('dateFilter');
            dateFilter.classList.toggle('hidden');
        });

        // Filter results dynamically
        function filterResults() {
            const search = document.getElementById('search').value;
            const rating = document.getElementById('rating') ? document.getElementById('rating').value : '';
            const dateUploaded = document.getElementById('date_uploaded') ? document.getElementById('date_uploaded').value : '';

            const url = new URL(window.location.href);
            url.searchParams.set('search', search);
            url.searchParams.set('rating', rating);
            url.searchParams.set('date_uploaded', dateUploaded);
            window.location.href = url.toString();
        }
    </script>
</body>

<script>
    $('form').on('submit', function(e) {
    e.preventDefault();
    const form = $(this);
    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function(response) {
            // Update the like/dislike count or the part of the page where counts are displayed
            location.reload();  // Simple way to reload the page to reflect changes
        }
    });
});

</script>


