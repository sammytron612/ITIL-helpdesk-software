
<div class="flex flex-col h-full md:flex-row md:flex-wrap">
    <div class="w-full p-2 pt-1 overflow-y-auto h-5/6 md:border-r border-stone-200 md:w-1/3">

         <label class="relative block">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <x-svg.magnify />
            </span>
            <input wire:model='searchTerm'
                class="w-full py-2 pl-10 pr-4 bg-white border rounded-full placeholder:font-italitc border-slate-300 focus:outline-none"
                placeholder="Search KB Articles" type="text" />
        </label>
        <!--<input class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model='searchTerm' placeholder="Search KB Articles" /> -->

        <div class="py-2 mt-2 border-t border-stone-200">
            <ul>

                @foreach($articles as $article)
                    <div x-data="{show: false}">
                        <li @click="tick" wire:click='choice({{$article->id}})' class="font-semibold hover:cursor-pointer">{{$article->title}}
                        <span wire:ignore class="hidden float-right ticks">
                            <x-svg.tick />
                        </span>
                        </li>
                    </div>
                @endforeach

            </ul>
        </div>
    </div>
    <div class="w-full p-2 overflow-y-auto border-t md:border-t-0 border-stone-200 h-5/6 md:w-2/3">
        @if($selected)
            {{$selected->body}}
        @endif
    </div>
    <div class="flex items-center w-full pt-1 border-t border-gray-300">
        @if($selected)<button x-on:click="kbOpen = false; insertKBlink('{{$selected?->title}}','http://kb.com',{{$commentId}})" wire:click="clearData" class="ml-3 btn-primary">Insert</button>@endif
        <button x-on:click="kbOpen = false;" wire:click="clearData" class="ml-3 btn-secondary">Cancel<button>
    </div>
</div>







