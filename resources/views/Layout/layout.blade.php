<!DOCTYPE html>
<html>
<head>
    <title>UH White Pages Management System</title>
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script
        src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/dataTableCustom.css'])
</head>
<body>
    <div id="app">
        <header>
            @include('Layout.Partials.navbar')
        </header>
        <div class="main-content">
            <aside>
                @include('Layout.Partials.sidebar')
            </aside>
            <main>
                @yield('content')
            </main>
        </div>
        <footer>
            @include('Layout.Partials.footer')
        </footer>

    </div>


    <!-- Include your JavaScript and Vue app here -->

</body>
</html>
