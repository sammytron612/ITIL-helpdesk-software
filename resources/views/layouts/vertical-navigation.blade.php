<div x-cloak x-data="{ open: $persist(false) }">
    <div class="fixed top-0 z-30 flex">
        <div :class="open ? 'w-16 md:w-56' : 'w-0 md:w-16'" class="flex items-center justify-center px-4 py-1 transition-all duration-300 ease-in-out bg-yellow-500">
            <button x-on:click="open = ! open" class="bg-blue">
                <x-svg.hamburger />
            </button>
        </div>
        <div :class="open ? 'w-[calc(100vw_-_5rem)] md:w-[calc(100vw_-_15rem)]' : 'w-[calc(100vw_-_3rem)] md:w-[calc(100vw_-_5rem)]'" class="flex items-center justify-between px-4 py-2 text-white bg-slate-900">
            <div class="ml-5">Service Desk</div>
            <div>{{ Auth::user()->name}}</div>
            <div>@livewire('notifications.socket-notification')</div>

        </div>
    </div>

    @if(collect(request()->segments())->last() =='edit')
        @include('layouts.header')
    @endif

    <aside x-cloak :class="open ? 'w-16 md:w-56' : 'w-0 md:w-16'" class="fixed top-0 left-0 h-screen transition-all duration-300 ease-in-out">
        <div class="h-full pt-5 rounded-bl-lg bg-slate-900">
            <ul class="flex flex-col py-20 space-y-8">
                <a href="{{route('dashboard')}}">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex items-center p-1 ml-3 mr-2 text-white rounded-lg hover:bg-black">
                        <x-svg.ticket />
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-2">Tickets</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 ml-3 mr-2 text-white rounded-lg hover:bg-black">
                        <x-svg.ticket />
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-4">IT</div>
                    </li>
                </a>
                <a href="{{ route('ticket.create')}} ">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 ml-3 mr-2 text-white rounded-lg hover:bg-black ">
                        <x-svg.ticket />
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-4 md:mr-3">Create a ticket</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 mr-2 text-white rounded-lg hover:bg-black md:ml-3">
                        <x-svg.ticket />
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-4 md:mr-3">Admin</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 mr-2 text-white rounded-lg hover:bg-black md:ml-3">
                        <x-svg.ticket />
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-4 md:mr-3">Wages</div>
                    </li>
                </a>

                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                    class="flex p-1 mr-2 text-white rounded-lg j hover:bg-black md:ml-3">
                    <x-svg.ticket />
                    <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-4 md:mr-3">Logout</div>
                </li>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                    @csrf
                </form>

            </ul>
        </div>

    </aside>

    <main :class="open ? 'ml-16 md:ml-56' : 'ml-0 md:ml-16'" class="p-6 mt-28 md:px-16 -z-1">
            {{$slot}}
    </main>
</div>
