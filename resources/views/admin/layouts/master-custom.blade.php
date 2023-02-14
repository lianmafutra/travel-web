<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' - ' . Setting::getValue('app_name') }}</title>
    <link rel="icon" href="{{ asset(Setting::getValue('app_favicon')) }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/fontawesome-free/css/all.min.css') }}">
 
    

    @stack('style')
    @stack('css')
</head>

<body >
   
 
   
    
      @yield('content')
   

    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('template/admin/plugins/jquery/jquery.min.js') }}"></script>
    @yield('js')
    @stack('js')

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('template/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       
    </script>
    @stack('script')
</body>

</html>
