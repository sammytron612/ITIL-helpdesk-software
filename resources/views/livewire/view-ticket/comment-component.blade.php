<div x-data="page()">
    <div x-data="{ updates: true, comment: false}">
        <div class="flex flex-wrap justify-between mt-5">
            <div class="flex">
                <h2 x-on:click="updates = true; comment = false" :class="updates ? 'border-b-4 border-cyan-400' : '' " class="py-3 font-bold text-1xl md:text-2xl hover:cursor-pointer">Updates ({{count($comments)}})</h2>
                <h2 x-on:click="updates = false; comment = true" :class="comment ? 'border-b-4 border-cyan-400' : '' " class="py-3 ml-4 font-bold text-1xl md:text-2xl md:ml-6 hover:cursor-pointer">Add comment</h2>
            </div>
            <div class="py-3 text-lg font-semibold md:text-1xl hover:cursor-pointer" x-on:click="expand" x-show="updates"><span x-text="operator" class="hidden px-2 text-lg font-bold border-2 md:inline-block md:border-slate-400"></span><span class="ml-2 text-lg" x-text="message"></span></div>
        </div>

        <div class="mt-5">
            <div x-transition.duration.500ms x-show="updates">
                @foreach($comments as $comment)
                    <div wire:key="{{$comment->id}}" @if($loop->first) x-data="{ openComment: true, newEditor: false, kbOpen: false }" @else
                        x-data="{ openComment: false, newEditor: false, kbOpen: false }" @endif
                        class="p-5 mt-3 border-2 shadow rounded-t-xl">
                        <div class="flex flex-wrap items-center justify-between hover:cursor-pointer" x-on:click="openComment = ! openComment">
                            <div>
                                <div class="flex items-center">
                                
                                    <x-avatar :colour="$comment->user->my_avatar->colour" :name="$comment->user->name">
                                        {{$comment->user->name}}
                                    </x-avatar>
                                    @if($comment->isMyComment() && $loop->first)
                                    <div x-transition.duration.500ms class="ml-3 hover:cursor-pointer" x-show="openComment && !newEditor" x-on:click="createNewEditor({{$comment->id}}); newEditor = ! newEditor"><svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="20px" height="20px">    <path d="M 22.828125 3 C 22.316375 3 21.804562 3.1954375 21.414062 3.5859375 L 19 6 L 24 11 L 26.414062 8.5859375 C 27.195062 7.8049375 27.195062 6.5388125 26.414062 5.7578125 L 24.242188 3.5859375 C 23.851688 3.1954375 23.339875 3 22.828125 3 z M 17 8 L 5.2597656 19.740234 C 5.2597656 19.740234 6.1775313 19.658 6.5195312 20 C 6.8615312 20.342 6.58 22.58 7 23 C 7.42 23.42 9.6438906 23.124359 9.9628906 23.443359 C 10.281891 23.762359 10.259766 24.740234 10.259766 24.740234 L 22 13 L 17 8 z M 4 23 L 3.0566406 25.671875 A 1 1 0 0 0 3 26 A 1 1 0 0 0 4 27 A 1 1 0 0 0 4.328125 26.943359 A 1 1 0 0 0 4.3378906 26.939453 L 4.3632812 26.931641 A 1 1 0 0 0 4.3691406 26.927734 L 7 26 L 5.5 24.5 L 4 23 z"/></svg></div>
                                    @endif
                                </div>
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

                        <div  x-on:click.outside="kbOpen = false" class="relative">
                            <x-kb-popup key="{{$comment->id}}"/>
                            <div x-transition.duration.300ms x-show="newEditor" class="flex justify-start border rounded-t-lg border-slate-900 bg-slate-800">
                                <div class="p-2 text-white border-r hover:text-slate-800 hover:cursor-pointer hover:bg-slate-200 border-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16"> <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/> </svg>
                                </div>
                                <div x-on:click="kbOpen = ! kbOpen; document.getElementById('kb-{{$comment->id}}').scrollIntoView();" class="p-2 text-white border-r hover:text-slate-800 hover:cursor-pointer hover:bg-slate-200 border-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16"> <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/> </svg></div>
                            </div>
                            <textarea class="hidden" id="comment{{$comment->id}}">{{$comment->comment}}</textarea>

                            <div x-transition.duration.500ms x-on:expand.window="openComment = $event.detail.expanded" x-show="!newEditor && openComment" class="p-6 border comments">
                                {!! $comment->comment !!}
                            </div>
                            
                            <button x-show="newEditor" x-on:click="updateComment({{$comment->id}});updates = true; comment = false; newEditor = false; kbOpen=false; destroyEditor({{$comment->id}})" class="mt-2 btn-primary">Update</button>
                            <button x-show="newEditor" x-on:click="updates = true; comment = false; newEditor = false; kbOpen=false; destroyEditor({{$comment->id}})" class="mt-2 btn-secondary">close</button>
                            
                        </div>
                    </div>
                @endforeach
            </div>
            <div x-data="{ kbOpen: false}" x-on:click.outside="kbOpen = false" class="relative">
                <x-kb-popup key="0"/>
                <div x-show="comment" class="flex justify-start border rounded-t-lg border-slate-900 bg-slate-800">
                    <div class="p-2 text-white border-r hover:text-slate-800 hover:cursor-pointer hover:bg-slate-200 border-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16"> <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/> </svg>
                    </div>
                    <div x-on:click="kbOpen = ! kbOpen; document.getElementById('kb-0').scrollIntoView();" class="p-2 text-white border-r hover:text-slate-800 hover:cursor-pointer hover:bg-slate-200 border-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16"> <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/> </svg></div>
                </div>
            </div>
            
            <div wire:ignore x-transition.duration.500ms x-show="comment">
                <textarea id="comment0">
                </textarea>
                <button x-on:click="new_comment();updates = true; comment = false" class="px-4 py-2 mt-3 btn-primary">Post</button>
                <button x-on:click="updates = true; comment = false" class="px-4 py-2 mt-3 btn-secondary">Cancel</button>
            </div>
            
        </div>

    @include('js.ckeditor')

    <script>

    
    createNewEditor(0)


    function page() {
        return {
            expanded : false,
            operator: '+',
            message: 'Expand',

            
            expand() {
                
                this.expanded = ! this.expanded
                this.expanded ? this.message = 'Compact' : this.message = 'Expand'
                this.expanded ? this.operator = '-' : this.operator = '+'
                
                this.$dispatch('expand', {'expanded': this.expanded})
            },

            tick(e) {
                var span = e.srcElement.childNodes[1]
                ticks = document.querySelectorAll('.ticks')
                ticks.forEach(element => element.classList.add("hidden"));
                span.classList.remove("hidden")
            },

        };
        }
    
        
        </script>
    </div>
</div>

