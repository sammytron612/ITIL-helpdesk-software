@php
//dd($status);
    switch ($priority) {
        case '1':
            $class = "px-2 py-1 text-white bg-red-600 border border-red-700 rounded-lg";
            break;
        case '2':
            $class = "px-2 py-1 text-white bg-orange-400 border border-orange-500 rounded-lg";
            break;
        case '3':
            $class = "px-2 py-1 text-gray-900 bg-yellow-200 border border-yellow-300 rounded-lg";
            break;
        case '4':
            $class = "px-2 py-1 text-gray-900 bg-green-200 border border-green-300 rounded-lg";
            break;
        case 'Critical':
            $class = "px-2 py-1 text-white bg-red-600 border border-red-700 rounded-lg";
            break;
        case 'High':
            $class = "px-2 py-1 text-white bg-orange-400 border border-orange-500 rounded-lg";
            break;
        case 'Medium':
            $class = "px-2 py-1 text-gray-900 bg-yellow-200 border border-yellow-300 rounded-lg";
            break;
        case 'Low':
            $class = "px-2 py-1 text-gray-900 bg-green-200 border border-green-300 rounded-lg";
            break;

        default:
            $class="px-2 py-1 bg-gray-200 border border-gray-300 rounded-lg";
            break;
    }

@endphp
<div>
    <span {{ $attributes->merge(['class' => $class]) }}>{{ $slot}}</span>
</div>
