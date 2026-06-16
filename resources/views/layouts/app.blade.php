<!DOCTYPE html>
<html lang="ru" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой блог</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    @fluxAppearance
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-zinc-50 dark:bg-zinc-900 antialiased">

<flux:header class="bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700 px-4 sm:px-6">
    <flux:brand href="/" name="Мой блог" />
    <flux:spacer />
    <flux:button variant="ghost" icon="moon" size="sm" x-data x-on:click="$flux.dark = !$flux.dark" />
</flux:header>

<flux:main class="py-8">
    {{ $slot }}
</flux:main>

@fluxScripts
</body>
</html>
