@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Assessment
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Assessment
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount of Employees</th>
                        <th>Website</th>
                        <th>Selected Attack Type</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $companyInformation['companyName'] }}</td>
                            <td>{{ $companyInformation['companyEmployeeCount'] }}</td>
                            <td>{{ $companyInformation['companyWebsite'] }}</td>
                            <td>{{ $companyInformation['attackType'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop