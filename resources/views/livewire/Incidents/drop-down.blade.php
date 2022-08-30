<div  x-data="{open: false}" x-on:click="open = ! open" x-on:mouseleave="open = false">
    <div class="py-2">
        <div class="relative flex items-center space-x-1 text-sm font-medium cursor-pointer">
            <div class="p-5 pl-0 text-lg">{{$showing}}
                <svg class="inline-block w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
            <div class="absolute w-64 origin-top-right bg-white rounded-md shadow-lg z-33-right-24 top-14 ring-1 ring-black ring-opacity-5 focus:outline-none"
                x-show="open" x-cloak>
                <div class="py-1">
                    <button wire:click.defer='all' class="block px-4 py-1 text-left text-gray-700 text-md hover:text-blue-900">All
                        incidents</button>
                </div>
                <div class="py-1">
                    <button wire:click.defer='completed' class="block px-4 py-1 text-sm text-left text-gray-700 text-md hover:text-blue-900">Resolved incidents</button>
                </div>
                <div class="py-1">
                    <Button wire:click.defer='new'class="block px-4 py-1 text-sm text-gray-700 text-md hover:text-blue-900">All new
                        Incidents</button>
                </div>
                <div class="py-1">
                    <Button wire:click.defer='allOpen'class="block px-4 py-1 text-sm text-gray-700 text-md hover:text-blue-900">All Open
                        Incidents</button>
                </div>
                @if(Auth::user()->isAgent())
                    <div class="py-1">
                        <button wire:click.defer='sla' class="block px-4 py-1 text-sm text-left text-gray-700 text-md hover:text-blue-900">Incidents close to
                            SLA breach</button>
                    </div>
                @endif
                @if(Auth::user()->isAgent())
                    <div class="py-1">
                        <button wire:click.defer='me'class="block px-4 py-1 text-sm text-left text-gray-700 text-md hover:text-blue-900">Incidents assigned
                            to me</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

