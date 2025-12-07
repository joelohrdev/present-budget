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
    <div class="min-h-screen bg-stone-100 text-stone-800 font-sans pb-20">
        <header class="bg-stone-900 text-stone-50 py-10 px-6 shadow-sm">
            <div class="max-w-5xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h1 class="text-3xl font-serif font-bold tracking-tight text-white mb-1">Christmas Budget</h1>
                </div>
                <div class="flex flex-col md:flex-row gap-4 md:gap-8 w-full md:w-auto">
                    <div class="flex gap-8 bg-stone-800/50 p-4 rounded-xl border border-stone-700/50 flex-1 md:flex-none justify-between md:justify-start">
                        <div>
                            <div class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Total Budget</div>
                            <div class="text-2xl font-medium font-mono">$2500</div>
                        </div>
                        <div class="w-px bg-stone-700"></div>
                        <div>
                            <div class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Spent</div>
                            <div class="text-2xl font-medium font-mono">$838</div>
                        </div>
                        <div class="w-px bg-stone-700"></div>
                        <div>
                            <div class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Spent</div>
                            <div class="text-2xl font-medium font-mono text-emerald-400">$1662</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-5xl mx-auto px-6 -mt-8">
            {{ $slot }}
        </main>

        <footer class="max-w-5xl mx-auto px-6 py-12 border-t border-stone-200 mt-12"><div class="flex flex-col md:flex-row justify-between items-center gap-6"><div class="flex flex-col md:flex-row items-center gap-4"><p class="text-stone-400 text-xs text-center md:text-left">© {{ now()->format('Y') }} Christmas Budget</p></div><div><button class="inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1 disabled:opacity-50 disabled:cursor-not-allowed bg-transparent text-stone-500 hover:text-stone-800 hover:bg-stone-100 px-3 py-1.5 text-xs uppercase tracking-wide text-xs text-stone-400">Disconnect Database</button></div></div></footer>
    </div>
    @fluxScripts
    @persist('toast')
    <flux:toast />
    @endpersist
</body>
</html>
