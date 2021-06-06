<!DOCTYPE html>
<html>
<head>
    <title>SchoolCom</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="{{ route('studentView') }}">Student List</a>
         <a class="navbar-brand" href="{{ route('importView') }}">Student Import</a>
    </nav>
  
    <div class="container" style="margin-top: 15px;">
        @include('flash.flash')
        <br />
        @yield('content')
    </div>
   
</body>

    @yield('customscript')  
    <script type="text/javascript">
        setTimeout(function () {        
            $('.alert').alert('close');
        }, 5000);
    </script>

</html>