<!DOCTYPE html>
<html lang="en" class="bg-gray-200 h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        <div class="w-10/12 h-full mx-auto flex items-center justify-start">
            <a href="" class="logo">京东</a>
            <span class="text-lg font-extrabold text-gray-800 self-end mb-4">@yield('title', '管理员后台')</span>
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