<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="">

        <title>Blog</title>

        <!-- Bootstrap core CSS -->
        <link href="https://bootswatch.com/4/simplex/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >

    </head>

    <body>

        @include('layouts.partials.navbar')

        @yield('banner')

        <div class="container-fluid">

            <div class="row"><br></div>
            <div class="row">

                <div class="col-md-3">
                    @yield('category')
                </div>

                <div class="col-md-9">
                    <div class="row content heading">
                        <div class="col-md-4"><h4 class="main-content-heading">@yield('heading')</h4> </div>
                        <div class="offset-md-5 col-md-2 main-content-heading">
                            @yield('createThread')
                        </div>
                    </div>
                    <br>
                    <div class="content-wrap well">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        <script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
        <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
        <script src="https://getbootstrap.com/assets/js/vendor/holder.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
        @yield('js')
    </body>
</html>