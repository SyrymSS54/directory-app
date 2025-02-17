<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <title>Вход на страницу</title>
        <link rel="stylesheet" href="https://cdn.webix.com/edge/webix.css">
        <link rel="stylesheet" href={{ asset("/build/assets/auth-cRNMswxZ.css") }}>
        <script type="module" src={{ asset("/build/assets/auth-BV2NMjge.js") }}></script>
        <script type="module" src={{ asset("/build/assets/webix-WWAde2qZ.js") }}></script>
    </head>
    <body>
        <div id="auth" class="flex-box"></div>
        <div style="display:none">
        
        </div>
    </body>
</html>