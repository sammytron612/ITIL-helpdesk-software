<aside class="fixed top-0 left-0 w-1/6 h-screen">

    <div class="px-4 py-5 text-center text-white bg-black">KLW</div>

    <div class="h-full pt-5 rounded-bl-lg bg-slate-800">
        <ul class="flex flex-col space-y-8">
            <a href="#">
                <li class="flex justify-center p-1 mr-2 text-white rounded-lg hover:bg-black md:ml-3 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 md:hidden lg:block md:h-6" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                    </svg>
                    <div class="hidden md:mr-2 md:ml-2 md:block">Reports</div>
                </li>
            </a>
            <a href="#">
                <li
                    class="flex justify-center p-1 pl-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 md:hidden lg:block md:h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <div class="hidden md:ml-2 md:block">IT</div>
                </li>
            </a>
            <a href="{{ route('ticket.create')}} ">
                <li
                    class="flex justify-center p-1 pl-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 md:hidden lg:block md:h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <div class="hidden md:ml-2 md:block">Create a ticket</div>
                </li>
            </a>
            <a href="#">
                <li
                    class="flex justify-center p-1 pl-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 md:hidden lg:block md:h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                    </svg>
                    <div class="hidden md:ml-2 md:block md:mr-3">Admin</div>
                </li>
            </a>
            <a href="#">
                <li
                    class="flex justify-center p-1 pl-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 md:hidden lg:block md:h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="hidden md:ml-2 md:block md:mr-3">Wages</div>
                </li>
            </a>


            <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
               <li class="flex justify-center p-1 pl-2 mr-2 text-white rounded-lg hover:bg-black md:ml-3 md:justify-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 md:hidden lg:block md:h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="hidden md:ml-2 md:block md:mr-3">Logout</div>
            </li>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                @csrf
            </form>

        </ul>
    </div>

</aside>
