@php
    switch ($status) {
        case '1':
            $class = "px-2 py-1 bg-blue-200 rounded-lg";
            break;
        case '2':
            $class = "px-2 py-1 bg-yellow-200 rounded-lg";
            break;
        case '3':
            $class = "px-2 py-1 bg-purple-200 rounded-lg";
            break;
        case '4':
            $class = "px-2 py-1 bg-green-200 rounded-lg";
            break;
        case '5':
            $class = "px-2 py-1 rounded-lg bg-deep-purple-200";
            break;
        case '6':
            $class = "px-2 py-1 rounded-lg bg-cyan-200";
            break;
        case '7':
            $class = "px-2 py-1 bg-teal-200 rounded-lg";
            break;
        case '8':
            $class = "px-2 py-1 rounded-lg bg-amber-200";
            break;

        default:
            $class="px-2 py-1 bg-gray-200 rounded-lg";
            break;
    }

@endphp
<div>
    <span {{ $attributes->merge(['class' => $class]) }}>{{ $slot}}</span>
</div>
