@extends('layouts.default')
@section('title', '主页')
@section('content')
    
    <div>
        {{-- 头 --}}
        <div class="h-10 leading-10 bg-white rounded-t-md text-center text-sm font-extrabold">请选择操作</div>

        {{-- 内容 --}}
        <div class="mt-3 mb-3 flex-1 bg-white rounded-md px-3 py-3">
            <x-tag>设置轮播图</x-tag>
            <x-tag>商家申请审核</x-tag>
        </div>
        
    </div>
    
@endsection