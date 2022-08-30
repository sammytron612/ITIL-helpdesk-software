<x-new-layout>
    <div>@include('layouts.header',['ticket' => $ticket])</div>

    <div class="px-4 mt-16 md:mt-2 md:px-16">
        @if(session()->has('message'))
            <div id="alert" x-data class="relative px-4 py-3 bg-green-100 border rounded border-greenb-400 text-slate-gray-400" role="alert">
                <strong class="font-bold">{{ session()->get('message') }}</strong>
                <span x-on:click="document.getElementById('alert').remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="w-6 h-6 fill-current text-slate-gray-800" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif

        <div class="flex items-center mt-5">
            <h4 class="mr-2 font-bold text-1xl">Incident created by: </h4>
            <x-avatar :colour="$ticket->requested_by->my_avatar->colour" :name="$ticket->requested_by->name">
                {{$ticket->requested_by->name}}
            </x-avatar>
        </div>

        @if(Auth::user()->isAgent())
            <div>
                @livewire('view-ticket.history',['incident' => $ticket])
            </div>

            <div x-cloak x-data="{drawer: false}" class="relative mt-4 md:mt-0">
                <div x-on:click.outside="drawer = false" class="fixed right-0 z-0 w-8 px-1 py-2 text-white bg-green-500 border-r rounded-tr-lg rounded-br-lg shadow-md hover:cursor-pointer hover:bg-green-700 border-y border-stone-400 top-[260px] md:top-60 vertical-text" x-on:click="drawer = ! drawer">SLA</div>
                <div x-transition:enter="transition duration-500"
                    x-transition:enter-start="transform translate-x-full"
                    x-transition:enter-end="transform translate-x-0"
                    x-transition:leave="transition duration-500"
                    x-show="drawer" class="fixed right-0 z-40 w-64 h-full px-4 py-2 border rounded-tl-lg rounded-bl-lg shadow-md top-36 bg-slate-50 border-stone-400">
                    <div class="hover:cursor-pointer" x:on-click="drawer = false">X</div>
                    <div>
                        <p>jdkjfkjdfdldj dlkj fdlj</p>
                    </div>
            </div>
        @endif

        <div>
            <div class="py-4 text-2xl font-bold">{{ $ticket->title }}</div>
            <div class="font-light">
                Created {{ \Carbon\Carbon::parse($ticket->created_at)->format('d F Y g:i:A')}}
            </div>
        </div>

        <div class="grid grid-cols-1 mt-12 md:grid-cols-3 md:gap-x-4 gap-y-4">
            <div class="order-2 md:order-1 md:col-span-2">
                <div>
                    <div class="mb-2 font-bold text-1xl">Priority</div>
                    <x-priority :priority="$ticket->priorities->id">
                        {{$ticket->priorities->name}}
                    </x-priority>
                </div>

                @livewire('view-ticket.status-button', ['incident' => $ticket])

            </div>

            <div class="order-1 md:order-2">
                <div class="flex">
                    <div>
                        <div class="mb-3 font-bold text-1xl">Assigned to: </div>
                        <div class="mb-3 font-bold text-1xl">Department: </div>
                        <div class="mb-3 font-bold text-1xl">Location: </div>
                        <div class="mb-3 font-bold text-1xl">Category: </div>
                        <div class="mb-3 font-bold text-1xl">Sub category: </div>

                    </div>

                    <div class="ml-3">
                        <div class="mb-3 font-bold text-1xl">
                            @livewire('view-ticket.assign', ['incident' => $ticket])
                        </div>


                        <div class="mb-3">
                            @livewire('view-ticket.department-dropdown',['incident' => $ticket])
                        </div>



                        <div class="mb-3">
                            @livewire('view-ticket.site-dropdown', ['incident' => $ticket->id])
                        </div>


                        <div class="mb-3">
                            @livewire('view-ticket.category-dropdown',['incident' => $ticket])
                        </div>


                        <div class="mb-3">
                            @livewire('view-ticket.sub-category-dropdown', ['incident' => $ticket])
                        </div>

                    </div>
                </div>
            </div>


            <div class="order-3 md:col-span-2">
                @livewire('view-ticket.comment-component',['ticket' => $ticket])
            </div>

            <div class="order-4">
                Something else to go here
            </div>
        </div>

        @livewire('view-ticket.modal', ['incident' => $ticket]);


    </div>

</x-new-layout>
