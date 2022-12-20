<x-app-layout>
    <div class="px-5 lg:px-20" x-data="showAll()">
        <div class="relative">
            <div x-show="loading" class="absolute flex mt-5 text-2xl -translate-x-1/2 top-10 left-1/3">
                <div class="w-16 h-16 border-b-2 border-blue-900 rounded-full animate-spin"></div>
            </div>
        </div>

        <div x-init="initializeAll()" class="w-full px-8 mx-auto mt-8 p">
            <div class="grid grid-cols-1 gap-x-2 gap-y-2 lg:grid-cols-3">
                <div class="col-span-1 md:col-span-2">
                    <div class="mb-3 text-3xl text-left"><i class="mr-2 fa-sharp fa-sm fa-solid fa-list"></i>Results</div>
                    <template x-for="(article, index) in articles">
                        <div :class="loading ? 'opacity-40' : ''" class="mb-5">

                            <div class="flex items-center">
                            <a class="hover:cursor-pointer" :href="article.href"><span class="text-2xl text-blue-600 capitalize-first" x-html="article.title"></span></a>
                                <a class="ml-2" :href="editUrl(article.id)"><x-svg.pen /></a>
                            </div>
                            <div class="mt-1 text-sm font-light text-gray-500">
                                <span class="text-sm"><i class="mr-1 fa-solid fa-user"></i></span>
                                <span class="text-1xl" x-text="article.author"></span><span> - </span>
                                <span class="text-sm">Section&nbsp</span>
                                <span class="text-blue-700 text-1xl" x-text="article.section"></span><span> - </span>
                                <span><i class="ml-2 mr-1 fa-solid fa-eye"></i></span>
                                <span class="ml-1 text-1xl" x-text="article.views"></span><span></span>
                                <div>
                                    <span><i class="mr-1 fa-solid fa-calendar"></i></span>
                                    <span class="ml-1 text-1xl" x-text="article.created_at"></span><span> - </span>
                                    <span><i class="ml-2 mr-1 fa-solid fa-book-open"></i></i>KB</span>
                                    <span class="ml-1 text-1xl" x-text="article.kb"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div x-show="links" class="mt-10 pagination">
                        <div class="flex items-center space-x-1">
                            <template x-for="(link, index) in links" :key="index">
                                <button :disabled="link.active === true || !link.url" :class="link.active === true ? 'font-black text-black bg-yellow-400 border-yellow-500 border' :  'bg-slate-900 text-white'" x-on:click="allArticles(link.url)" x-html="link.label" class="flex items-center px-4 py-1 text-gray-700 rounded-md"></button>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="hidden col-span-1 lg:block">
                    <div class="shadow-xl">
                        <h1 class="p-3 text-white bg-green-700 border-t-md rounded-t-md">5 Most recent</h2>
                        <div class="px-4 py-3 border border-green-700 rounded-b-md">
                            <template x-for="(article, index) in recent">
                                <div class="flex items-center mb-1">
                                    <a class="hover:cursor-pointer" :href="articleUrl(article.id)"><h2 class="mt-2 font-bold text-green-600 text-1xl capitalize-first" x-text="article.title"></h2></a>
                                    <div class="mt-1 text-sm font-light">
                                        <span>&nbsp-&nbsp<i class="ml-2 mr-1 fa-solid fa-calendar"></i></span>
                                        <span class="ml-1 text-1xl" x-text="diffFor(article.created_at)"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="mt-5 shadow-xl">
                        <h1 class="p-3 text-white bg-blue-700 border-t-md rounded-t-md">5 Most viewed</h2>
                            <div class="px-4 py-3 border border-blue-700 rounded-b-md">
                                <template x-for="(article, index) in viewed">
                                    <div class="flex items-center mb-1">
                                        <a class="hover:cursor-pointer" :href="articleUrl(article.id)"><h2 class="mt-2 font-bold text-blue-600 text-1xl capitalize-first" x-text="article.title"></h2></a>
                                        <div class="mt-1 text-sm font-light">
                                            <span>&nbsp-&nbsp<i class="ml-2 mr-1 fa-solid fa-eye"></i></span>
                                            <span class="ml-1 text-1xl" x-text="article.views"></span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<script>

function showAll() {
        return {
            query:null,
            loading: false,
            viewed: [],
            recent: [],
            nothing: false,
            articles: [],
            links: {},
            page: null,

            initializeAll(){
                this.allArticles()
            },

            async allArticles(page) {
                if(!page){
                    url = "http://localhost:9000/api/all"}
                else{
                    url = page}

                    try {
                        console.log(url)
                        this.loading = true
                        const response = await axios.get(url)
                        console.log(response.data.articles)
                        this.articles = []
                        response.data.articles.data.forEach(result => {
                            var temp = {}
                            temp.id = result.id
                            temp.href = "{{url('kb')}}" + "/" + result.id
                            temp.title = result.article_title
                            temp.author = result.author_name
                            temp.section = result.section_title
                            temp.views = result.views
                            temp.kb = result.kb

                            let createdAt = moment(result.created_at)
                            temp.created_at = createdAt.fromNow()
                            this.articles.push(temp)
                        });

                        this.loading = false
                        this.pagination(response.data.articles)
                        this.viewed = response.data.viewed
                        this.recent = response.data.recent


                        return
                    }
                    catch (error) {
                        console.log(error);
                        this.loading = false
                    }
            },

            pagination(links){

                this.links = links.links
                return
            },

            diffFor(e)
            {
                let createdAt = moment(e)
                diff = createdAt.fromNow()
                return diff
            },
            articleUrl(e){
                return  "{{url('kb')}}" + "/" + e
            },

            editUrl(e){
                return  "{{url('kb')}}" + "/" + e + '/edit'
            },

        }
    }
</script>


</x-app-layout>

