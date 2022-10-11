<div class="px-5 lg:px-0" x-data="category">
    <div class="w-full mx-auto text-left lg:w-2/3">
        <label class="text-lg font-bold">Activate this collection of rules</label>
        <input class="ml-2" {{$categoryActive ? 'checked' : ''}} wire:model="categoryActive" type="checkbox" />
    </div>
    <article class="w-full mx-auto mt-3 text-left lg:w-2/3">Map each category group to a ticket group. When tickets are created they will be automatically assigned to that group depending on how they were categorized</article>
    <div class="w-full mx-auto mt-5 overflow-y-auto h-96 lg:w-2/3">
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
                            @if(isset($rules))
                                @foreach($rules as $rule)
                                    @if($rule->category == $category->id)
                                        <div x-show="!openSelect">{{$rule->group}}</div>
                                    @endif
                                @endforeach
                            @endif
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




    <div x-data="{showMethods: @entangle('autoAllocate')}" class="w-full px-5 mx-auto mt-10 lg:w-2/3 lg:px-0">
        <article class="w-full mx-auto mb-5 text-left">Auto allocation is optional. If chosen, then tickets will be automatically allocated to agents who are a member of the respective group in either round robin fashion or agents with the least open tickets.
            If no method is chosen then the default method is round robin
        </article>
        <label for="check" class="text-lg font-bold">Auto allocation</label>
        <input {{$autoAllocate ? 'checked' : ''}} wire:model.debounce500ms='autoAllocate'  id="check" type="checkbox" />
        <div class="mt-3 font-bold text-1xl" x-show="showMethods">
            <div>
                <label for="check1">Round Robin</label>
                <input {{$robin ? 'checked disabled' : ''}} wire:model.debounce500ms='robin' id="check1" type="checkbox" />
            </div>
            <div>
                <label for="check2">Least tickets</label>
                <input {{$least ? 'checked disabled' : ''}} wire:model.debounce500ms='least' id="check2" type="checkbox" />
            </div>
        </div>
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

