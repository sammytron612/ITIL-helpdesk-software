<div class="mt-4">
    <div class="mb-2 font-bold text-1xl">
        Status
    </div>
    <x-status :status="$incident->status">
        {{$incident->statuses->name}}
    </x-status>
    @if(Auth::user()->isAgent())
        <div class="mt-8">
            <label class="px-3 py-1 mt-4 mb-2 text-xl font-bold border rounded-lg bg-slate-100 border-slate-300">Action</label>
            <select wire:model="chosenAction" id="ticket-status" class="w-2 px-4 py-1 border-0 hover:cursor-pointer focus:border-0 focus:ring-0">
                <option selected disabled class="bg-white" value="0"></option>
                @foreach($status_actions as $action)
                    @if($action->action == "Assign to me")
                        @if(Auth::id() != $incident->assigned_to)
                            <option class="bg-white" value="{{ $action->id }}">{{ $action->action }}</option>
                        @endif
                        @else
                        <option class="bg-white" value="{{ $action->id }}">{{ $action->action }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    @endif
</div>
