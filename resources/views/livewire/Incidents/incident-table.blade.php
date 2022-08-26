<div x-data="page()" x-init="initStorage()">
    <div wire:loading.flex class="justify-center text-2xl">
        <div class="border-b-2 border-blue-900 rounded-full w-28 h-28 animate-spin"></div>
    </div>
    <div wire:loading.remove class="flex justify-between">
        <div class="">
            @livewire('incidents.drop-down')
        </div>

        <div x-data="{openButton: $persist(false)}" class="text-right">
            <div class="flex justify-end">
                <div class="py-2" x-on:click="openButton = ! openButton">
                    <div class="relative flex items-center space-x-1 text-sm font-medium cursor-pointer">
                        <div x-transition.500ms class="p-5 text-2xl">Columns
                            <svg class="inline-block w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="absolute right-0 w-48 p-2 origin-top-right bg-white rounded-md shadow-lg top-14 ring-1 ring-black ring-opacity-5 focus:outline-none"
                            x-show="openButton" x-cloak>

                            @foreach($allColumns as $key => $col)
                                @if($loop->first) @continue @endif
                                <div class="block px-2 py-2 text-sm text-left text-gray-700 hover:text-blue-900"><input wire:model="selectedCheckBoxes.{{$key}}" class="border border-blue-700 rounded appearance-none checked:bg-blue-500" type="checkbox"  value="true"><span class="ml-2">{{ucwords($col)}}</span></div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:loading.remove class="w-full mt-3 overflow-x-auto">
        <table class="text-sm text-left text-gray-500 border rounded shadow-lg table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase hover:cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th wire:click="sortBy('id')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-between flex-grow">
                            NO
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </div>
                    </th>

                    @if(in_array('status',$storedColumns))
                    <th wire:click="sortBy('status')" scope="col" class="px-6 py-3">
                        <div class="flex items-center justify-between">
                           STATUS
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </div>
                    </th>
                    @endif

                    @if(in_array('title',$storedColumns))
                    <th wire:click="sortBy('title')" scope="col" class="px-3 py-3">
                        <div class="flex items-center justify-between w-64">
                           INCIDENT TITLE
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="bg-blue-500" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </div>
                    </th>
                    @endif

                    @if(in_array('priority',$storedColumns))
                    <th wire:click="sortBy('priority')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-between">
                            PRIORITY
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('category',$storedColumns))
                    <th wire:click="sortBy('category')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-between">
                            CATEGORY
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('sub_category',$storedColumns))
                    <th wire:click="sortBy('sub_category')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-between">
                            SUB CATEGORY
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('assigned_group',$storedColumns))
                    <th wire:click="sortBy('assigned_group')" class="px-6 py-3 fill-blue-600 whitespace-nowrap">
                        <div class="flex items-center">
                            ASSIGNED GROUP
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('assigned_to',$storedColumns))
                    <th wire:click="sortBy('assigned_to')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            ASSIGNED TO
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('requestor',$storedColumns))
                    <th wire:click="sortBy('requestor')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            REQUESTOR
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('site',$storedColumns))
                    <th wire:click="sortBy('site')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            SITE
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('department',$storedColumns))
                    <th wire:click="sortBy('department')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            DEPARTMENT
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('reassignments',$storedColumns))
                    <th wire:click="sortBy('reassignments')" class="px-6 py-3">
                        <div class="flex items-center">
                            REASSIGNMENTS
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('created_at',$storedColumns))
                    <th wire:click="sortBy('created_at')" class="px-6 py-3">
                        <div class="flex items-center">
                            CREATED
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('updated_at',$storedColumns))
                    <th wire:click="sortBy('updated_at')" class="px-6 py-3">
                        <div class="flex items-center">
                            UPDATED
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif
                </tr>
            </thead>
            <tbody x-data>
                @forelse($incidents as $incident)
                    <tr x-on:click="window.location.href = '{{ route('ticket.edit', $incident->id) }}'" class="bg-white border-b hover:cursor-pointer hover:bg-blue-50 dark:bg-gray-800 dark:border-gray-700">

                        @if(in_array('id',$storedColumns))
                        <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $incident->id }}
                        </td>
                        @endif

                        <td id="sla" class="hidden px-6 py-4 whitespace-nowrap">
                            <input class="hidden-input" type="hidden" id="{{ $incident->id }}" value = "{{
                            \Carbon\Carbon::parse($incident->created_at)->diffInSeconds(\Carbon\Carbon::now())
                            }}" />
                            <span id="sla_timer-{{ $incident->id }}"></span>
                        </td>
                        @if(in_array('status',$storedColumns))
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-status :status="$incident->status" assigned="">
                                    {{$incident->status ?? ''}}
                                </x-status>
                            </td>
                        @endif

                        @if(in_array('title',$storedColumns))
                        <td class="px-3 py-4 font-semibold">
                            {{ $incident->title ?? ''}}
                        </td>
                        @endif

                        @if(in_array('priority',$storedColumns))
                        <td class="px-6 py-4">
                            <x-priority :priority="$incident->priority">
                                {{$incident->priority ?? ''}}
                            </x-priority>
                        </td>
                        @endif

                        @if(in_array('category',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->category ?? ''}}
                        </td>
                        @endif

                        @if(in_array('sub_category',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->sub_categories ?? '' }}
                        </td>
                        @endif

                        @if(in_array('assigned_group',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->assigned_group ?? '' }}
                        </td>
                        @endif

                        @if(in_array('assigned_to',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->assigned_to ?? '' }}
                        </td>
                        @endif

                        @if(in_array('requestor',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->requestor ?? ''}}
                        </td>
                        @endif

                        @if(in_array('site',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->site ?? '' }}
                        </td>
                        @endif

                        @if(in_array('department',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->department ?? '' }}
                        </td>
                        @endif

                        @if(in_array('reassignments',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->reassignments ?? '' }}
                        </td>
                        @endif

                        @if(in_array('created_at',$storedColumns))
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($incident->created_at)->format('d/m/y H:m') }}
                        </td>
                        @endif

                        @if(in_array('updated_at',$storedColumns))
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($incident->created_at)->format('d/m/y H:m')  }}
                        </td>
                        @endif
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="py-4 mt-2">
            @isset($incident)
                {{ $incidents->links() }}
            @endisset
        </div>
    </div>

    <script>

