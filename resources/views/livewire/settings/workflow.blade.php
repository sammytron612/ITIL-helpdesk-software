<div class="grid justify-center grid-cols-2 gap-x-4 gap-y-10">
    <div class="col-span-2 text-center">
        <div class="text-lg font-bold">Default fallback Group </div>
        <div>
            <select class="w-56 mt-5 rounded" wire:model="default">
                <option value="" selected disabled>Choose</option>
                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-span-1 mx-auto">
        <div class="w-64 text-left">
            <a class="{{$location ? 'text-blue-700' : ''}} text-lg font-bold hover:text-blue-700" href="{{route('locationBased')}}">Location based allocation <input class="ml-2" disabled wire:model="location" type="checkbox" /></a>
            <p class="py-1 border-t border-gray-500">The ticket will be allocated to the group designated by the location field when the ticket is created.</p>
        </div>
    </div>



    <div class="col-span-1 mx-auto">
        <div class="w-64 text-left">
            <a class="hover:text-blue-700 text-lg font-bold {{$category ? 'text-blue-700' : ''}}" href="{{route('categoryBased')}}">Category based allocation<input class="ml-2" disabled wire:model="category" type="checkbox" /></a>
            <p class="py-1 border-t border-gray-500">The ticket will be allocated to the group designated by the category field when the ticket is created.</p>
        </div>
    </div>



</div>
