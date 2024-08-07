<x-app-layout>
    <div class="py-12">
        {{-- Responsive Mobile & PC --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-5 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col gap-5">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col ">
                    @if (Auth::user()->email_verified_at === null)
                        <p>Welcome, {{ Auth::user()->name }}</p>
                        <p>Your account has not been authenticated yet. <a class="text-blue-500 hover:text-blue-700 font-semibold underline" href="{{route("verification.notice")}}">Verify Now</a></p>
                        <div class="hidden lg:block">
                            <div class="flex flex-row gap-10 ">
                                <div class="flex flex-col gap-5 mt-5">
                                    <a class="text-2xl text-black dark:text-white font-semibold  bg-blue-500 hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('users.index')}}">Manage Data Users 👨🏻‍💻</a>
                                    <a class="text-2xl text-black dark:text-white font-semibold  bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('books.index')}}">Manage My Books 📚</a>
                                </div>
                                <div class="flex-none w-1/6"></div>
                                <img class="rounded-lg flex-1 lg:w-1/4 lg:h-1/4" src="https://plus.unsplash.com/premium_photo-1681487814165-018814e29155?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Unverified Account" class="w-full h-auto mt-4">
                            </div>
                        </div>
                                                                </div>
            </div>
            <img class="rounded-lg lg:hidden" src="https://plus.unsplash.com/premium_photo-1681487814165-018814e29155?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Unverified Account" class="w-full h-auto mt-4">
                    @else
                        <p>Welcome, {{ Auth::user()->name }}</p>
                        <p>Your account is already authenticated 👍</p>
                        <div class="hidden lg:block">
                            <div class="flex flex-row gap-10 ">
                                <div class="flex flex-col gap-5 mt-5">
                                    <a class="text-2xl text-black dark:text-white font-semibold  bg-blue-500 hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('users.index')}}">Manage Data Users 👨🏻‍💻</a>
                                    <a class="text-2xl text-black dark:text-white font-semibold  bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('books.index')}}">Manage My Books 📚</a>
                                </div>
                                <div class="flex-none w-1/6"></div>
                                <img class="rounded-lg flex-1 lg:w-1/4 lg:h-1/4" src="https://plus.unsplash.com/premium_photo-1683842188982-e2920f594fda?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Verified Account" class="w-full h-auto mt-4">
                            </div>
                        </div>
                        
                                        </div>
            </div>
            <img class="w-full h-auto mt-4 rounded-lg lg:w-1/2 lg:h-1/2 lg:hidden" src="https://plus.unsplash.com/premium_photo-1683842188982-e2920f594fda?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Verified Account">
                    @endif   

            
            <div class="flex flex-row ml-6 lg:hidden">
                <a class="text-2xl text-black dark:text-white font-semibold  bg-blue-500 hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('users.index')}}">Manage Data Users 👨🏻‍💻</a>
                <div class="w-1/6"></div>
            </div>
            <div class="flex flex-row ml-6 lg:hidden">
                <a class="text-2xl text-black dark:text-white font-semibold  bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('books.index')}}">Manage My Books 📚</a>
                <div class="w-1/6"></div>
            </div>
        </div>
    </div>
</x-app-layout>
