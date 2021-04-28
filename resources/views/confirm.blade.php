@extends('layouts.default')
@section('title', '邮箱验证')

@section('content')

@if (count($errors->all()) > 0 || session('codeErr'))
    
    <p class="bg-orange-500 py-2 px-6 rounded-sm my-3 text-white">验证码错误，请重新填写</p>
@endif


<div class="w-full h-full bg-white flex flex-col py-20">

    {{-- 标题 --}}
    <div class="
        w-4/6 bg-white mx-auto
        text-gray-900 text-center text-sm font-extrabold
        h-10 leading-10
        border rounded-t-md
    ">请输入邮箱验证码</div>

    {{-- 内容 --}}
    <div class="
        flex-1
        w-4/6 mx-auto
        border-t-0
        rounded-b-md border
        py-10
    ">
        <form action="{{route('api_confirmCode')}}" method="POST">

            <div class="w-10/12 mx-auto h-full flex flex-col justify-start">
                <div>
                    @include('blades.components.input', [
                        'placeholder' => '请输入邮箱验证码',
                        'name' => 'code',
                        'value' => session('code'),
                    ])
                </div>
                
                <div class="mt-6 self-end">
                    @include('blades.components.button', [
                        'type' => 'danger',
                        'value' => '确定',
                        'submit' => true,
                    ])
                </div>
            
            </div>

            @csrf
        </form>
    </div>

</div>

@endsection