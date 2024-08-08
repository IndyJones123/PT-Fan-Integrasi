<x-app-layout>
    <div class="py-3 m-10 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m-3 p-3 rounded-xl">
                <h1 class="text-black dark:text-white text-center"> Form Add New Book</h1>
    <form method="POST" action="{{ route('books.store') }}" id="form_book" class="mt-4" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-col gap-4 m-5 p-5">
        <div class=" ">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"  required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="hidden">
            <x-input-label for="author_id" :value="__('Author')" />
            <x-text-input id="author_id" class="block mt-1 w-full" type="number" name="author_id" value="{{ Auth::user()->id }}" required autocomplete="author_id" />
            <x-input-error :messages="$errors->get('author_id')" class="mt-2" />
        </div>

        <div class="">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text"  name="description"  required autocomplete="" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Rating Dropdown -->
        <div class=" ">
            <x-input-label for="rating" :value="__('Rating')" />
            <select id="rating" name="rating" class="block mt-1 w-full border rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ - Very Bad </option>
                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ - Bad </option>
                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ - Enough </option>
                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ - Good </option>
                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ - Very Good </option>
            </select>
            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
        </div>

        <div class="">
            <x-input-label for="thumbnail" :value="__('Thumbnail')" />
            <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png, " id="thumbnail" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500">
            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
        </div>


    </div>

    <div class="flex flex-col md:flex-row items-center justify-end mt-3 gap-2 mb-3">
        <div class="flex items-center ms-4">
            <input type="checkbox" id="termsCheckboxDosen" class="mr-2">
            <label for="termsCheckboxDosen" class="text-sm text-gray-600">I agree to the terms and conditions</label>
        </div>
        <x-primary-button id="storebooksCheckBox" class="ms-4 bg-gray-500 cursor-not-allowed" disabled>
            {{ __('Submit Book') }}
        </x-primary-button>
    </div>
</form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
            document.getElementById('termsCheckboxDosen').addEventListener('change', function() {
            if (this.checked) {
                storebooksCheckBox.disabled = false;
                storebooksCheckBox.classList.remove('bg-gray-500', 'cursor-not-allowed');
                storebooksCheckBox.classList.add('bg-indigo-500', 'cursor-pointer');
            } else {
                storebooksCheckBox.disabled = true;
                storebooksCheckBox.classList.remove('bg-indigo-500', 'cursor-pointer');
                storebooksCheckBox.classList.add('bg-gray-500', 'cursor-not-allowed');
            }
        });
</script>

