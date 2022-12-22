<div x-data="{open: @entangle('show')}">
    <div wire:loading>
        <div class="justify-center w-8 h-8 mt-4 ml-16 border-b-2 border-blue-900 rounded-full animate-spin"></div>
    </div>
    <div wire:loading.remove x-show="open">
        <label for="sub-category" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Select a sub
            category @if($mandatory) <span class="ml-1 text-sm text-red-500">*</span> @endif
        </label>

        @error('sub_category')<span class="ml-1 text-xs text-red-600">{{ $message }}</span> @enderror


        <select id="sub-category" name="sub_category" wire:model="sub_category" @if($mandatory) required @endif
            class="mt-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected value="">Choose</option>
            @forelse($subCategories as $subCatergory)
                <option value="{{ $subCatergory->id }}">{{ $subCatergory->name }}</option>
            @empty
            @endforelse
        </select>
    </div>
</div>
