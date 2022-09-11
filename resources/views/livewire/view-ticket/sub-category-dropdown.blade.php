<div class="flex">
    <div x-data="{open: false}" @click="open = ! open" @click.outside="open = false">
        <div class="relative flex items-center font-bold cursor-pointer">
            <div class="font-bold text-1xl">{{$showing}}
                <svg class="inline-block w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
            <div class="absolute right-0 z-30 rounded-md shadow-lg bg-slate-300 top-7 focus:outline-none"
                x-show="open" x-transition.duration.400ms x-cloak>
                <div class="absolute -top-3 right-0 h-0 w-0 border-x-8 border-x-transparent border-b-[16px] border-slate-300"></div>
                <div class="py-1">

                    @foreach($sub_categories as $subcategory)
                        <div class="hover:bg-slate-200">
                            <button wire:click="updateSubCategory('{{$subcategory->id}}')" class="block px-8 py-2 text-sm text-gray-700 hover:text-blue-900">{{$subcategory->name}}
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
