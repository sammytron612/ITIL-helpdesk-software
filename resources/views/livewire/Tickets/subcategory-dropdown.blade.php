<div>
    <label for="sub-category" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Select a sub
        category</label>
    <select id="sub-category" name="sub_category"
        class="mt-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected value="">Choose</option>
        @forelse($subCategories as $subCatergory)
            <option value="{{ $subCatergory->id }}">{{ $subCatergory->title }}</option>
        @empty
        @endforelse
    </select>
</div>
