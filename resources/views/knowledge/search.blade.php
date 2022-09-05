<x-app-layout>

    <div x-data="search()" class="px-5">
        <div class="w-full px-5 mx-auto md:w-2/3 ">
            <label class="relative block">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-svg.magnify />
                </span>
                <input x-on:keydown.debounce="search" type="search" name="query" x-model="query"
                    class="w-full py-2 pl-10 pr-4 bg-white border rounded-full placeholder:font-italitc border-slate-300 focus:outline-none"
                    placeholder="Search KB Articles" type="text" />
            </label>
        </div>
    </div>

<script>
    function search() {
        return {
            query:null,


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




        };
    }
</script>
</x-app-layout>
