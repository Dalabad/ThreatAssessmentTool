<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Threat Assessment Tool</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/sb-admin.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Threat Assessment Tool</a>
        </div>

        {{-- @include('topNavigation') --}}

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="{{ (Request::is('/') )  ? 'active' : '' }}">
                    <a href="{{ url('/') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li class="{{ (Request::is('result') || Request::is('result/*'))  ? 'active' : '' }}">
                    <a href="{{ url('/result') }}"><i class="fa fa-fw fa-table"></i> Gathered Results</a>
                </li>
                <li class="{{ (Request::is('assessment') )  ? 'active' : '' }}">
                    <a href="{{ url('/assessment') }}"><i class="fa fa-fw fa-edit"></i> Threat Assessment</a>
                </li>
                <li class="{{ (Request::is('help') )  ? 'active' : '' }}">
                    <a href="{{ url('/help') }}"><i class="fa fa-fw fa-question-circle"></i> Help</a>
                </li>
                <li class="{{ (Request::is('contact') )  ? 'active' : '' }}">
                    <a href="{{ url('/contact') }}"><i class="fa fa-fw fa-info-circle"></i> Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            @yield('content')

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="/js/jquery.js"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/app.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

</body>

</html>