<div x-data="category">
    <div class="overflow-auto">
        <table class="mx-auto">
            <thead>
                <th class="text-left w-4 border-b border-gray-500"></th>
                <th class="text-left w-96 text-lg border-b border-gray-500">Category</th>
                <th class="text-left w-96 text-lg border-b border-gray-500">Group</th>
                <th class="text-left w-4 border-b border-gray-500"></th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="pt-2" x-data="{openSelect: false}" x-on:click.outside="openSelect = false">
                        <td></td>
                        <td class="pt-3"><button class="hover:text-blue-700 hover:font-bold font-semibold" x-on:click="openSelect = true; categoryChoice({{$category->id}})" class="text-lg font-bold">{{$category->name}}</button></td>
                        <td class="pt-3" x-data="{choice: null}">
                            <select x-model="choice" x-show="openSelect" x-on:change="openSelect = false; groupChoice(choice)" class="py-1 px-5 rounded-md w-64">
                                <option value="" selected>choose</option>
                                @foreach($groups as $group)
                                    <option value="{{$group->name}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                            <div class="font-semibold" x-show="!openSelect" x-text="choice"></div>
                        </td>
                        <td></td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>




    <div class="text-center mt-10">
        <div>Auto allocation yes or no</div>
        <input type="checkbox" />
        <div>Allocation Method</div>
        <div>Round Robin</div>
        <div>Least tickets</div>
    </div>

    <script>
        function category(){
            return {
                category: null,
                group: null,

                categoryChoice(id){
                    this.group = null
                    this.category = id
                    this.completeCheck()
                    return
                },

                groupChoice(choice){
                    this.group = choice
                    this.completeCheck()
                    return
                },
                completeCheck(){
                    if(this.category && this.group)
                    {
                        @this.addRule(this.category,this.group)
                    }
                    return

                },

            }
        }
    </script>
</div>

