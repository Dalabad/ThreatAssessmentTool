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

    @include('result.resultsNavigation', ['results' => $results])

@if(count($categories))
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                    <tr>
                        @foreach($categories as $category)
                            <th>{{ ucwords($category) }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($results['profiles'] as $person)
                            <tr>
                            @foreach($categories as $category)
                                @if(isset($person->getAttributes()[$category]))

                                        @if($category == 'url' || $category == 'website')
                                            <td>{!! Html::link($person->getAttributes()[$category], 'Link') !!}</td>
                                        @else
                                            <td>{{ ucwords($person->getAttributes()[$category]) }}</td>
                                        @endif

                                @else
                                    <td>-</td>
                                @endif
                            @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
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