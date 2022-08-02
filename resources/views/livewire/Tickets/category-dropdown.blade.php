<div>
    <label for="category" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Select a category
        <span class="ml-1 text-xs text-red-500">*</span>
        @error('category')
            <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
        @enderror
    </label>
    <select wire:model='category'id="category" name="category" required
        class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected value="">Choose</option>
        @foreach($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->title}}</option>
        @endforeach

    </select>
</div>

