<!DOCTYPE html>
<html lang="en" class="bg-gray-200 h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>JD-管理员后台</title>
    <style>
        .logo {
            width: 190px;
            height: 120px;
            background: url('/img/logo.png') no-repeat 0 0;
            overflow: hidden;
            text-indent: -9999px;
        }
    </style>
</head>
<body class="h-full flex flex-col">
    
    {{-- 头 --}}
    <div class=" h-32 border-b bg-white">
        
        {{-- logo，标题 --}}
        <div class="w-10/12 h-full mx-auto flex justify-between">
            <div class="flex items-center">
                <a href="" class="logo">京东</a>
                <span class="text-lg font-extrabold text-gray-800 self-end mb-4">@yield('title', '管理员后台')</span>
            </div>
            @if (isset($isLogged) && $isLogged === true)
                
                <div class="self-end mb-3">
                    <a href="{{route('logout')}}">
                        
                        @include('blades.components.button', [
                            'value' => '退出登录',
                            'type' => 'primary',
                        ])
                    </a>
                </div>
            @endif
        </div>

    </div>

    {{-- 内容 --}}
    <div class="w-10/12 flex-1 flex flex-col mx-auto mt-3">
        @yield('content')
    </div>
    
<script src="{{mix('js/manifest.js')}}"></script>
<script src="{{mix('js/vendor.js')}}"></script>
@yield('js')
</body>
</html>