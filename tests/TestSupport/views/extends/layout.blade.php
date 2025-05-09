<html>
<head>
    <title>@yield('title', config('app.name'))</title>
</head>
<body>
    <h1>@yield('title', config('app.name'))</h1>
    @yield('content')
    @yield('excluded-section')
</body>
</html>
