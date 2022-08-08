<div x-data="page()">
    <div x-data="{ updates: true, comment: false}">
        <div class="flex flex-wrap justify-center mt-5 md:justify-between">
            <div class="flex">
                <h2 x-on:click="updates = true; comment = false" :class="updates ? 'border-b-4 border-cyan-400' : '' " class="py-3 font-bold text-1xl md:text-2xl hover:cursor-pointer">Updates ({{count($comments)}})</h2>
                <h2 x-on:click="updates = false; comment = true" :class="comment ? 'border-b-4 border-cyan-400' : '' " class="py-3 ml-4 font-bold text-1xl md:text-2xl md:ml-6 hover:cursor-pointer">Add comment</h2>
            </div>
            <div class="py-3 ml-2 text-lg font-semibold md:text-1xl md:ml-0 hover:cursor-pointer" x-on:click="expand" x-show="updates"><span x-text="operator" class="px-2 font-bold border-2 md: border-slate-400"></span><span class="ml-2" x-text="message"></span></div>
        </div>

        <div class="mt-5">
            <div x-transition x-show="updates">
                @foreach($comments as $comment)
                    <div wire:key="{{$comment->id}}" x-data="{ openComment: false }"  class="p-5 border-2 shadow rounded-t-xl">
                        <div class="flex flex-wrap items-center justify-between hover:cursor-pointer" x-on:click="openComment = ! openComment">
                            <div>
                                <x-avatar :colour="$ticket->requesting_user->my_avatar->colour" :name="$ticket->requesting_user->name">
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
                        
                        <div x-transition.duration.500ms x-on:expand.window="openComment = $event.detail.expanded" x-show="openComment" class="p-6 border">
                            {!! $comment->comment !!}
                        </div>
                    </div>
                @endforeach
            </div>

            <div wire:ignore x-transition x-show="comment">
                
                <textarea id="new-comment">
                </textarea>
                <button x-on:click="get_comment(3);updates = true; comment = false" class="px-4 py-2 mt-3 text-white bg-blue-500 rounded hover:bg-blue-400">Post</button>

            </div>
        </div>

    <script src="https://cdn.tiny.cloud/1/d3utf658spf5n1oft4rjl6x85g568jj7ourhvo2uhs578jt9/tinymce/5/tinymce.min.js"
            referrerpolicy="origin">
    </script>

    <script>


        function page() {
        return {
            expanded : false,
            operator: '+',
            message: 'Expand All',
            expand() {
                
            this.expanded = ! this.expanded
            this.expanded ? this.message = 'Compact All' : this.message = 'Expand All'
            this.expanded ? this.operator = '-' : this.operator = '+'
            
            this.$dispatch('expand', {'expanded': this.expanded})
            },
        };
        }
    


        function get_comment(id)
            {
                comment = tinymce.get("new-comment").getContent();
                console.log(comment)
                @this.set('comment',comment)
            }
        
            tinymce.init({

            setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    })
                },
            forced_root_block : 'p',
            forced_root_block_attrs: { "class": "py-3"},
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
    </div>
</div>

