<x-new-layout>

    @if(session()->has('message'))
        <div id="alert" x-data class="relative px-4 py-3 bg-green-100 border rounded border-greenb-400 text-slate-gray-400" role="alert">
            <strong class="font-bold">{{ session()->get('message') }}</strong>
            <span x-on:click="document.getElementById('alert').remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="w-6 h-6 fill-current text-slate-gray-800" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif

    <div class="flex py-3">
        <div class="p-3 text-white bg-green-500 rounded-full text-1xl">KW</div>

        <div class="p-3 font-bold text-1xl">
            @php
                $names = explode(' ', $ticket->requesting_user->name);
                $first = ucfirst($names[0]);
                $last = ucfirst(end($names));
                $initials = $first[0] . $last[0];
            @endphp
            {{ $ticket->requesting_user->name }}
        </div>
    </div>
    <div class="py-10 text-2xl font-bold">{{ $ticket->title }}</div>
    <div class="grid grid-cols-6 gap-4 md:grid-cols-6">
        <div class="col-span-4 col-start-1 mt-3 mb-3">
            <span class="mr-2 font-bold text-1xl">Priority</span>
            <span class="px-4 py-0.5 text-slate-gray-800 bg-red-100 border border-red-200 rounded-lg">{{ $ticket->priorities->priority }}</span>

            @livewire('view-ticket.status-button', ['chosenStatus' => $ticket->status])

            @if($ticket->department)
                <div>
                    Department
                    <div>{{ $ticket->department }}</div>
                </div>
            @endif

            @if($ticket->site)
                <div>
                    Site
                    <div>{{ $ticket->site }}</div>
                </div>
            @endif

        </div>

        <div class="flex flex-col items-start col-span-1 row-span-3">
            <div class="p-2">SLA Response</div>
            <div class="text-sm">First response 15 Minutes</div>
        </div>
        <div class="flex flex-col items-center col-span-1 row-span-3">
            <div class="p-2">SLA Resolution</div>
            <div class="text-sm">Resolution time 6 Hours</div>
        </div>

<!--
        <div  class="col-span-4 col-start-1 p-2 -z-1">
            <textarea id="description" class="p-6 border ">
                @php echo $ticket->descriptions->description @endphp
            </textarea>
        </div>
    -->
    </div>




    <script src="https://cdn.tiny.cloud/1/d3utf658spf5n1oft4rjl6x85g568jj7ourhvo2uhs578jt9/tinymce/5/tinymce.min.js"
        referrerpolicy="origin">
    </script>

    <script>

        tinymce.init({

        height : "480",
        relative_urls : true,
        document_base_url : "{{  url('/ticket') }}",
        selector: '#description',
        menubar: false,
        toolbar: false,
        readonly : 1,


        });

    </script>

</x-new-layout>
