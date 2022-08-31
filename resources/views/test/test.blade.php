<x-new-layout>

<div x-data="page()">
    <input x-on:keyup.debounce.500ms="search"
        type="text"
        name="query"
        x-model="query"
    />
</div>
<script>
    function page() {
    return {
        query: '',
        async search() {

            try {
                const response = await axios.get("http://localhost:9000/api/search/" + this.query)
                console.log(response);
            }
            catch (error) {
                console.log(error);
            }
        }
    }
}
</script>
</x-new-layout>
