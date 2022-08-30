@php
//dd($status);
    switch ($status) {
        case 'New':
            $class = "px-2 py-1 bg-blue-200 border border-blue-300 rounded-lg";
            break;
        case 'Assigned':
            $class = "px-2 py-1 bg-yellow-200 border border-yellow-300 rounded-lg";
            break;
        case 'Resolved':
            $class = "px-2 py-1 bg-purple-200 border border-purple-300 rounded-lg";
            break;
        case 'Awaiting user information':
            $class = "px-2 py-1 bg-purple-200 border border-purple-300 rounded-lg";
            break;
        case 'Awaiting vendor information':
            $class = "px-2 py-1 bg-green-200 border border-green-300 rounded-lg";
            break;
        case 'Pending':
            $class = "px-2 py-1 border rounded-lg bg-cyan-200 border-cyan-300";
            break;
        case 'On hold':
            $class = "px-2 py-1 bg-teal-200 border border-teal-300 rounded-lg";
            break;
        case '8':
            $class = "px-2 py-1 rounded-lg bg-amber-200";
            break;

        default:
            $class="px-2 py-1 bg-gray-200 border border-gray-300 rounded-lg";
            break;
    }

@endphp
<div>
    <span {{ $attributes->merge(['class' => $class]) }}>{{ $slot}}</span>
</div>
