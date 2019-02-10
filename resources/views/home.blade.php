<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ContactStore</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <div id="app" class="mt-3">
            <contacts></contacts>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>