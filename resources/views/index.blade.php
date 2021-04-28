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
            <span class="text-lg font-extrabold text-gray-800 self-end mb-4">主页</span>
        </div>

    </div>

    {{-- 内容 --}}
    <div class="w-10/12 flex-1 flex flex-col mx-auto mt-3">
    {{-- 头 --}}
        <div class="h-10 leading-10 bg-white rounded-t-md text-center text-sm font-extrabold">请选择操作</div>

        {{-- 内容 --}}
        <div class="mt-3 mb-3 flex-1 bg-white rounded-md px-3 py-3">
            <x-tag>设置轮播图</x-tag>
            <x-tag>商家申请审核</x-tag>
        </div>
    </div>
    
</body>
</html>