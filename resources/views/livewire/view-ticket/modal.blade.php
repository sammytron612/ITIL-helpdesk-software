<div x-data="{showModal: @entangle('viewModal')}" class="flex justify-self-center z-99">
    <div x-show="showModal">
        <div class="fixed inset-0 flex flex-col items-center w-full h-full overflow-y-auto bg-opacity-50 bg-slate-800">
            <div style="margin-top:10%" @click.outside="showModal = false" class="px-8 py-8 text-center bg-white rounded-md w-96">
                <h1 class="mb-4 text-xl font-bold text-slate-500">Search</h1>
                <input class="w-full rounded" wire:model.debounce300ms="searchTerm" type="search" />

                <hr>
                @if($userResults || $groupResults)
                    <div class="mt-1 font-bold text-1xl">Results</div>
                    @if($userResults)
                        <div class="py-3">
                            <ul>
                                @foreach($userResults as $result)
                                    <button wire:click="assignToUser({{$result->id}})" class="w-full p-1 text-left hover:bg-slate-200"><li>{{$result->name}}</li></button>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if($groupResults)
                        <div class="py-3">
                            <ul>
                                @foreach($groupResults as $group)
                                    <button wire:click="assignToGroup({{$group->id}})" class="w-full p-1 text-left hover:bg-slate-200"><li>{{$group->name}}</li></button>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
