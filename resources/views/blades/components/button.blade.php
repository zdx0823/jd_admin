@php

    $typeColorMap = [
        'danger' => 'text-white bg-red-500  hover:bg-red-600',
        'success' => 'text-white bg-green-500  hover:bg-green-600',
        'info' => 'text-black bg-gray-500  hover:bg-gray-600',
        'primary' => 'text-white bg-blue-500  hover:bg-blue-600',
        'warning' => 'text-white bg-orange-500  hover:bg-orange-600',
    ];

    $sizeMap = [
        'xs' => 'px-2 py-1/2',
        'sm' => 'px-3 py-1',
        'md' => 'px-4 py-2',
    ];

    $type = isset($type) ? $type : '';
    $type = in_array($type, [
        'danger',
        'success',
        'info',
        'warning',
        'primary',
    ]) ? $type : 'info';

    $size = isset($size) ? $size : '';
    $size = in_array($size, [
        'xs',
        'sm',
        'md'
    ]) ? $size : 'sm';

    $color = $typeColorMap[$type];
    $spacing = $sizeMap[$size];

    $submit = isset($submit) ? $submit : false;

@endphp

@if ($submit === true)

    <input class="
        outline-none
        rounded-sm
        {{$spacing}}
        {{$color}}
    " type="submit" value="{{$value}}">

@else

    <button class="
        outline-none
        rounded-sm
        {{$spacing}}
        {{$color}}
    ">
        {{$value}}
    </button>
@endif

