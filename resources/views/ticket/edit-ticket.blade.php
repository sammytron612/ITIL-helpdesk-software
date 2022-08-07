<x-new-layout>

    @if(session()->has('message'))
        <div id="alert" x-data class="relative px-4 py-3 bg-green-100 border rounded border-greenb-400 text-slate-gray-400" role="alert">
            <strong class="font-bold">{{ session()->get('message') }}</strong>
            <span x-on:click="document.getElementById('alert').remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="w-6 h-6 fill-current text-slate-gray-800" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif

    <div>
        
        <div class="grid items-center grid-cols-1 md:grid-cols-2">
            <h4 class="mr-2 font-bold text-1xl">Incident created by: </h4> 
            <x-avatar :name="$ticket->requesting_user->name">
                {{$ticket->requesting_user->name}}
            </x-avatar>
        </div>
    </div>
    
    

    <div>
        <div class="py-4 text-2xl font-bold">{{ $ticket->title }}</div>
        <div class="font-light">
            Created {{ \Carbon\Carbon::parse($ticket->created_at)->format('d F Y g:i:A')}}
        </div>
    </div>
    
    <div class="grid grid-cols-1 mt-12 md:grid-cols-2 gap-x-2 gap-y-4">
        <div class="order-2 md:order-1">
            <div>
                <div class="mb-2 font-bold text-1xl">Priority</div>
                <x-priority :priority="$ticket->priorities->id">
                    {{$ticket->priorities->priority}}
                </x-priority>
            </div>
            @livewire('view-ticket.status-button', ['incident_no' => $ticket->id])
        </div>

        <div class="order-1 md:order-2">
            <div class="flex">
                <div>
                    <div class="mb-3 font-bold text-1xl">Assigned to: </div>
                    <div class="mb-3 font-bold text-1xl">Department: </div>
                    <div class="mb-3 font-bold text-1xl">Site: </div>
                    <div class="mb-3 font-bold text-1xl">Category: </div>
                    <div class="mb-3 font-bold text-1xl">Sub category: </div>
                    
                </div>

                <div class="ml-3">
                    <div class="mb-3 font-bold text-1xl">Me</div>
                    
                    
                    <div class="mb-3">
                        @livewire('view-ticket.department-dropdown',['incident' => $ticket->id])
                    </div>
                    

                    
                    <div class="mb-3">
                        @livewire('view-ticket.site-dropdown', ['incident' => $ticket->id])
                    </div>
                
                    
                    <div class="mb-3">
                        @livewire('view-ticket.category-dropdown',['incident' => $ticket->id])
                    </div>
                
                    
                    <div class="mb-3">
                        @livewire('view-ticket.sub-category-dropdown', ['incident' => $ticket->id])
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<!--
    
        <div class="flex flex-col items-start order-3 col-span-1 row-span-3 md:order-2">
            <div class="p-2">SLA Response</div>
            <div class="text-sm">First response 15 Minutes</div>
        </div>
        <div class="flex flex-col items-center order-4 col-span-1 row-span-3 md:order-3">
            <div class="p-2">SLA Resolution</div>
            <div class="text-sm">Resolution time 6 Hours</div>
        </div>
    
-->
        
        <div x-data="{ updates: true, comment: false}">
            <div class="flex justify-between mt-5">
                <div class="flex">
                    <h2 x-on:click="updates = true; comment = false" :class="updates ? 'border-b-4 border-cyan-400' : '' " class="py-3 text-2xl hover:cursor-pointer Font-bold">Updates ({{count($ticket->ticket_updates)}})</h2>
                    <h2 x-on:click="updates = false; comment = true" :class="comment ? 'border-b-4 border-cyan-400' : '' " class="py-3 ml-4 text-2xl hover:cursor-pointer Font-bold">Add comment</h2>
                </div>
                <div x-show="updates">+ Expand all</div>
            </div>

            <div class="mt-5">
                <div x-transition x-show="updates">
                    @foreach($ticket->ticket_updates as $comment)
                        <div x-data="{ open: false }" class="p-5 border-2 shadow rounded-t-xl">
                            <div class="flex items-center justify-between hover:cursor-pointer" x-on:click="open = ! open">
                                <div>
                                    <x-avatar :name="$ticket->requesting_user->name">
                                        {{$ticket->requesting_user->name}}
                                    </x-avatar>
                                </div>
                                
                                <div class="text-sm">
                                    <div>
                                        {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}
                                    </div>
                                    <div>
                                        {{ \Carbon\Carbon::parse($comment->created_at)->format('d F Y g:i:A')}}
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div x-transition.duration.500ms x-show="open" class="p-6 border">
                                {!! $comment->comment !!}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div x-transition x-show="comment">
                    <textarea id="new-comment" class="">
                    </textarea>
                    <button class="px-4 py-2 mt-3 text-white bg-blue-500 rounded hover:bg-blue-400">Post</button>
                </div>
            </div>
        </div>
    

    @livewire('view-ticket.modal', ['incident_id' => $ticket->id])


    <script src="https://cdn.tiny.cloud/1/d3utf658spf5n1oft4rjl6x85g568jj7ourhvo2uhs578jt9/tinymce/5/tinymce.min.js"
        referrerpolicy="origin">
    </script>

    <script>

        tinymce.init({

        
        relative_urls : false,
        selector: '#new-comment',
        plugins: 'autoresize, fullscreen hr image autolink lists  media table paste textpattern help',
        menubar: 'insert fullscreen hr image ',
        toolbar: 'fullscreen  image casechange code pageembed permanentpen table advancedlist paste pastetext spellchecker formatselect hr| bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '{{ route("image.upload") }}');
        var token = '{{ csrf_token() }}';
        xhr.setRequestHeader("X-CSRF-Token", token);
        xhr.onload = function() {
        var json;
        if (xhr.status != 200) {
        failure('HTTP Error: ' + xhr.status);
        return;
        }
        json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
        failure('Invalid JSON: ' + xhr.responseText);
        return;
        }
        success(json.location);
        };
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.send(formData);
        }


        });

    </script>

</x-new-layout>
