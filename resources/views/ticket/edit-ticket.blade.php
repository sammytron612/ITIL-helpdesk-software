<x-new-layout>

    @if(session()->has('message'))
        <div id="alert" x-data class="relative px-4 py-3 bg-green-100 border rounded border-greenb-400 text-slate-gray-400" role="alert">
            <strong class="font-bold">{{ session()->get('message') }}</strong>
            <span x-on:click="document.getElementById('alert').remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="w-6 h-6 fill-current text-slate-gray-800" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif

    <div class="flex items-center justify-between">
        
        <div class="flex items-center">
            <h4 class="mr-2 font-bold text-1xl">Incident created by: </h4> 
            <x-avatar :name="$ticket->requesting_user->name">
                {{$ticket->requesting_user->name}}
            </x-avatar>
        </div>

        <div>
            About {{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans()}}
        </div>
    </div>
    
    

    <div class="py-10 text-2xl font-bold">{{ $ticket->title }}</div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-2 gap-y-4">

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
                    @if($ticket->department)
                        <div class="mb-3 font-bold text-1xl">Department: </div>
                    @endif
                    @if($ticket->site)
                        <div class="mb-3 font-bold text-1xl">Site: </div>
                    @endif
                </div>

                <div class="ml-3">
                    <div class="mb-3">Me</div>
                    @if($ticket->department)
                        <div class="mb-3">{{$ticket->departments->title}} </div>
                    @endif
                    @if($ticket->site)
                        <div class="mb-3">{{$ticket->chosen_site->name}}</div>
                    @endif
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
        
        <div class="order-3 mt-5 md:col-span-2">
            <x-avatar :name="$ticket->requesting_user->name">
                {{$ticket->requesting_user->name}}
            </x-avatar>
            
            <textarea id="description" class="p-6 border">
                @php echo $ticket->descriptions->description @endphp
            </textarea>
        </div>
    
    </div>
    <p>m?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).


Where does it come from?
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.

Where can I get some?
There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.

5
	paragraphs
	words
	bytes
	lists
	Start with 'Lorem
ipsum dolor sit amet...'
</p>

    @livewire('view-ticket.modal', ['incident_id' => $ticket->id])


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
