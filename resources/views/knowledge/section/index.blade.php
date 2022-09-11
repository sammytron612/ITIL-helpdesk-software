<x-app-layout>
    <div x-data="index()" class="px-5">
        <div class="grid  grid-cols=1 lg:grid-cols-12">
            <div class="col-span-6 col-start-6 text-left" x-init="loadSections">
                <h2 class="text-3xl text-left">Section title <button x-on:click="modalCreate = true" class="text-sm btn-primary">Create</button></h2>
                <template x-for="(section, index) in sections">
                    <div x-on:mouseleave="hoverLeave(index)" class="py-2 text-left">
                        <span class="text-2xl text-left text-blue-700 hover:cursor-pointer" x-on:mouseover="hoverMouse(index)" x-text="section.title">
                        </span>
                        <button :id="index" x-on:click="openModal(index)" class="hidden text-left " ><x-svg.pen/></button>
                    </div>
                </template>
            </div>
        </div>
        <div x-transition class="absolute top-0 left-0 flex items-center justify-center w-screen h-screen" x-show="modalUpdate">
            <div x-on:click.outside="modalUpdate = false" class="h-32 p-10 border border-gray-400 rounded shadow-md top-64 left-1/3 bg-gray-50">
                <input id="update" class="rounded" type="text" :value="title" />
                <button x-on:click="update" class="btn-primary">Update</button>
                <button x-on:click="modalUpdate = false" class="btn-secondary">Close</button>
            </div>
        </div>
        <div x-transition class="absolute top-0 left-0 flex items-center justify-center w-screen h-screen" x-show="modalCreate">
            <div x-on:click.outside="modalCreate = false" class="h-32 p-10 border border-gray-400 rounded shadow-md top-64 left-1/3 bg-gray-50">
                <input id="create" class="rounded" type="text" />
                <button x-on:click="create" class="btn-primary">Create</button>
                <button x-on:click="modalCreate = false" class="btn-secondary">Close</button>
            </div>
        </div>

        <div x-show="links" class="mt-10 pagination">
            <div class="flex items-center justify-center space-x-1">
                <template x-for="(link, index) in links" :key="index">
                    <button :disabled="link.active === true || !link.url" :class="link.active === true ? 'font-black text-black bg-yellow-400 border-yellow-500 border' :  'bg-slate-900 text-white'" x-on:click="loadSections(link.url)" x-html="link.label" class="flex items-center px-4 py-1 text-gray-700 rounded-md"></button>
                </template>
            </div>
        </div>
    </div>


<script>

    function index() {
        return {
            title: '',
            modalUpdate: false,
            modalCreate: false,
            loading: false,
            sections: [],
            links: {},
            arrayIndex: null,
            page: null,

            async loadSections(page) {
                if(!page){
                    url = "http://localhost:9000/api/section/index"}
                else{
                    url = page
                }

                try {

                        this.loading = true
                        const response = await axios.get(url)
                        this.sections = []
                        response.data.data.forEach(result => {
                            var temp = {}
                            temp.id = result.id
                            temp.href = "{{url('knowledge/show')}}" + "/" + result.id
                            temp.edit = "{{url('knowledge')}}" + "/" + result.id + '/edit'
                            temp.title = result.title
                            this.sections.push(temp)

                        });

                        this.loading = false

                        this.pagination(response.data)
                    }
                    catch (error) {
                        console.log(error);
                        this.loading = false
                    }

            },
            openModal(id) {
                this.title = this.sections[id].title
                this.modalUpdate = true
                this.arrayIndex = id;
            },
        async create()
        {
            el = document.getElementById('create')
            text = el.value


            try {

                    this.loading = true
                    const response = await axios.post("http://localhost:9000/api/section/create",
                                                        {},
                                                        {
                                                        params: {
                                                            text
                                                        }
                                                        }
                                                    )


                    this.sections = []
                    this.loadSections()
                    }
                    catch (error) {
                    console.log(error);
                    this.loading = false
                    }

                this.modalCreate = false

        },

         async update() {
                el = document.getElementById('update')
                text = el.value

                id = this.sections[this.arrayIndex]['id']
                oldText = this.sections[this.arrayIndex]['title']

                if(text != oldText){
                    try {

                            this.loading = true
                            const response = await axios.put("http://localhost:9000/api/section/update/"+ id,
                                                                {},
                                                                {
                                                                params: {
                                                                    text
                                                                }
                                                                }
                                                            )


                            this.sections = []
                            this.loadSections()
                            }
                            catch (error) {
                            console.log(error);
                            this.loading = false
                            }

                }

                this.modalUpdate = false
            },

            hoverMouse(id){
               el = document.getElementById(id)
               el.classList.remove('hidden')
               return

            },
            hoverLeave(id){
               el = document.getElementById(id)
               el.classList.add('hidden')
               return

            },

            pagination(links){
                this.links = links.links

                return
            },

        }
    }
</script>
</x-app-layout>
