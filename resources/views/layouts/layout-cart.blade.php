<!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')دیجی کالا</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
    @include('layouts.layout-header')

    @yield('cart')

    @include('layouts.layout-footer')
    <script src="/js/app.js"></script>
    <script src="/js/admin.js"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip()
    </script>
</body>

</html>
