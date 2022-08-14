<div x-cloak x-data="{historyDrawer: @entangle('historyDrawer')}" class="relative">
    <div x-on:click.outside="historyDrawer = false" class="fixed right-0 z-0 w-8 px-1 py-2 text-white bg-blue-500 border-r rounded-tr-lg rounded-br-lg shadow-md hover:cursor-pointer hover:bg-blue-700 border-y border-stone-400 top-[165px] md:top-36 vertical-text" x-on:click="historyDrawer = true">History</div>
    <div x-transition:enter="transition duration-500"
        x-transition:enter-start="transform translate-x-full"
        x-transition:enter-end="transform translate-x-0"
        x-transition:leave="transition duration-500"
        x-show="historyDrawer" class="fixed right-0 z-40 w-64 h-full py-2 pl-4 pr-3 overflow-y-auto border shadow-md top-36 bg-slate-50 border-stone-300">
        <div class="text-red-600 hover:cursor-pointer left-3" x:on-click="historyDrawer = false">X</div>
        <div class="mt-2">
        
        <div class="h-auto border-l-4 border-blue-400">

            <div class="relative ml-2">
                <div class="absolute -top-1 -left-[18px] h-4 w-4 rounded-full border-2 border-green-500 bg-green-400"></div>
                <div class="ml-2 text-sm">
                    <div class="absolute -top-1">{{\Carbon\Carbon::parse($incident->created_at)->format('d F Y g:i:A')}}</div>
                    <div class="pt-5">
                        <div class="text-sm">Created by <span class="font-bold">{{$incident->requesting_user->name}}</span></div>
                    </div>
                </div>
            </div>

            @foreach($histories as $history)
                <div class="relative mt-5 ml-2">
                    <div class="absolute -top-2 -left-[18px] h-4 w-4 rounded-full border-2 border-blue-400 bg-blue-200"></div>
                    <div class="ml-2 text-sm">
                        <div class="absolute -top-2">{{\Carbon\Carbon::parse($history['time'])->format('d F Y g:i:A')}}</div>
                        <div class="pt-5">
                            @if($history['type'] == 'status')
                                <div><span class="font-bold">{{$history['user']}} set status to <span class="font-bold">{{$history['status']}}</span></div>
                            @else
                                <div><span class="font-bold">{{$history['user']}}</span> re assigned incident to <span class="font-bold">{{$history['agent'] ? $history['agent'] : $history['group']}}</span></div>
                                <div>Status is set to <span class="font-bold">New</span></div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="relative ml-2">
                    <div class="absolute  -left-[18px] h-4 w-4 rounded-full border-2 border-blue-400 bg-blue-200"></div>
            </div>
        </div>

        </div>
    </div>
</div>
