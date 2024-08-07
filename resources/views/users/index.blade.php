<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-row lg:justify-center">
                        <form action="{{ route('users.index') }}" method="GET" class="flex flex-row">
                            <input type="text" id="search" name="search" value="{{ request()->input('search') }}" class="border rounded-lg py-2 px-4 w-full max-w-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-black" placeholder="Search Users...">
                            <button type="submit" class="ml-2 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('users.index') }}" method="GET" class="">
                            <input type="hidden" name="search" value="{{ request()->input('search') }}">
                            <input type="hidden" name="email_verified" value="{{ request()->input('email_verified') == 'unverified' ? 'verified' : 'unverified' }}">
                            <button type="submit" class="ml-2 bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center">
                                
                                {{ request()->input('email_verified') == 'unverified' ? '🔓' : '🔒' }}
                            </button>
                        </form>   
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 m-5 lg:grid-cols-3">
                @foreach($users as $data)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg flex flex-col justify-center items-center text-center">
                    <img class="w-10 h-10" src="https://png.pngtree.com/png-vector/20220608/ourmid/pngtree-user-mysterious-anonymous-account-vector-png-image_4816288.png" alt="">
                    <p class="text-black dark:text-white text-xs">{{$data->name}}</p>
                    <p class="text-black dark:text-white text-xs">{{$data->email}}</p>
                    @if($data->email_verified_at == null)
                     <p class="text-black dark:text-white">🔒 Unverified</p>
                    @else
                     <p class="text-black dark:text-white">🔓 Verified</p>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
            <div>
                <p class="text-sm text-gray-600">
                <span class="font-semibold text-black dark:text-white">{{ $users->total() }}</span> results
                </p>
            </div>

            <div>
                <div class="inline-flex gap-x-2">
                <!-- Previous Page Button -->
                @if($users->onFirstPage())
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" disabled>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Prev
                    </button>
                @else
                    <a href="{{ $users->previousPageUrl() }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Prev
                    </a>
                @endif

                <!-- Next Page Button -->
                @if($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                    Next
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                @else
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" disabled>
                    Next
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                @endif
                </div>
            </div>
            </div>
            <!-- End Footer -->
        </div>
    </div>
</x-app-layout>
