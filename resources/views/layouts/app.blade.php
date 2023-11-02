<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Logigate') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font-Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

        <!-- DataTables -->
        @yield('table-styles')
        <!-- Theme style -->
	    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="min-h-screen bg-gray-100">
            <div class="wrapper">
                
                <!-- Menu Header  (Navbar) -->
                @livewire('navigation-menu')
                <!-- /.Menu Header  (Navbar) -->

                <!-- Menu Aside -->
                <x-menu-aside />

                <main class="content-wrapper">
                    {{ $slot }}
                </main>
            </div>

            <footer class="main-footer foot-dark">
                <strong>Copyright &copy; 2023 <a href="https://adminlte.io"><b style="color: green;">Honga</b>Yetu</a>.</strong>
                    Todos os Direitos Reservados.
                    <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 1.2.0
                    </div>
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

        </div>

        <!-- Inclua isso no cabeçalho do documento -->
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

        <!-- jQuery -->
		<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- bs-custom-file-input -->
		<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('dist/js/demo.js') }}"></script>
		<!-- Page specific script -->
		<!-- FLOT CHARTS -->
		<script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
		<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
		<script src="{{ asset('plugins/flot/plugins/jquery.flot.resize.js') }}"></script>
		<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
		<script src="{{ asset('plugins/flot/plugins/jquery.flot.pie.js') }}"></script>
		<!-- ChartJS -->
		<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
        {{-- Livewire --}}

        @stack('modals')

        @livewireScripts

        @yield('table-scripts')
    </body>
</html>
