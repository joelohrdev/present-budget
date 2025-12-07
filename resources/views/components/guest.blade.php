<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="bg-stone-100 text-stone-800 antialiased selection:bg-stone-300 selection:text-stone-900">
    <div class="min-h-screen flex items-center justify-center bg-stone-100 text-stone-800 p-4">
        {{ $slot }}
    </div>
@fluxScripts
</body>
</html>
