@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Gathered Results &raquo; Website
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-table"></i> <a href="{{ url('/result') }}">Gathered Results</a>
                </li>
                <li class="active">
                    <i class="fa fa-globe"></i> Website
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
                    <th>Website</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results['websites'] as $website)
                    <tr>
                        @if(str_contains($website, 'http'))
                            <td>{!! Html::link($website) !!}</td>
                        @else
                            <td>{!! Html::link('http://'.$website) !!}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop