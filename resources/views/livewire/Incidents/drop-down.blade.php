<div class="flex">
    <div class="py-2" x-data="{open: false}" @click="open = ! open" @mouseleave="open = false">
        <div class="relative flex items-center space-x-1 text-sm font-medium cursor-pointer">
            <div class="p-5 text-2xl">{{$showing}}..
                <svg class="inline-block w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
            <div class="absolute right-0 w-full origin-top-right bg-white rounded-md shadow-lg top-14 ring-1 ring-black ring-opacity-5 focus:outline-none"
                x-show="open" x-cloak>
                <div class="py-1">
                    <button wire:click='all' class="block px-4 py-2 text-sm text-left text-gray-700 hover:text-blue-900">All
                        incidents</button>
                </div>
                <div class="py-1">
                    <button wire:click='completed' class="block px-4 py-2 text-sm text-left text-gray-700 hover:text-blue-900">Resolved incidents</button>
                </div>
                <div class="py-1">
                    <Button wire:click='new'class="block px-4 py-2 text-sm text-gray-700 hover:text-blue-900">All new
                        Incidents</button>
                </div>
                <div class="py-1">
                    <button wire:click='sla' class="block px-4 py-2 text-sm text-left text-gray-700 hover:text-blue-900">Incidents close to
                        SLA breach</button>
                </div>
                <div class="py-1">
                    <button wire:click='me'class="block px-4 py-2 text-sm text-left text-gray-700 hover:text-blue-900">Incidents assigned
                        to me</button>
                </div>
            </div>
        </div>
    </div>
</div>

