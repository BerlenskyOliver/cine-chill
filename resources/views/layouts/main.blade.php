<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie App</title>
    <link rel="stylesheet" href="/css/main.css">
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
</head>
{{-- bg-gray-900 --}}
<body class="font-sans  text-white" style="background: #111">
    @livewire('components.nav')



    <div class="py-6">
        @yield('content')
    </div>
    @livewireScripts
    
 
</body>
</html>