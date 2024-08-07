<div class="flex flex-row bg-dots-darker bg-center bg-white dark:bg-dots-lighter  selection:bg-red-500 selection:text-white">
    <div class="flex-none w-14 m-3 p-3">
        <img class="rounded-lg" src="{{ asset('/favicon.ico') }}" alt="Logo">
    </div>
    <div class="flex-none w-36 m-3 p-3 text-black">
        <a href="{{route("home")}}">PT FAN BOOKS</a>
    </div>
    <div class="flex-none w-36 m-3 p-3 text-black">
        <a href="">COLLECTION</a>
    </div>
    <div class="flex-1 m-3 p-3">
        <div class="flex justify-end items-end text-right">
            @if (Route::has('filament.user.pages.dashboard'))
                {{-- PC --}}
                <div class="hidden lg:block">
                    @auth
                        <a href="{{ route('dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-black dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            LOGIN
                        </a>
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-white bg-yellow-500 hover:bg-yellow-600 dark:bg-yellow-700 dark:hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 px-4 py-2 rounded">
                            SIGN UP FOR FREE
                        </a>
                    @endauth
                </div>

                {{-- Mobile --}}
                <div class="lg:hidden relative">
                    <button id="menuButton" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="menuItems" class="absolute right-0 mt-2 hidden bg-white shadow-lg dark:bg-gray-800">
                        @auth
                            <a href="{{ route('filament.user.pages.dashboard') }}" class="block px-4 py-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('filament.user.auth.login') }}" class="block px-4 py-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                LOGIN
                            </a>
                            <a href="{{ route('filament.user.auth.register') }}" class="block px-4 py-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                REGISTER
                            </a>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const menuItems = document.getElementById('menuItems');

        menuButton.addEventListener('click', function() {
            menuItems.classList.toggle('hidden');
        });
    });
</script>
