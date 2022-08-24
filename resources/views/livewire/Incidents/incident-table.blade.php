<div>
    <div class="overflow-x-auto">
        <table class="text-sm text-left text-gray-500 border rounded shadow-lg table-fixed dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3 whitespace-nowrap">
                        NO
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                        SLA
                    </th>
                    <th class="px-6 py-3">
                        STATE
                    </th>
                    <th class="px-6 py-3 md:px-32 whitespace-nowrap">
                        INCIDENT TITLE
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                        PRIORITY
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                        CATEGORY
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                        SUBCATEGORY
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                        ASSIGNED TO
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                        REQUESTOR
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                        SITE
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                        DEPARTMENT
                    </th>
                </tr>
            </thead>
            <tbody x-data>
                @forelse($incidents as $incident)
                    <tr x-on:click="window.location.href = '{{ route('ticket.edit', $incident->id) }}'" class="bg-white border-b hover:cursor-pointer hover:bg-blue-50 dark:bg-gray-800 dark:border-gray-700">

                        <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $incident->id }}
                        </td>

                        <td id="sla" class="px-6 py-4 whitespace-nowrap">
                            <input class="hidden-input" type="hidden" id="{{ $incident->id }}" value = "{{
                            \Carbon\Carbon::parse($incident->created_at)->diffInSeconds(\Carbon\Carbon::now())
                            }}" />
                            <span id="sla_timer-{{ $incident->id }}"></span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-status :status="$incident->status" assigned="">
                                {{$incident->statuses->status}}
                            </x-status>
                        </td>

                        <td class="px-6 py-4 font-semibold text-center stop-streching">
                            {{ $incident->title ?? ''}}
                        </td>

                        <td class="px-6 py-4">
                            <x-priority :priority="$incident->priority">
                                {{$incident->priorities->priority}}
                            </x-priority>

                        </td>

                        <td class="px-6 py-4">
                            {{ $incident->categories->title }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $incident->sub_categories->title ?? '' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $incident->assigned->name ?? '' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $incident->requesting_user->name ?? ''}}
                        </td>

                        <td class="px-6 py-4">
                            {{ $incident->chosen_site->name ?? '' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $incident->departments->title ?? '' }}
                        </td>

                        <td class="px-6 py-4">

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="py-4 mt-2">
        {{$incidents->links()}}
        </div>
    </div>

<script>


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

/*
            window.addEventListener('name-updated', event => {
                alert('dd')
                console.log(window.location.search)
                sla();
            })
*/

    </script>
</div>


