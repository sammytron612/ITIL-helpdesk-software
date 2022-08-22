<div x-on:click.outside="dropDown = false" class="relative z-50" x-data="{dropDown: false}">
    <span x-on:click="dropDown = ! dropDown" class="relative inline-block hover:cursor-pointer">
        <svg viewBox="0 0 512 512" height="36px" width="36px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512"><path d="M381.7 225.9c0-97.6-52.5-130.8-101.6-138.2 0-.5.1-1 .1-1.6 0-12.3-10.9-22.1-24.2-22.1-13.3 0-23.8 9.8-23.8 22.1 0 .6 0 1.1.1 1.6-49.2 7.5-102 40.8-102 138.4 0 113.8-28.3 126-66.3 158h384c-37.8-32.1-66.3-44.4-66.3-158.2zM256.2 448c26.8 0 48.8-19.9 51.7-43H204.5c2.8 23.1 24.9 43 51.7 43z" fill="#f2f2f2" class="fill-000000"></path></svg>
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
