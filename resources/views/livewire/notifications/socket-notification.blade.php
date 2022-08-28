<div x-on:click.outside="dropDown = false" class="relative z-50" x-data="{dropDown: false}">
    <span x-on:click="dropDown = ! dropDown" class="relative inline-block hover:cursor-pointer">
        <x-svg.notification-bell />
        @if($count)<span class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 p-2 text-xs font-bold text-white bg-red-600 rounded-full 5-4">{{$count}}</span>@endif
    </span>
    @if($notifications)
        <div class="absolute bg-white border-black rounded-md shadow-lg w-[420px] md:w-[500px] right-3 top-9 focus:outline-none"
            x-show="dropDown" x-transition.duration.400ms x-cloak>
            <div class="absolute -top-3 right-0 h-0 w-0 border-x-8 border-x-transparent border-b-[16px] border-white"></div>
            <div class="w-full py-1">

            @foreach($notifications as $notification)
                <div class="flex items-center justify-between">

                    <button wire:click="gotoIncident({{$notification['incidentId']}}, {{$notification['id']}})" class="block w-full px-4 py-2 text-sm text-left text-gray-500 hover:text-black">{{$notification['message']}}</button>

                    <div class="ml-2 mr-2 text-red-700 hover:font-bold hover:text-red-500 hover:cursor-pointer" wire:click="removeNotification({{$notification['id']}})">X</div>
                </div>
            @endforeach
            </div>
        </div>
    @endif
</div>
