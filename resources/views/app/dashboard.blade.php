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

    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal" method="post" action="{{ url('/') }}">
                <div class="form-group">
                    <label for="inputCompanyName" class="col-sm-2 control-label">Company Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCompanyName" placeholder="Company Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCompanySize" class="col-sm-2 control-label">Amount of Employees</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCompanySize" placeholder="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCompanyWebsite" class="col-sm-2 control-label">Company Website</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCompanyWebsite" placeholder="http://www.company.com">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Start Information Gathering</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6">
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
@stop