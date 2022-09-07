<x-app-layout>

    <div x-data="search()" class="px-5">
        <div class="w-full px-5 mx-auto md:w-2/3 ">
            <label class="relative block">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-svg.magnify />
                </span>
                <input x-on:keydown.debounce="search()" type="search" name="query" x-model="query"
                    class="w-full py-2 pl-10 pr-4 bg-white border rounded-full placeholder:font-italitc border-slate-300 focus:outline-none"
                    placeholder="Search KB Articles" type="search" />
            </label>
        </div>
        <div class="relative">
            <div x-show="loading" class="absolute flex mt-5 text-2xl -translate-x-1/2 top-10 left-1/2">
                <div class="w-16 h-16 border-b-2 border-blue-900 rounded-full animate-spin"></div>
            </div>
        </div>
        <div x-show="nothing" class="w-full mx-auto mt-5 prose max-w-none md:w-2/3">
            <h2 class="text-center">No results</h2>
            <p class="font-bold">Your search did not match any documents</p>
            <p class="font-semibold">Suggestions</p>
            <ul class="font-semibold">
                <li>Make sure all words are spelled correctly</li>
                <li>Try different, more general, or fewer keywords</li>
            </ul>
        </div>
        <div x-show="hasResults" :class="loading ? 'opacity-40' : ''" class="w-full p-5 px-8 mx-auto mt-8 border-2 border-gray-100 rounded-md shadow-md md:w-5/6">
            <div class="text-3xl text-left"><i class="mr-2 fa-sharp fa-sm fa-solid fa-list"></i>Results</div>
            <div class="mt-5">
                <template x-for="article in articles">
                    <div class="mb-5">
                        <a  class="hover:cursor-pointer" :href="article.href"><h2 class="mt-2 text-3xl text-blue-600" x-html="article.title"></h2></a>
                        <div class="mt-1 text-sm font-light">
                            <span class="text-sm"><i class="mr-1 fa-solid fa-user"></i>Author</span>
                            <span class="text-1xl" x-text="article.author"></span><span> - </span>
                            <span><i class="ml-2 mr-1 fa-solid fa-eye"></i>Views</span>
                            <span class="ml-1 text-1xl" x-text="article.views"></span><span> - </span>
                            <span><i class="ml-2 mr-1 fa-solid fa-calendar"></i>Created</span>
                            <span class="ml-1 text-1xl" x-text="article.created_at"></span><span> - </span>
                            <span><i class="ml-2 mr-1 fa-solid fa-book-open"></i></i>KB</span>
                            <span class="ml-1 text-1xl" x-text="article.kb"></span>
                        </div>
                    </div>
                </template>
            </div>
            <div x-show="links" class="mt-10 pagination">
                <div class="flex items-center space-x-1">
                    <template x-for="(link, index) in links">
                            <button  :disabled="link.active === true || !link.url" :class="link.active === true ? 'font-black text-gray-200 bg-gray-800' : 'bg-yellow-400 border border-yellow-500 text-black'" x-on:click="search(link.url)" x-html="link.label" class="flex items-center px-4 py-1 text-gray-700 rounded-md"></button>
                    </template>
<!--
                    <a href="#" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md">
                        Previous
                    </a>

                    <a href="#" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white">
                        1
                    </a>
                    <a href="#" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white">
                        2
                    </a>
                    <a href="#" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white">
                        3
                    </a>
                    <a href="#" class="px-4 py-2 font-bold text-gray-500 bg-gray-300 rounded-md hover:bg-blue-400 hover:text-white">
                        Next
                    </a> -->
                </div>
            </div>
        </div>
    </div>


<script>

    function search() {
        return {
            query:null,
            loading: false,
            hasResults: false,
            nothing: false,
            articles: [],
            links: {},
            page: null,

            async search(page) {
                if(!page){
                    url = "http://localhost:9000/api/search/" + this.query}
                else{
                    url = page
                }
                if(this.query.length > 3)
                {
                    try {
                        console.log(url)
                        this.loading = true
                        const response = await axios.get(url)
                        this.articles = []
                        response.data.data.forEach(result => {
                            var temp = {}
                            temp.id = result.id
                            temp.href = "{{url('kb')}}" + "/" + result.id
                            temp.title = this.underlineQuery(result.article_title, this.query)
                            temp.author = result.author_name
                            temp.views = result.views
                            temp.kb = result.kb

                            let createdAt = moment(result.created_at)
                            temp.created_at = createdAt.fromNow()

                            this.articles.push(temp)

                        });


                        this.articles.length == 0 ? this.nothing = true : this.nothing = false
                        this.articles.length > 0 ? this.hasResults = true : this.hasResults = false

                        this.loading = false

                        this.pagination(response.data)
                    }
                    catch (error) {
                        console.log(error);
                        this.loading = false
                    }
                } else
                {
                    this.articles = []
                    this.nothing = false
                    this.articles.length > 0 ? this.hasResults = true : this.hasResults = false
                }
            },

            pagination(links){
                console.log(links)
                this.links = links.links

                return
            },

            underlineQuery(words, query) {
                //var title = words.toLowerCase().replace(query.toLowerCase(), '<u>' + query + '</u>').capitalize();

                var title = words.toLowerCase().replace(query.toLowerCase(), '<u>' + query + '</u>');


                return title
            },

        }
    }
</script>
</x-app-layout>
