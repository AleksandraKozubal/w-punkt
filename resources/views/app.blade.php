<!DOCTYPE html>
<html lang="pl" class="h-full bg-beige">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')
    <link rel="icon" type="image/x-icon" href="{{ asset("favicon.ico") }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @inertiaHead
</head>
<body class="h-full">
@inertia
</body>
</html>
