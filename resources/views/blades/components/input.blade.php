@php
    
    $value = isset($value) ? $value : '';
    $placeholder = isset($placeholder) ? $placeholder : '请在此输入内容';

    $type = isset($type) ? $type : 'text';
    $type = in_array($type, [
        'text',
        'email',
        'password'
    ]) ? $type : 'text';

    $name = isset($name) ? $name : 'default';

@endphp

<div class="flex h-12 divide-x border rounded-lg overflow-hidden">

    {{-- 图标 --}}
    <div class="w-12 h-12 flex justify-center items-center">
        <span class="iconfont iconyanzhengma text-gray-500"></span>
    </div>

    {{-- 输入框 --}}
    <div class="flex-1">
        <input
            name="{{$name}}"
            type="{{$type}}"
            value="{{$value}}"
            placeholder="{{$placeholder}}"
            class="block text-gray-900 text-sm w-full h-full px-3 outline-none"
        >
    </div>
</div>