window.addEventListener('updateColumns', event => {
    localStorage.setItem("{{$user->email}}", JSON.stringify(event.detail.cols));
    console.log(event.detail.cols);
})

    function page() {
        return {

            //stored: openButton,

            initStorage()
            {

                var columns = JSON.parse(localStorage.getItem("{{$user->email}}"));

                if(!columns)
                {
                    columns = @json($allColumns);
                    @this.set('storedColumns', columns);
                    localStorage.setItem("{{$user->email}}", JSON.stringify(columns));
                }
                else
                {
                    console.log(columns)
                    @this.set('storedColumns', columns);
                }

            },
            updateCols(e){

                    alert('')

            }
        }

    }





        //initStorage()
    /*

        function sla(){

            var elements = document.querySelectorAll('.hidden-input')

            elements.forEach(element => {
                var totalSeconds = element.value;
                function countTimer() {
                    ++totalSeconds;
                    var day = Math.floor(totalSeconds / 86400);
                    var hour = Math.floor(totalSeconds / 3600) - (day * 24);
                    var minute = Math.floor((totalSeconds - hour*3600) / 60) - (day * 1440);
                    var second = totalSeconds - (hour*3600 + minute*60) - (day * 86400);
                    prepend_seconds = String(second).padStart(2, '0')
                    prepend_minutes = String(minute).padStart(2, '0')
                    prepend_hours = String(hour).padStart(2, '0')

                    if(day == 0)
                    {
                        $html = prepend_hours + ":" + prepend_minutes + ":" + prepend_seconds;
                    }
                    else
                    {
                        $html = day + " days " + prepend_hours + ":" + prepend_minutes + ":" + prepend_seconds;
                    }

                    document.getElementById("sla_timer-" + element.id).innerHTML = $html
                    }

                    var timerVar = setInterval(countTimer, 1000);
                });}


                window.addEventListener('name-updated', event => {
                    alert('dd')
                    console.log(window.location.search)
                    sla();
                })
    */

    </script>

</div>

