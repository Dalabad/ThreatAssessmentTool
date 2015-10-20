@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Gathered Results &raquo; People
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-table"></i> <a href="{{ url('/result') }}">Gathered Results</a>
                </li>
                <li class="active">
                    <i class="fa fa-users"></i> People
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">26</div>
                            <div>People</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('result/people') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-envelope-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">124</div>
                            <div>Mail Addresses</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('result/mail') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-building-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">12</div>
                            <div>Locations</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('result/location') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-globe fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">13</div>
                            <div>Websites</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('result/website') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Website</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Foo Bar</td>
                    <td><a href="mailto:foobar@company.com">foobar@company.com</a></td>
                    <td>Munich, Germany</td>
                    <td><a href="http://www.foobar.com">www.foobar.com</a></td>
                </tr>
                <tr>
                    <td>Larry Page</td>
                    <td><a href="mailto:larry@company.com">larry@company.com</a></td>
                    <td>Munich, Germany</td>
                    <td><a href="http://www.foobar.com">www.foobar.com</a></td>
                </tr>
                <tr>
                    <td>Bill Gates</td>
                    <td><a href="mailto:bill@company.com">bill@company.com</a></td>
                    <td>Munich, Germany</td>
                    <td><a href="http://www.foobar.com">www.foobar.com</a></td>
                </tr>
                <tr>
                    <td>Steve Jobs</td>
                    <td><a href="mailto:steve@company.com">steve@company.com</a></td>
                    <td>Munich, Germany</td>
                    <td><a href="http://www.foobar.com">www.foobar.com</a></td>
                </tr>
                <tr>
                    <td>Max Mustermann</td>
                    <td><a href="mailto:muster@company.com">muster@company.com</a></td>
                    <td>Munich, Germany</td>
                    <td><a href="http://www.foobar.com">www.foobar.com</a></td>
                </tr>
                <tr>
                    <td>John Doe</td>
                    <td><a href="mailto:john@company.com">john@company.com</a></td>
                    <td>Munich, Germany</td>
                    <td><a href="http://www.foobar.com">www.foobar.com</a></td>
                </tr>
                <tr>
                    <td>Jane Doe</td>
                    <td><a href="mailto:jane@company.com">jane@company.com</a></td>
                    <td>Munich, Germany</td>
                    <td><a href="http://www.foobar.com">www.foobar.com</a></td>
                </tr>
                <tr>
                    <td>Mike</td>
                    <td>-</td>
                    <td>Berlin, Germany</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Joe</td>
                    <td><a href="mailto:joe@company.com">joe@company.com</a></td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.row -->
@stop