<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Xchanger</title>
        <link rel="shortcut icon" type="image/png" href="{{asset('images/favicon.png')}}"/>
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/u/dt/dt-1.10.12/datatables.min.css"/>

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/u/dt/dt-1.10.12/datatables.min.js"></script>
    </head>
    <body style="background-color: #72BCCD;">
        @include('partials.nav')
        <div class="container" style="background-color: white; border: 1px solid #4C7179; margin-bottom:10px;">
            <div class="col-md-2 col-sm-1"></div>
            <div class="col-md-8 col-sm-10 cl-xs-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (Session::has('flash_message_error'))
                <div class="alert alert-danger">{{ Session::get('flash_message_error') }}</div>
                @endif
                @if (Session::has('flash_message'))
                <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                @endif
            </div>
            <div class="col-md-2 col-sm-1"></div>
            <div class="col-md-1"></div>
            <div class="col-md-10 col-sm-12" style="padding-bottom:40px;">
                @yield('content')
            </div>
            <div class="col-md-1"></div>
        </div>
        <!-- Scripts -->
    </body>
</html>
