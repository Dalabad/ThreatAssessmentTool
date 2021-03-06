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
            <a href="{{ url('/download/detailed') }}" target="_blank" class="btn btn-primary">Detailed Report</a>
            <a href="{{ url('/download/') }}" target="_blank" class="btn btn-primary">Simple Report</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Company Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 400px">Name</td>
                            <td>{{ $data['companyName'] }}</td>
                        </tr>
                        <tr>
                            <td>Employee Count</td>
                            <td>{{ number_format($data['companyEmployeeCount']) }}</td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>{{ $data['companyWebsite'] }}</td>
                        </tr>
                        <tr>
                            <td>Attack Type</td>
                            <td>{{ ucwords($data['attackType']) }}</td>
                        </tr>
                    </tbody>
                </table>

                @include('helper.findings')
            </div>

            <div id="gauge" style="width: 400px; height: 300px;"></div>
            <div>
                @if($threatValue >= 75)
                    <p>Based on the gathered information the Threat level for {{ $data['companyName'] }} is considered very high.</p>
                @elseif($threatValue >= 50)
                    <p>Based on the gathered information the Threat level for {{ $data['companyName'] }} is considered high.</p>
                @elseif($threatValue >= 25)
                    <p>Based on the gathered information the Threat level for {{ $data['companyName'] }} is considered medium.</p>
                @elseif($threatValue >= 0)
                    <p>Based on the gathered information the Threat level for {{ $data['companyName'] }} is considered low.</p>
                @endif
            </div>
            <p>Please keep in mind, that the value of information can be significantly different then the amount of gathered information. For a social engineer it can be good enough to have one single information which helps getting access. On the other hand the social engineer might not be able to access the information with hundreds of information. It all depends on how good the information is and how easy a target can be fooled.</p>

            <h3>Distribution of Threat</h3>
            <canvas id="characteristicsChart" class="chart" width="800" height="600"></canvas>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="https://cdn.rawgit.com/toorshia/justgage/master/raphael-2.1.4.min.js"></script>
<script src="https://cdn.rawgit.com/toorshia/justgage/master/justgage.js"></script>
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
        var g = new JustGage({
            id: "gauge",
            value: "{{ $threatValue }}",
            min: 0,
            max: 100,
            title: "Threat Level"
        });
    });
</script>
@stop