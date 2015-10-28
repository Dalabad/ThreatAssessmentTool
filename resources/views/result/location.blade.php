@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Gathered Results &raquo; Location
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-table"></i> <a href="{{ url('/result') }}">Gathered Results</a>
                </li>
                <li class="active">
                    <i class="fa fa-building-o"></i> Location
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    @include('result.resultsNavigation', ['results' => $results])

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Coordinates</th>
                    <th>Timestamp</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results['locations'] as $location)
                    <tr>
                        <td>{{ $location->getName() }}</td>
                        <td>{{ $location->getCoordinates() }}</td>
                        <td>{{ $location->getTimestamp() }}</td>
                        <td>{{ $location->getDescription() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop