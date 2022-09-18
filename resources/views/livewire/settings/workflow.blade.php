<div class="grid grid-cols-2 gap-x-4  gap-y-10 justify-center">
    <div class="col-span-2 text-center">
        <div>Default fallback Group </div>
        <div>
            <select class="rounded w-56 mt-5" wire:model="default">
                <option value="" selected disabled>Choose</option>
                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-span-1 mx-auto">
        <div class="text-left w-64">
            <a class="hover:text-blue-700 text-lg font-bold" href="{{route('locationBased')}}">Location based allocation <input class="ml-2" disabled wire:model="location" type="checkbox" /></a>
            <p class="border-t border-gray-500 py-1">The ticket will be allocated to the group designated by the location field when the ticket is created.</p>
        </div>
    </div>



    <div class="col-span-1 mx-auto">
        <div class="text-left w-64">
            <a class="hover:text-blue-700 text-lg font-bold" href="{{route('categoryBased')}}">Category based allocation<input class="ml-2" disabled wire:model="category" type="checkbox" /></a>
            <p class="border-t border-gray-500 py-1">The ticket will be allocated to the group designated by the category field when the ticket is created.</p>
        </div>
    </div>



</div>
