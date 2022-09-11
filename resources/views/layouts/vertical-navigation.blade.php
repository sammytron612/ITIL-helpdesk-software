<div x-cloak x-data="{ openNav: $persist(false) }">
    <div class="fixed top-0 z-30 flex">
        <div :class="openNav ? 'w-16 md:w-56' : 'w-0 md:w-16'" class="flex items-center justify-center px-4 py-1 transition-all duration-300 ease-in-out bg-yellow-500">
            <button x-on:click="openNav = ! openNav" class="bg-blue">
                <x-svg.hamburger />
            </button>
        </div>
        <div :class="openNav ? 'w-[calc(100vw_-_5rem)] md:w-[calc(100vw_-_15rem)]' : 'w-[calc(100vw_-_3rem)] md:w-[calc(100vw_-_5rem)]'" class="flex items-center justify-between px-4 py-2 text-white bg-slate-900">
            <div class="ml-5">Service Desk</div>
            <div>{{ Auth::user()->name}}</div>
            <div>@livewire('notifications.socket-notification')</div>

        </div>
    </div>


    <aside x-cloak :class="openNav ? 'w-16 md:w-56' : 'w-0 md:w-16'" class="fixed top-0 left-0 h-screen transition-all duration-300 ease-in-out">
        <div class="h-full pt-5 rounded-bl-lg bg-slate-900">
            <ul class="flex flex-col py-20 space-y-8">

                <a href="{{route('dashboard')}}">
                    <li :class="openNav ? 'justify-start ml-3' : 'justify-center'"
                        class="flex items-center p-2 ml-3 mr-2 text-white rounded-lg hover:bg-black">
                        <i class="py-3 fa-solid fa-lg fa-chart-line"></i>

                        <div :class="openNav ? 'hidden md:block' : 'hidden'" class="ml-4">Dashboard</div>
                    </li>
                </a>

                <a href="{{route('dashboard')}}">
                    <li :class="openNav ? 'items-center justify-start ml-3' : 'justify-center'"
                        class="flex items-center p-2 ml-3 mr-2 text-white rounded-lg hover:bg-black">
                        <i class="py-3 fa fa-lg fa-ticket" aria-hidden="true"></i>

                        <div :class="openNav ? 'hidden md:block' : 'hidden'" class="ml-2">Tickets</div>
                    </li>
                </a>
                <a href="{{ route('ticket.create')}}">
                    <li :class="openNav ? 'justify-start ml-3' : 'justify-center'"
                        class="flex items-center p-2 ml-3 mr-2 text-white rounded-lg hover:bg-black ">
                        <i class="py-3 fa-solid fa-lg fa-file-circle-plus"></i>
                        <div :class="openNav ? 'hidden md:block' : 'hidden'" class="ml-4 md:mr-3">New ticket</div>
                    </li>
                </a>
                @if(Auth::user()->isAgent())
                    <a href="#">
                        <li :class="openNav ? 'justify-start ml-3' : 'justify-center'"
                            class="flex items-center p-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3">
                            <i class="py-3 fa-solid fa-lg fa-gears"></i>
                            <div :class="openNav ? 'hidden md:block' : 'hidden'" class="ml-4 md:mr-3">Admin</div>
                        </li>
                    </a>
                @endif
                @if(Auth::user()->isAgent())
                    <a href="{{route('kb.index')}}">
                        <li :class="openNav ? 'justify-start ml-3' : 'justify-center'"
                            class="flex items-center p-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3">
                            <i class="py-3 fa-solid fa-lg fa-book-open-reader"></i>
                            <div :class="openNav ? 'hidden md:block' : 'hidden'" class="ml-4 md:mr-3">Knowledge base</div>
                        </li>
                    </a>
                @endif

                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                <li :class="openNav ? 'justify-start ml-3' : 'justify-center'"
                    class="flex items-center p-2 mr-2 text-white rounded-lg j hover:bg-black md:ml-3">
                    <i class="py-3 fa-solid fa-lg fa-right-from-bracket"></i>
                    <div :class="openNav ? 'hidden md:block' : 'hidden'" class="ml-4 md:mr-3">Logout</i></div>
                </li>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                    @csrf
                </form>

            </ul>
        </div>

    </aside>

    <main :class="openNav ? 'ml-16 md:ml-56' : 'ml-0 md:ml-16'" class="py-6 mt-28 -z-1">
            {{$slot}}
    </main>
</div>
