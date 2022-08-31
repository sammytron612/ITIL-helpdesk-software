
<div class="flex flex-col h-full md:flex-row md:flex-wrap">
    <div class="w-full p-2 pt-1 overflow-y-auto h-5/6 md:border-r border-stone-200 md:w-1/3">

         <label class="relative block">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 fill-black" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30"
                    height="30" viewBox="0 0 30 30">
                    <path
                        d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
                    </path>
                </svg>
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
                            <svg style="color: rgb(54, 206, 92);" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="16" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="id1"><path d="M 2.328125 4.222656 L 27.734375 4.222656 L 27.734375 24.542969 L 2.328125 24.542969 Z M 2.328125 4.222656 " clip-rule="nonzero" fill="#36ce5c"></path></clipPath></defs><g clip-path="url(#id1)"><path fill="#36ce5c" d="M 27.5 7.53125 L 24.464844 4.542969 C 24.15625 4.238281 23.65625 4.238281 23.347656 4.542969 L 11.035156 16.667969 L 6.824219 12.523438 C 6.527344 12.230469 6 12.230469 5.703125 12.523438 L 2.640625 15.539062 C 2.332031 15.84375 2.332031 16.335938 2.640625 16.640625 L 10.445312 24.324219 C 10.59375 24.472656 10.796875 24.554688 11.007812 24.554688 C 11.214844 24.554688 11.417969 24.472656 11.566406 24.324219 L 27.5 8.632812 C 27.648438 8.488281 27.734375 8.289062 27.734375 8.082031 C 27.734375 7.875 27.648438 7.679688 27.5 7.53125 Z M 27.5 7.53125 " fill-opacity="1" fill-rule="nonzero"></path></g></svg>
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







