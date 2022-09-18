<div x-data="category">
    <div class="w-full mx-auto overflow-y-auto h-96 lg:w-2/3">
        <table class="mx-auto">
            <thead>
                <th class="w-4 text-left border-b border-gray-500"></th>
                <th class="text-lg text-left border-b border-gray-500 w-96">Category</th>
                <th class="text-lg text-left border-b border-gray-500 w-96">Group</th>
                <th class="w-4 text-left border-b border-gray-500"></th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="pt-2" x-data="{openSelect: false}" x-on:click.outside="openSelect = false">
                        <td></td>
                        <td class="pt-3"><button class="font-semibold hover:text-blue-700 hover:font-bold" x-on:click="openSelect = true; categoryChoice({{$category->id}})" class="text-lg font-bold">{{$category->name}}</button></td>
                        <td class="pt-3" x-data="{choice: null}">
                            @foreach($rules as $rule)
                                @if($rule->category == $category->id)
                                    <div x-show="!openSelect">{{$rule->group}}</div>
                                @endif
                            @endforeach
                            <select x-model="choice" x-show="openSelect" x-on:change="openSelect = false; groupChoice(choice)" class="w-64 px-5 py-1 rounded-md">
                                <option value="" selected>choose</option>
                                @foreach($groups as $group)
                                    <option value="{{$group->name}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>




    <div class="mt-10 text-center">
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

