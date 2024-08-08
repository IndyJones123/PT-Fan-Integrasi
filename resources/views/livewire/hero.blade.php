<div class="flex flex-col lg:flex-row gap-5 max-w-full mx-auto overflow-x-hidden">
    <div class="lg:flex-none lg:w-1/2 flex flex-col justify-center items-center max-w-full p-3 lg:gap-10 lg:items-start lg:ml-10">
        <div class="text-2xl text-black max-w-full text-center lg:text-start lg:text-7xl 2xl:text-8xl">
            <h1>Media buku terbaik</h1>
            <h2 class="text-red-400">untuk penulis</h2>
        </div>
        <div class="flex flex-row gap-3 text-lg text-black max-w-full mt-3">
            @auth
            <a class="font-semibold text-white bg-yellow-500 hover:bg-yellow-600 dark:bg-yellow-700 dark:hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('dashboard')}}">GET STARTED</a>
            @else
            <a class="font-semibold text-white bg-yellow-500 hover:bg-yellow-600 dark:bg-yellow-700 dark:hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('login')}}">GET STARTED</a>
            @endauth
            <a class="font-semibold text-white bg-yellow-500 hover:bg-yellow-600 dark:bg-yellow-700 dark:hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 px-4 py-2 rounded" href="{{route('collection.index')}}">BROWSE BOOKS</a>
        </div>
    </div>
    <div class="lg:flex-none lg:w-1/2 flex items-center justify-center max-w-full p-3">
        <img class="w-3/4 lg:w-7/12 lg:h-full mx-auto rounded-lg mt-3 max-w-full" src="https://images.unsplash.com/photo-1529158062015-cad636e205a0?q=80&w=1353&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
    </div>
</div>
