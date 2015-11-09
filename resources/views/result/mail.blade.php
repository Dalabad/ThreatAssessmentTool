@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Gathered Results &raquo; Mail
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-table"></i> <a href="{{ url('/result') }}">Gathered Results</a>
                </li>
                <li class="active">
                    <i class="fa fa-envelope-o"></i> Mail
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    @include('result.resultsNavigation', ['results' => $results])

@if(count($results))
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                    <tr>
                        <th>Notification</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>This page will only list explicit E-Mail Addresses that have been collected. If for example Xing profiles contain an E-Mail Address then those are "available" for the attacker, but not listed here.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                    <tr>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results['emails'] as $mail)
                        <tr>
                            <td>{{ $mail }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                    <tr>
                        There are no results yet. Please go to the Dashboard and add some information.
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endif
@stop