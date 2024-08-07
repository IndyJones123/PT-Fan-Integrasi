<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @if(Auth::user()->email_verified_at == null)
                <p>User is not authenticated</p>    
                @else
                    <p>User is authenticated</p>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
