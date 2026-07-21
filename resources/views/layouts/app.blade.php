<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @isset($description)
        <meta name="description" content="{{ $description }}">
    @endisset
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body
    x-data="{ dark: document.documentElement.classList.contains('dark'), mobileNavOpen: false }"
    x-init="$watch('dark', val => { localStorage.theme = val ? 'dark' : 'light'; document.documentElement.classList.toggle('dark', val); })"
    class="bg-white text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100"
>
    {{ $slot }}

    @livewireScripts
</body>
</html>
