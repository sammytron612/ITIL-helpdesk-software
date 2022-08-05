<div x-data="{ open: $persist(false) }">  
    <div class="fixed top-0 z-30 flex">
        <div :class="open ? 'w-56' : 'w-20'" class="flex items-center justify-center px-4 py-4 transition-all duration-300 ease-in-out bg-yellow-500">
            <button x-on:click="open = ! open" class="bg-blue">
                <svg class="bg-yellow-500" viewBox="0 0 100 80" width="20" height="20">
                    <rect width="100" height="20" rx="10"></rect>
                    <rect y="30" width="100" height="20" rx="10"></rect>
                    <rect y="60" width="100" height="20" rx="10"></rect>
                </svg>
            </button>
        </div>
        <div class="w-screen px-4 py-4 text-white bg-slate-900">
        Service Desk
        </div>
    </div>
    
    <aside :class="open ? 'w-56' : 'w-20'" class="fixed top-0 left-0 h-screen transition-all duration-300 ease-in-out">
        
        <div class="h-full pt-5 rounded-bl-lg bg-slate-900">
            <ul class="flex flex-col py-20 space-y-8">
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 pl-2 ml-3 mr-2 text-white rounded-lg hover:bg-black">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'md:h-6' : 'h-7'" class="h-7 lg:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div :class="open ? 'md:block' : 'hidden'" class="ml-2">Reports</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 pl-2 ml-3 mr-2 text-white rounded-lg hover:bg-black">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'md:h-6' : 'h-7'" class="h-7 lg:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div :class="open ? 'md:block' : 'hidden'" class="ml-2">IT</div>
                    </li>
                </a>
                <a href="{{ route('ticket.create')}} ">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 pl-2 ml-3 mr-2 text-white rounded-lg hover:bg-black ">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'md:h-6' : 'h-7'" class="h-7 lg:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <div :class="open ? 'md:block' : 'hidden'" class="ml-2">Create a ticket</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 pl-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'md:h-6' : 'h-7'" class="h-7 lg:block"" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                        </svg>
                        <div :class="open ? 'md:block' : 'hidden'" class="ml-2 md:mr-3">Admin</div>
                    </li>
                </a>
                <a href="#">
                    <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                        class="flex p-1 pl-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'md:h-6' : 'h-7'" class="h-7 lg:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div :class="open ? 'md:block' : 'hidden'" class="ml-2 md:mr-3">Wages</div>
                    </li>
                </a>


                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                <li :class="open ? 'justify-start ml-3' : 'justify-center'"
                    class="flex p-1 pl-2 mr-2 text-white rounded-lg j hover:bg-black md:ml-3">
                    <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'md:h-6' : 'h-7'" class="h-7 lg:block" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div :class="open ? 'block' : 'hidden'" class="ml-2 md:mr-3">Logout</div>
                </li>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                    @csrf
                </form>

            </ul>
        </div>

    </aside>
    <main :class="open ? 'ml-56' : 'ml-20'" class="p-6 md:px-16 mt-14 -z-1">
            {{$slot}}
    </main>
</div>
