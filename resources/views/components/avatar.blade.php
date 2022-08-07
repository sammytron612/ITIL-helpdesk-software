<div class="flex py-3">
    @php
        $names = explode(' ', $name);
        $first = ucfirst($names[0]);
        $last = ucfirst(end($names));
        $initials = $first[0] . $last[0];
        $colour = "bg-" .$colour."-500";
    @endphp
    <div class="hidden md:block p-3 text-white {{$colour}} rounded-full text-1xl">{{$initials}}</div>

    <div class="font-bold text-blue-500 md:p-3 text-1xl">
        {{ ucwords($slot) }}
    </div>
</div>