<div class="flex py-3">
    @php
        $names = explode(' ', $name);
        $first = ucfirst($names[0]);
        $last = ucfirst(end($names));
        $initials = $first[0] . $last[0];
    @endphp
    <div class="p-3 text-white bg-green-500 rounded-full text-1xl">{{$initials}}</div>

    <div class="p-3 font-bold text-blue-500 text-1xl">
        {{ ucwords($slot) }}
    </div>
</div>