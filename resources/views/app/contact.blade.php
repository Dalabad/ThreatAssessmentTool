@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Contact
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-info-circle"></i> Contact
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <address>
            Fritz-Berne-Str. 46<br>
            Munich, 81241<br>
            Mobile: (+49) 176 34 12 1985
        </address>

        <address>
            <strong>Daniel Schosser</strong><br>
            <a href="mailto:daniel@crashtest-security.com">daniel@crashtest-security.com</a>
        </address>
    </div>
</div>
<!-- /.row -->
@stop