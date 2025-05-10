<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cascadia+Mono:ital,wght@0,200..700;1,200..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
        <link rel="stylesheet" href="./css/modal.css">
       
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">

    

     
          
      
        <div class="min-h-screen " >
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
    
            <!-- Page Content -->
            
            <main class="">
                
                {{ $slot }}
            </main>

            <x-accounts.accformmodal/>
            <x-accounts.updateaccmodal/>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
            $('#myTable').DataTable();
        }); 
        </script>
        <script src="js/modals.js"></script>
        <script  src="https://cdn.jsdelivr.net/npm/sweetalert2@11" ></script>
        <script  src="js/alerts.js" ></script>


        @if ($errors -> all())
        <script>
            let error = @json($errors -> all());
            Swal.fire({
                icon : 'error',
                title : "Error",
                text:error[0],
            })
        </script>
        @endif
        @if (session("message"))
        <script>
            let message = @json(session('message'));
            let timerInterval;

            console.log(message);
            Swal.fire({
            title: "User successfully added!",
            text:message,
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                
            }
            });
        </script>
            
        @endif

        
    </body>
</html>
