@props(['key'])
<div id="kb-{{$key}}" x-transition.duration.500ms x-trap="kbOpen" x-show="kbOpen" class="absolute w-full h-[440px] -top-[490px] ">
    <div class="p-2 text-left text-white bg-gray-800 rounded-t-xl">KB Articles</div>
    <div class="h-full py-1 border rounded-b-xl border-slate-300 bg-gray-50">

        <div class="flex flex-col h-full md:flex-row md:flex-wrap">
            <div class="w-full p-2 pt-1 overflow-y-auto h-5/6 md:border-r border-stone-200 md:w-1/3">

                <label class="relative block">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <x-svg.magnify />
                    </span>
                    <input x-on:keydown.debounce="search" type="search" name="query" x-model="query"
                        class="w-full py-2 pl-10 pr-4 bg-white border rounded-full placeholder:font-italitc border-slate-300 focus:outline-none"
                        placeholder="Search KB Articles" type="text" />
                </label>
                <!--<input class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model='searchTerm' placeholder="Search KB Articles" /> -->

                <div class="py-2 mt-2 border-t border-stone-200">
                    <template x-for="article in articles" :key="article.id">

                        <div x-on:click="selectArticle(article.id,article.title);" class="hover:cursor-pointer" x-text="article.title"></div>

                    </template>
                </div>
            </div>
            <div class="w-full p-2 overflow-y-auto border-t md:border-t-0 border-stone-200 h-5/6 md:w-2/3">
                <div x-show="body" x-html="body">
                </div>
            </div>
            <div class="flex items-center w-full pt-1 border-t border-gray-300">
                <button x-show="body" x-on:click="clearData; kbOpen = false; insertKBlink(articleId,articleTitle,{{$key}});"  class="ml-3 btn-primary">Insert</button>
                <button x-on:click="clearData; kbOpen = false;" class="ml-3 btn-secondary">Cancel<button>
            </div>
        </div>

    </div>
</div>

