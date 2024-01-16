<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <link rel="icon" type="image/x-icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACTElEQVR4nO2YPUhWURjHfyqShFmDOkQgEg2BkTgE6WouRaMORqMtBQ5CDS21mGNFkLhZk2AuRWMRhR8g5CA0REQQUYGIBn1YnThwB+F93+d83HPvOeH7h2e6/+c5z4/7vuee50BddRWuFUBZxAugocA+GrI1bHpZqlZAOcSZAkGGHHvJBfKoQJCFMkF+A10FQBwBdsoE0XGjAJCbHn3kBvkENAeE0LU+xgDRMRwQZMSzhyAgzwKCPI8JoqMnAMRx4G9skDsBQO7mWL9CvoW2gAP4qxXYTAFEAWM5QC7lXLtCeYq9xl+rKYEooN8DYiDAuhXKW/AB7nqYIshPoNMBoh34HgvkMPBLeH7VAeSaxaFUFQWiNS88fw80WUA0Au+EOguOPXmBDBo8Zy1AzhlqDJUBokfRN4LnsQXIEyH/bfbGCgfRGhc8f4BuAaIr+w/Uyp/w7Mkr6RDwTfBNCiC3hLwfQEeZIFozgu8r0FJljX3AZyFvNmdPXkm9Bu9olTUuGHJOxwDRWhS8L6v4Xwn+tUA9eSVdNPj7dnlPGrz6FBwNxPSbv7/LO22YadpigmhNCf5t4GA2eG0Jvns1aqsyQUzfhcvAFUPdEymAmL7U61m4bArRQExnJ9dtOhqI6TTr+uGMBmKaL2qF3ihIDaTdceLTF3LHUgQhm9ttQZ5ilooF0u8Acj5lENt7qg+WI7GKCTJmUee6ZS0VE2Q/sCHU2MluY5IH0bot1JjDXio2yFHgS41D5Kn/CSSU1J4GWTYk6LG2bC0n2FNde0v/ABCY9/wjAIgdAAAAAElFTkSuQmCC">

        <title inertia>{{ config('app.name', 'MafiaGame') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
