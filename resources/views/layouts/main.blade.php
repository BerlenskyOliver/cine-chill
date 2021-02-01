<!DOCTYPE html>
<html lang={{ LaravelLocalization::getCurrentLocale() }}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cine Chill</title>
    <link rel="preload" href="/css/main.css" as="style">
    <link rel="preload" href="/js/app.js" as="script">
    <link rel="stylesheet" href="/css/main.css">
    @livewireStyles
    <script src="/js/app.js"></script>
</head>

<body class="font-sans  text-white" style="background: #111">
    <div class="text-black bg-white hidden"></div>
    @livewire('components.nav')
    <div>
        @yield('content')
    </div>
    @livewireScripts
    
    @yield('scripts')
</body>
</html>