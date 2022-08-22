<div x-data="{ open: $persist(false) }">  
    <div class="fixed top-0 z-30 flex">
        <div :class="open ? 'w-16 md:w-56' : 'w-0 md:w-16'" class="flex items-center justify-center px-4 py-1 transition-all duration-300 ease-in-out bg-yellow-500">
            <button x-on:click="open = ! open" class="bg-blue">
                <svg class="bg-yellow-500" viewBox="0 0 100 80" width="20" height="20">
                    <rect width="100" height="20" rx="10"></rect>
                    <rect y="30" width="100" height="20" rx="10"></rect>
                    <rect y="60" width="100" height="20" rx="10"></rect>
                </svg>
            </button>
        </div>
        <div :class="open ? 'w-[calc(100vw_-_5rem)] md:w-[calc(100vw_-_15rem)]' : 'w-[calc(100vw_-_3rem)] md:w-[calc(100vw_-_5rem)]'" class="flex items-center justify-between px-4 py-2 text-white bg-slate-900">
            <div>{{ Auth::user()->name}} Service Desk</div>
        
            <div>@livewire('notifications.socket-notification')</div>
        
        </div>
    </div>

    @include('layouts.header')
    
    <aside :class="open ? 'w-16 md:w-56' : 'w-0 md:w-16'" class="fixed top-0 left-0 h-screen transition-all duration-300 ease-in-out">     
        <div class="h-full pt-5 rounded-bl-lg bg-slate-900">
            <ul class="flex flex-col py-20 space-y-8">
                <a href="{{route('dashboard')}}">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 ml-3 mr-2 text-white rounded-lg hover:bg-black">
                        <svg class="font-bold fill-white" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="32px" y="32px" viewBox="0 0 122.88 122.88" style="enable-background:new 0 0 122.88 122.88" xml:space="preserve"><g><path d="M1.48,78.38l76.9-76.9l0,0C79.36,0.49,80.65,0,81.95,0c1.29,0,2.59,0.49,3.57,1.48l0,0l10.17,10.17 c0.55,0.55,0.61,1.4,0.17,2.01c-1.12,1.87-1.55,4.05-1.3,6.16c0.25,2.09,1.18,4.12,2.78,5.72c1.61,1.61,3.63,2.54,5.72,2.78 c2.14,0.26,4.35-0.2,6.24-1.36c0.63-0.38,1.42-0.27,1.92,0.23l0,0l10.17,10.17l0,0c0.98,0.98,1.48,2.28,1.48,3.57 c0,1.29-0.49,2.59-1.48,3.57l0,0l-76.9,76.9l0,0c-0.98,0.98-2.28,1.48-3.57,1.48c-1.29,0-2.59-0.49-3.57-1.48l0,0L27.25,111.3 c-0.56-0.56-0.61-1.44-0.15-2.05c1.22-1.89,1.73-4.12,1.51-6.28c-0.22-2.15-1.15-4.24-2.81-5.89c-1.65-1.65-3.74-2.59-5.89-2.81 c-2.2-0.22-4.45,0.3-6.36,1.56c-0.63,0.42-1.46,0.32-1.97-0.2l0,0L1.48,85.52l0,0C0.49,84.53,0,83.24,0,81.95 C0,80.65,0.49,79.36,1.48,78.38L1.48,78.38L1.48,78.38z M80.6,3.7L3.7,80.6l0,0c-0.37,0.37-0.55,0.86-0.55,1.35 c0,0.49,0.18,0.98,0.55,1.35l0,0l9.25,9.25c2.26-1.18,4.8-1.65,7.28-1.4c2.85,0.29,5.63,1.52,7.8,3.7c2.18,2.18,3.41,4.95,3.7,7.8 c0.25,2.48-0.21,5.02-1.4,7.28l9.25,9.25l0,0c0.37,0.37,0.86,0.55,1.35,0.55c0.49,0,0.98-0.18,1.35-0.55l0,0l76.9-76.9l0,0 c0.37-0.37,0.55-0.86,0.55-1.35c0-0.49-0.18-0.98-0.55-1.35l0,0l-9.34-9.34c-2.24,1.09-4.73,1.49-7.15,1.2 c-2.77-0.33-5.45-1.56-7.58-3.68c-2.12-2.12-3.35-4.81-3.68-7.58c-0.29-2.42,0.11-4.91,1.2-7.15L83.3,3.7l0,0 c-0.37-0.37-0.86-0.55-1.35-0.55C81.46,3.14,80.97,3.33,80.6,3.7L80.6,3.7L80.6,3.7z M25.26,73.45l38.37-38.37l0,0 c1.09-1.09,2.54-1.64,3.98-1.64c1.45,0,2.89,0.55,3.98,1.64l0,0l17.64,17.64c1.1,1.1,1.64,2.54,1.64,3.98 c0,1.44-0.55,2.89-1.64,3.98L50.86,99.05c-1.1,1.1-2.54,1.64-3.98,1.64c-1.44,0-2.88-0.55-3.98-1.64L25.26,81.42l0,0 c-1.1-1.1-1.64-2.54-1.64-3.98S24.17,74.55,25.26,73.45L25.26,73.45L25.26,73.45z M65.86,37.3L27.48,75.67l0,0 c-0.48,0.48-0.72,1.12-0.72,1.76c0,0.64,0.24,1.28,0.72,1.76l0,0l17.64,17.64c0.48,0.48,1.12,0.72,1.76,0.72 c0.64,0,1.28-0.24,1.76-0.72l38.37-38.37c0.48-0.48,0.72-1.12,0.72-1.76c0-0.64-0.24-1.28-0.72-1.76L69.38,37.3l0,0 c-0.49-0.49-1.12-0.73-1.76-0.73C66.98,36.57,66.34,36.82,65.86,37.3L65.86,37.3L65.86,37.3z"/></g></svg>
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-2">Tickets</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 ml-3 mr-2 text-white rounded-lg hover:bg-black">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'h-6 md:h-7' : 'md:h-7'" class="lg:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-2">IT</div>
                    </li>
                </a>
                <a href="{{ route('ticket.create')}} ">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 ml-3 mr-2 text-white rounded-lg hover:bg-black ">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'h-6 md:h-7' : 'md:h-7'" class="lg:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-2 md:mr-3">Create a ticket</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 mr-2 text-white rounded-lg hover:bg-black md:ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'h-6 md:h-7' : 'md:h-7'" class="lg:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                        </svg>
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-2 md:mr-3">Admin</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 mr-2 text-white rounded-lg hover:bg-black md:ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'h-6 md:h-7' : 'md:h-7'" class="lg:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-2 md:mr-3">Wages</div>
                    </li>
                </a>


                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                    class="flex p-1 mr-2 text-white rounded-lg j hover:bg-black md:ml-3">
                    <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'h-6 md:h-7' : 'md:h-7'" class="lg:block" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div :class="open ? 'hidden md:block' : 'hidden'" class="ml-2 md:mr-3">Logout</div>
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
