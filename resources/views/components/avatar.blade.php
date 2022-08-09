<div class="flex items-center py-3">
    @php
        $bg = "bg-" . $colour . "-700";
        $names = explode(' ', $name);
        $first = ucfirst($names[0]);
        $last = ucfirst(end($names));
        $initials = $first[0] . $last[0];
        ;
        
    @endphp
    <div class="hidden p-3 {{$bg}} text-white border border-green-600 rounded-full md:inline-block text-1xl">{{$initials}}</div>

    <div class="font-bold text-blue-500 md:p-3 text-1xl">
        {{ ucwords($slot) }}
    </div>
</div>