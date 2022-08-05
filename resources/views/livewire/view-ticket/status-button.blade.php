<div class="mt-4">
    <div class="mb-2 font-bold text-1xl">
        Status
    </div>
    <x-status :status="$incident->status">
        {{$incident->statuses->status}}
    </x-status>
    
    
    <label class="block mt-4 mb-2 font-bold text-1xl">Action</label>
    <select wire:model="chosenAction" id="ticket-status" class="w-full px-4 py-1 bg-indigo-300 rounded-lg md:w-1/2">
        <option selected disabled class="bg-white" value="0">Choose</option>
        @foreach($status_actions as $action)
            <option class="bg-white" value="{{ $action->id }}">{{ $action->action }}</option>
        @endforeach
    </select>
</div>
