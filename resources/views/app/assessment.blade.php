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
                            <td>{{ number_format($companyInformation['companyEmployeeCount']) }}</td>
                            <td>{{ $companyInformation['companyWebsite'] }}</td>
                            <td>{{ ucwords($companyInformation['attackType']) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <canvas id="characteristicsChart" class="chart" width="800" height="600"></canvas>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script type="text/javascript">
    $(function(){
        Chart.defaults.global.animation = false;
        var barData = {
            labels: [

                @foreach($characteristics as $characteristic)
                    "{{ $characteristic['title'] }}",
                @endforeach
            ],
            datasets: [
                {
                    fillColor: "rgba(93,165,218,0.75)",
                    strokeColor: "rgba(77,77,77,0.3)",
                    highlightFill: "rgba(93,165,218,0.75)",
                    highlightStroke: "rgba(93,165,218,1)",
                    data: [
                        @foreach($characteristics as $characteristic)
                        {{ $characteristic['value'] }},
                        @endforeach
                    ]
                }
            ]
        };
        var ctxBar = $('#characteristicsChart').get(0).getContext("2d");
        var myBarChart = new Chart(ctxBar).Bar(barData, {
            scaleOverride : true,
            scaleSteps : 20,
            scaleStepWidth : 5,
            scaleStartValue : 0
        });
    });
</script>
@stop