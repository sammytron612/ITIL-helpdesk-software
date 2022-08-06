<div x-data="{open: false}" @update-success.window="open = true, setTimeout(() => open = false, 4000)">
    <div x-transition:enter="transition ease-out duration-1000" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
             x-show="open"
        class="fixed right-0 top-32">
        <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-700 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-gray-800 bg-green-400 rounded-lg dark:bg-green-900 dark:text-green-200">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 font-bold text-1xl">Incident updated successfully.</div>
        </div>
    </div>
</div>