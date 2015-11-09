@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard <small>Statistics Overview</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

@if ($notification)
    <div class="alert alert-info alert-dismissible">
        <p><b>Notification:</b> {{ $notification }}</p>
    </div>
@endif

@if (count($errors))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="row">
        <div class="col-md-6">
            @if(!count($companyInformation))
                @include('app.forms.companyInformation')
            @else
                @include('app.forms.findings')
            @endif
        </div>
    </div>
    <!-- /.row -->

    @if(count($companyInformation))
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-info"></i> Characteristics for {{ ucwords($companyInformation['attackType']) }} Attacks
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($characteristics as $characteristic)
                                    <tr>
                                        <td>{{ $characteristic['title'] }}</td>
                                        <td>{{ $characteristic['description'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-info"></i> Information
                </div>
                <div class="panel-body">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <i class="fa fa-info"></i> Reset all information
                </div>
                <div class="panel-body">
                    <p>By clicking this button, all gathered information will be deleted! In case you want to restore it later, you have to upload all files again.</p>
                    <a class="btn btn-danger" href="{{ url('/information/reset') }}">Reset</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop