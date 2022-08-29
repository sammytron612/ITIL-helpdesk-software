<div x-data="page()" x-init="initStorage()">
    <div class="grid items-center grid-cols-2 md:grid-cols-3">
        <div class="order-2 w-full md:order-first">
            @livewire('incidents.drop-down')
        </div>
        <div class="relative order-first w-full col-span-2 -z-33 md:col-span-1 md:order-2">
            <div class="w-full" x-data="{ searchTerm: ''}">
                <label class="relative block">
                    <span x-show="!searchTerm" class="absolute inset-y-0 left-0 flex items-center pl-3 opacity-75">
                        <svg class="w-5 h-5 fill-black" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30"
                            height="30" viewBox="0 0 30 30">
                            <path
                                d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
                            </path>
                        </svg>
                    </span>
                    <input x-on:keydown.debounce.500ms="search" x-model="searchTerm"
                        class="w-full p-2 border-0 border-b-2 border-gray-300 outline-none text-md focus:ring-0 focus:border-blue-400"
                         type="text" />
            </div>
        </div>
        <div class="order-last w-full">
            <div x-data="{openButton: $persist(false)}">
                <div x-on:click.outside="openButton = false" class="">
                    <div class="py-2" x-on:click="openButton = ! openButton">
                        <div class="relative text-sm font-medium cursor-pointer">
                            <div x-transition.500ms class="p-5 pl-0 text-lg text-right">Columns
                                <svg class="inline-block w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <div x-on:click.outside="openButton = ! openButton; $wire.updateSelectedCheckBoxes()" class="absolute right-0 w-48 p-2 origin-top-right bg-white rounded-md shadow-lg top-14 ring-1 ring-black ring-opacity-5 focus:outline-none"
                                x-show="openButton" x-cloak>
                                @foreach($allColumns as $key => $col)
                                    @if($loop->first) @continue @endif
                                    <div class="block px-2 py-2 text-sm text-left text-gray-700 hover:text-blue-900"><input x-on:click="openButton = open" wire:model="selectedCheckBoxes.{{$key}}" class="border border-blue-700 rounded appearance-none checked:bg-blue-500" type="checkbox"  value="true"><span class="ml-2">{{ucwords($col)}}</span></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:loading.flex class="justify-center text-2xl">
        <div class="w-16 h-16 border-b-2 border-blue-900 rounded-full animate-spin"></div>
    </div>
    <div wire:loading.remove class="w-full mt-3 overflow-x-auto">
        <table class="text-sm text-left text-gray-500 border rounded shadow-lg table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase hover:cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th wire:click="sortBy('incidents.id')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-between flex-grow">
                            NO
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </div>
                    </th>

                    @if(in_array('status',$storedColumns))
                    <th wire:click="sortBy('status.name')" scope="col" class="px-6 py-3">
                        <div class="flex items-center justify-between">
                           STATUS
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </div>
                    </th>
                    @endif

                    @if(in_array('title',$storedColumns))
                    <th wire:click="sortBy('incidents.title')" scope="col" class="px-3 py-3">
                        <div class="flex items-center justify-between w-64">
                           INCIDENT TITLE
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="bg-blue-500" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </div>
                    </th>
                    @endif

                    @if(in_array('priority',$storedColumns))
                    <th wire:click="sortBy('priority.name')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-between">
                            PRIORITY
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('category',$storedColumns))
                    <th wire:click="sortBy('category.name')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-between">
                            CATEGORY
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('sub_category',$storedColumns))
                    <th wire:click="sortBy('sub_category.name')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-between">
                            SUB CATEGORY
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('agent_group',$storedColumns))
                    <th wire:click="sortBy('agent_group.name')" class="px-6 py-3 fill-blue-600 whitespace-nowrap">
                        <div class="flex items-center">
                            AGENT GROUP
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('assigned_to',$storedColumns))
                    <th wire:click="sortBy('assigned_to.name')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            ASSIGNED TO
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('created_by',$storedColumns))
                    <th wire:click="sortBy('created_by.name')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            CREATED BY
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('site',$storedColumns))
                    <th wire:click="sortBy('site.name')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            SITE
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('department',$storedColumns))
                    <th wire:click="sortBy('department.name')" class="px-6 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            DEPARTMENT
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('reassignments',$storedColumns))
                    <th wire:click="sortBy('reassignments.name')" class="px-6 py-3">
                        <div class="flex items-center">
                            REASSIGNMENTS
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('created_at',$storedColumns))
                    <th wire:click="sortBy('incidents.created_at')" class="px-6 py-3">
                        <div class="flex items-center">
                            CREATED
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1 fill-blue-600" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                         </div>
                    </th>
                    @endif

                    @if(in_array('updated_at',$storedColumns))
                    <th wire:click="sortBy('incidents.updated_at')" class="px-6 py-3">
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
                            {{ $incident->sub_category ?? '' }}
                        </td>
                        @endif

                        @if(in_array('agent_group',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->agent_group ?? '' }}
                        </td>
                        @endif

                        @if(in_array('assigned_to',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->assigned_to ?? '' }}
                        </td>
                        @endif

                        @if(in_array('created_by',$storedColumns))
                        <td class="px-6 py-4">
                            {{ $incident->created_by ?? ''}}
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
            <div class="order-3">
                <label class="font-semibold text-md" for="shown">Showing</label>
                <select wire:model='numberShown'class="block px-3 py-1 m-0 text-base font-normal text-gray-700 transition ease-in-out bg-white bg-no-repeat border border-gray-300 border-solid rounded appearance-none w-28 form-select bg-clip-padding focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Shown">
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
            </div>
            <div class="py-4 mt-2">
                @isset($incident)
                    {{ $incidents->links() }}
                @endisset
            </div>
        </div>
    </div>

    <script>

window.addEventListener('updateColumns', event => {
    localStorage.setItem("{{Auth::user()->email}}", JSON.stringify(event.detail.cols));
    console.log(event.detail.cols);
})

    function page() {
        return {

            searchTerm: '',

            initStorage()
            {

                var columns = JSON.parse(localStorage.getItem("{{Auth::user()->email}}"));

                if(!columns)
                {
                    columns = @json($allColumns);
                    @this.set('storedColumns', columns);
                    localStorage.setItem("{{Auth::user()->email}}", JSON.stringify(columns));
                }
                else
                {
                    console.log(columns)
                    @this.set('storedColumns', columns);
                }

            },
            updateCols(e){

                    alert('')

            },

            search(){

                if(this.searchTerm.length > 1)
                {
                    @this.set('searchTerm',this.searchTerm)
                }
                else {@this.searchTerm = ''}
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

