<div x-data="page()">
    <div x-data="{ updates: false, comment: false, details: true}">
        <div class="flex flex-wrap items-center justify-between pt-5 pb-10">
            <div>
                <h2 x-on:click="updates = true; comment = false; details = false" :class="updates ? 'border-b-4 border-cyan-400' : '' " class="inline py-3 text-sm font-bold first-letter:py-3 hover:cursor-pointer">UPDATES ({{count($comments) - 1}})</h2>
                <h2 x-on:click="details = true; comment = false; updates = false" :class="details ? 'border-b-4 border-cyan-400' : '' " class="inline py-3 ml-4 text-sm font-bold hover:cursor-pointer">DETAILS</h2>
                <h2 x-on:click="updates = false; comment = true; details = false" :class="comment ? 'border-b-4 border-cyan-400' : '' " class="inline py-3 ml-4 text-sm font-bold md:ml-6 hover:cursor-pointer">ADD COMMENT</h2>
            </div>
            <div class="text-lg font-semibold md:text-1xl hover:cursor-pointer" x-on:click="expand" x-show="updates"><span x-text="operator" class="hidden px-2 text-sm font-bold border-2 md:text-1xl md:inline-block md:border-slate-400"></span><span class="ml-2 text-lg" x-text="message"></span></div>
        </div>
        <div>
            <div x-transition.duration.500ms x-show="details" class="flex justify-start text-sm md:justify-end">
                <div>Created by: {{$ticket->requested_by->name}},</div>
                <div class="md:ml-1">
                    {{ \Carbon\Carbon::parse($comments->last()->created_at)->diffForHumans()}},
                </div>
                <div class="ml-1">
                    {{ \Carbon\Carbon::parse($comments->last()->created_at)->format('d F Y g:i:A')}}
                </div>
            </div>
            <div x-transition.duration.400ms x-show="details" class="p-4 mt-2 mb-24 prose border-2 rounded-lg shadow-md max-w-none border-slate-300 ">
                {!! $comments->last()->comment !!}
            </div>
            <div x-transition.duration.400ms x-show="updates">
                @foreach($comments as $comment)
                    @if($loop->last) @continue @endif
                    @if(Auth::user()->isAgent() || (!Auth::user()->isAgent() && $comment->isPublic()))
                        <div @if($loop->first) x-data="{ openComment: true }" @else
                            x-data="{ openComment: false }" @endif
                            class="p-5 mt-3 border-2 shadow rounded-t-xl">
                            <div class="flex flex-wrap items-center justify-between hover:cursor-pointer" x-on:click="openComment = ! openComment">
                                <div>
                                    <div class="flex items-center">
                                        <x-avatar :colour="$comment->user->my_avatar->colour" :name="$comment->user->name">
                                            {{$comment->user->name}}
                                        </x-avatar>
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
                            <div class="relative">

                                <div clas x-show="openComment">
                                    <div x-transition.duration.400ms x-on:expand.window="openComment = $event.detail.expanded" class="p-6 prose border rounded-md shadow-md max-w-none arrow-top border-slate-400 comments">
                                        {!! $comment->comment !!}
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endif
                @endforeach
            </div>
            <div x-cloak x-data="{ kbOpen: false}" x-on:click.outside="kbOpen = false" class="relative">
                <x-kb-popup key="0"/>
                <div x-show="comment" class="flex justify-start border rounded-t-lg border-slate-900 bg-slate-800">
                    <div class="p-2 text-white border-r hover:text-slate-800 hover:cursor-pointer hover:bg-slate-200 border-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16"> <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/> </svg>
                    </div>
                    <div x-on:click="kbOpen = ! kbOpen; document.getElementById('kb-0').scrollIntoView();" class="p-2 text-white border-r hover:text-slate-800 hover:cursor-pointer hover:bg-slate-200 border-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16"> <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/> </svg></div>
                </div>

                <div x-cloak x-data="{ public: true }" wire:ignore x-transition.duration.500ms x-show="comment">
                    <textarea id="comment0">
                    </textarea>
                    <x-new-comment-buttons />
                </div>
            </div>

        </div>

    @include('js.ckeditor')

    <script>


    function page() {
        return {
            expanded : false,
            operator: '+',
            message: 'Expand',
            articleId: null,
            articleTitle: null,
            articles:null,
            query: null,
            body: null,

            async search() {
                if(this.query.length > 2)
                {
                    try {
                        const response = await axios.get("http://localhost:9000/api/search/" + this.query)
                        console.log(response.data.data);
                        this.articles = response.data.data
                    }
                    catch (error) {
                        console.log(error);
                    }
                } else
                {this.articles = null}
            },
            expand() {

                this.expanded = ! this.expanded
                this.expanded ? this.message = 'Compact' : this.message = 'Expand'
                this.expanded ? this.operator = '-' : this.operator = '+'

                this.$dispatch('expand', {'expanded': this.expanded})
            },

            async selectArticle(id,title){

                try {

                    const response = await axios.get("http://localhost:9000/api/show-body/" + id)
                    console.log(response.data.body)
                    this.body = response.data.body
                    this.articleId = id
                    this.articleTitle = title

                }
                catch (error) {
                    console.log(error);
                }

            },
            clearData()
            {
                this.query = null
                this.articleId = null
                this.articles = null
                this.body = null
                this.articleTitle = null
            },


        };
        }


        </script>
    </div>
    <div class="h-24"></div>
</div>

