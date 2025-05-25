<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- CDN Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CDN SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans">
    <x-banner />
    <div class="bg-[#0A1128]">
        @livewire('navigation-menu')
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main style="min-height: 70vh;">
            {{ $slot }}
        </main>
        
        @include('footer')
    </div>

    @stack('modals')

    @livewireScripts
    <script>
        Livewire.on('message', (txt) => {
            Swal.fire({
                position: "center",
                icon: "success",
                title: txt,
                showConfirmButton: false,
                timer: 1500
            });
        })

        Livewire.on('confirmDelete', (id) => {
            Swal.fire({
                title: "Estás seguro?",
                text: "Esto es permanente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, elimínalo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatchTo('show-shop', 'delete', id);
                }
            });
        });
    </script>

    @if (session('message'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{{session('message')}}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    @endif

    @if (session('ERROR'))
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "{{session('ERROR')}}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    @endif
</body>

</html>