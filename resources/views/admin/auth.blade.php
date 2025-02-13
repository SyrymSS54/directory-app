<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        @Vite(['resources/js/auth.js','resources/css/auth.css'])
        <title>Вход на страницу</title>
        <link rel="stylesheet" href="https://cdn.webix.com/edge/webix.css">
    </head>
    <body>
        <div id="auth" class="flex-box"></div>
        <div style="display:none">
        
        </div>
    </body>
</html>