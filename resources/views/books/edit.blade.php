<x-app-layout>
    <div class="py-3 m-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m-3 p-5 rounded-xl">
                <h1 class="text-black dark:text-white text-center">Form Edit Book</h1>
                <form method="POST" action="{{ route('books.update', $book->id) }}" id="form_book" class="mt-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-4">
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $book->title }}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="hidden">
                            <x-input-label for="author_id" :value="__('Author')" />
                            <x-text-input id="author_id" class="block mt-1 w-full" type="number" name="author_id" value="{{ Auth::user()->id }}" required autocomplete="author_id" />
                            <x-input-error :messages="$errors->get('author_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $book->description }}" required autocomplete="" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="rating" :value="__('Rating')" />
                            <select id="rating" name="rating" class="block mt-1 w-full border rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="" disabled>Select a rating</option>
                                <option value="1" {{ old('rating', $book->rating) == 1 ? 'selected' : '' }}>⭐ - Very Bad</option>
                                <option value="2" {{ old('rating', $book->rating) == 2 ? 'selected' : '' }}>⭐⭐ - Bad</option>
                                <option value="3" {{ old('rating', $book->rating) == 3 ? 'selected' : '' }}>⭐⭐⭐ - Enough</option>
                                <option value="4" {{ old('rating', $book->rating) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ - Good</option>
                                <option value="5" {{ old('rating', $book->rating) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ - Very Good</option>
                            </select>
                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                            <div class="flex flex-col lg:flex-row gap-3 lg:gap-10">
                                <img class="w-20 h-20" src="{{ asset($book->thumbnail) }}" alt="">
                                <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png" id="thumbnail" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center justify-end mt-3 gap-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="termsCheckboxDosen" class="mr-2">
                            <label for="termsCheckboxDosen" class="text-sm text-gray-600">I agree to the terms and conditions</label>
                        </div>
                        <x-primary-button id="storebooksCheckBox" class="ms-4 bg-gray-500 cursor-not-allowed" disabled>
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('termsCheckboxDosen').addEventListener('change', function() {
            const submitButton = document.getElementById('storebooksCheckBox');
            if (this.checked) {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-500', 'cursor-not-allowed');
                submitButton.classList.add('bg-indigo-500', 'cursor-pointer');
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('bg-indigo-500', 'cursor-pointer');
                submitButton.classList.add('bg-gray-500', 'cursor-not-allowed');
            }
        });
    </script>
</x-app-layout>
