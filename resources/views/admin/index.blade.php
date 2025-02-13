<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        @Vite(['resources/js/admin.js','resources/css/admin.css'])
        <title>Страница Админа</title>
        <link rel="stylesheet" href="https://cdn.webix.com/edge/webix.css">
        <link rel="stylesheet" href="//cdn.webix.com/materialdesignicons/5.8.95/css/materialdesignicons.min.css" type="text/css" charset="utf-8">
    </head>
    <body>
        <div id="auth" class="flex-box"></div>
    </body>
</html>