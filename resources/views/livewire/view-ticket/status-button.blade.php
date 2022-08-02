<div class="mt-4">
    <label class="font-bold" for="ticket-status">Status</label>
    {{ $chosenStatus }}
    <select wire:model="chosenStatus" id="ticket-status" class="{{ $class }}">
        @foreach($statuses as $status)
            <option class="bg-white" value="{{ $status->id }}">{{ $status->status }}</option>
        @endforeach
    </select>

</div>
<!--
<div class="relative flex items-center space-x-1 font-medium cursor-pointer">
        <span class="mr-2 font-bold text-1xl">Status</span>
        <button @click="open = ! open" class="px-3 py-0.5 mt-3 mb-3 hover:bg-blue-300 text-slate-gray-800 bg-blue-100 border  border-blue-300 rounded-lg">{{$status}}
            <svg class="inline-block w-6 h-4 pl-2 ml-5 border-l-2 border-slate-400" aria-hidden="true" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div class="absolute z-50 w-1/3 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 focus:outline-none"
            x-show="open" x-cloak>
            @foreach($statuses as $status)
                <ul>
                    <li class="block px-4 py-2 text-base font-bold text-left text-gray-700 hover:bg-blue-100">{{ $status->status }}</li>
                </ul>
            @endforeach
        </div>
    </div>
-->
