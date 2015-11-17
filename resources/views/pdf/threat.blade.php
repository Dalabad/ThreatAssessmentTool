<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Threat Assessment Tool</title>

    <!-- Bootstrap Core CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <!-- Custom JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="https://hpneo.github.io/gmaps/gmaps.js"></script>
    <script src="https://cdn.rawgit.com/toorshia/justgage/master/raphael-2.1.4.min.js"></script>
    <script src="https://cdn.rawgit.com/toorshia/justgage/master/justgage.js"></script>


    <!-- Custom CSS -->
    <style>
        html {
            font-family: 'Roboto', sans-serif;
        }
        .page-break {
            page-break-after: always;
        }
        .chart, .legend {
            float: left;
        }
        .legend {
            margin-left: 10px;
        }
        .smallBox {
            float: left;
            width: 20px;
            height: 20px;
            margin: 2px 5px;
            border-width: 1px;
            border-style: solid;
            border-color: rgba(0,0,0,.2);
        }
        .pie-legend {
            list-style: none;
        }
        .pie-legend li {
            clear: both;
        }
        h1 {

        }
        h2 {
            margin-bottom: 20px;
            border-bottom: 1px solid rgb(51, 122, 183);
        }
    </style>

    <script type="text/javascript">
        $(function(){
            Chart.defaults.global.animation = false;
            var pieData = [
                {
                    value: "{{ count($findings['profiles']) }}",
                    color:"#F15854",
                    highlight: "#F15854"
                },
                {
                    value: "{{ count($findings['emails']) }}",
                    color:"#4D4D4D",
                    highlight: "#4D4D4D"
                },
                {
                    value: "{{ count($findings['websites']) }}",
                    color:"#5DA5DA",
                    highlight: "#5DA5DA"
                },
                {
                    value: "{{ count($findings['locations']) }}",
                    color:"#B276B2",
                    highlight: "#B276B2"
                }
            ];
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
            var ctxPie = $('#overviewChart').get(0).getContext("2d");
            var ctxBar = $('#characteristicsChart').get(0).getContext("2d");
            var myPieChart = new Chart(ctxPie).Pie(pieData);
            var myBarChart = new Chart(ctxBar).Bar(barData, {
                scaleOverride : true,
                scaleSteps : 20,
                scaleStepWidth : 5,
                scaleStartValue : 0
            });

            @if(count($locationsArray))
                        url = GMaps.staticMapURL({
                        size: [800, 500],
                        zoom: false,
                        markers: [
                            @for ($i = 0; $i < count($locationsArray); $i++)
                                @foreach($locationsArray[$i] as $location)
                                            {
                                        lat: {{ explode(', ', $location->getCoordinates())[0] }},
                                        lng: {{ explode(', ', $location->getCoordinates())[1] }}
                                    },
                                @endforeach
                            @endfor
                        ]
                    });
                $('<img/>').attr('src', url).appendTo('#map');
            @endif

            var g = new JustGage({
                    id: "gauge",
                    value: "{{ $threatValue }}",
                    min: 0,
                    max: 100,
                    title: "Threat Level",
                    startAnimationTime: 0
                });
        });
    </script>
</head>

<body>

<div id="wrapper">

    <div class="page-header">
        <div style="text-align: center;">
            <h1>Threat Assessment Report</h1>
            <h2>{{ $data['companyName'] }}</h2>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Information</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <td>Name</td>
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
                <tr>
                    <td>Report created</td>
                    <td>{{ $dateAndTime }}</td>
                </tr>
            </table>

        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Threat Level</h3>
        </div>
        <div class="panel-body">

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
                <p>Please keep in mind, that the value of information can be significantly different then the amount of gathered information. For a social engineer it can be good enough to have one single information which helps getting access. On the other hand the social engineer might not be able to access the information with hundreds of information. It all depends on how good the information is and how easy a target can be fooled.</p>
            </div>

        </div>
    </div>

    <div class="page-break"></div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Findings</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Amount of Findings</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Profiles</td>
                    <td>{{ number_format(count($findings['profiles'])) }}</td>
                </tr>
                <tr>
                    <td>E-Mail Addresses</td>
                    <td>{{ number_format(count($findings['emails'])) }}</td>
                </tr>
                <tr>
                    <td>Websites</td>
                    <td>{{ number_format(count($findings['websites'])) }}</td>
                </tr>
                <tr>
                    <td>Locations</td>
                    <td>{{ number_format(count($findings['locations'])) }}</td>
                </tr>
                </tbody>
            </table>

            <canvas id="overviewChart" class="chart" width="400" height="400"></canvas>
            <div id="overviewChartLegend" class="legend">
                <h4>Legend</h4>
                <ul class="pie-legend">
                    <li><div class="smallBox" style="background-color:#F15854;"></div>Profiles ({{ $percentageFindings['profiles'] }}%)</li>
                    <li><div class="smallBox" style="background-color:#4D4D4D;"></div>Email Addresses ({{ $percentageFindings['emails'] }}%)</li>
                    <li><div class="smallBox" style="background-color:#5DA5DA;"></div>Websites ({{ $percentageFindings['websites'] }}%)</li>
                    <li><div class="smallBox" style="background-color:#B276B2;"></div>Locations ({{ $percentageFindings['locations'] }}%)</li>
                </ul>
            </div>

        </div>
    </div>

    <div class="page-break"></div>

    <h2>Characteristics for {{ ucwords($data['attackType']) }} attacks</h2>
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

    <h2>Data completion in percent</h2>
    <canvas id="characteristicsChart" class="chart" width="800" height="500"></canvas>

    <div class="page-break"></div>

    <h2>Findings</h2>
    <h3>Profiles</h3>

    @if(count($profilesArray))
        @for ($i = 0; $i < count($profilesArray); $i++)
                @foreach($profilesArray[$i] as $person)
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <b>
                                @if(isset($person->getAttributes()['last-name']))
                                    {{ ucwords($person->getAttributes()['last-name']) }},
                                @endif
                                @if(isset($person->getAttributes()['first-name']))
                                    {{ ucwords($person->getAttributes()['first-name']) }}
                                @endif
                                @if(!isset($person->getAttributes()['first-name']) && !isset($person->getAttributes()['last-name']))
                                    No name could be found
                                @endif
                            </b>
                        </div>
                        <div class="panel-body">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Company</td>
                                            <td colspan="2">
                                                @if(isset($person->getAttributes()['company']))
                                                    {{ $person->getAttributes()['company'] }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>Job Title</td>
                                            <td colspan="2">
                                                @if(isset($person->getAttributes()['job-title']))
                                                    {{ $person->getAttributes()['job-title'] }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Location</td>
                                            <td colspan="2">
                                                @if(isset($person->getAttributes()['location']))
                                                    {{ $person->getAttributes()['location'] }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>Industry</td>
                                            <td colspan="2">
                                                @if(isset($person->getAttributes()['industry']))
                                                    {{ $person->getAttributes()['industry'] }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if(isset($person->getAttributes()['phone']))
                                                    Phone: <span class="glyphicon glyphicon-ok"></span>
                                                @else
                                                    Phone: <span class="glyphicon glyphicon-remove"></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($person->getAttributes()['address']))
                                                    Address: <span class="glyphicon glyphicon-ok"></span>
                                                @else
                                                    Address: <span class="glyphicon glyphicon-remove"></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($person->getAttributes()['email']))
                                                    E-Mail: <span class="glyphicon glyphicon-ok"></span>
                                                @else
                                                    E-Mail: <span class="glyphicon glyphicon-remove"></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($person->getAttributes()['messenger']))
                                                    Messenger: <span class="glyphicon glyphicon-ok"></span>
                                                @else
                                                    Messenger: <span class="glyphicon glyphicon-remove"></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($person->getAttributes()['fax']))
                                                    Fax: <span class="glyphicon glyphicon-ok"></span>
                                                @else
                                                    Fax: <span class="glyphicon glyphicon-remove"></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($person->getAttributes()['web']))
                                                    Web: <span class="glyphicon glyphicon-ok"></span>
                                                @else
                                                    Web: <span class="glyphicon glyphicon-remove"></span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="panel-footer">Resource: {{ $person->getAttributes()['resource'] }} | Url: {{ $person->getAttributes()['url'] }}</div>
                    </div>
                @endforeach
            @if($i < count($profilesArray)-1)
                <div class="page-break"></div>
            @endif
        @endfor
    @else
        <div class="alert alert-info" role="alert">No profiles have been found.</div>
    @endif
    <div class="page-break"></div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">E-Mail Addresses</h3>
        </div>
        <div class="panel-body">

            This page will only list explicit E-Mail Addresses that have been collected. If for example Xing profiles contain an E-Mail Address then those are "available" for the attacker, but not listed here.
            @if(count($emailsArray))
                @for ($i = 0; $i < count($emailsArray); $i++)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>E-Mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($emailsArray[$i] as $email)
                            <tr>
                                <td>{{ $email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($i < count($emailsArray)-1)
                        <div class="page-break"></div>
                    @endif
                @endfor
            @else
                <div class="alert alert-info" role="alert">No emails have been found.</div>
            @endif
        </div>
    </div>
    <div class="page-break"></div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Websites</h3>
        </div>
        <div class="panel-body">
            @if(count($websitesArray))
                @for ($i = 0; $i < count($websitesArray); $i++)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Website</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($websitesArray[$i] as $website)
                            <tr>
                                <td>{{ $website }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($i < count($websitesArray)-1)
                        <div class="page-break"></div>
                    @endif
                @endfor
            @else
                <div class="alert alert-info" role="alert">No websites have been found.</div>
            @endif
            <div class="page-break"></div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Locations</h3>
        </div>
        <div class="panel-body">

            <div style="text-align: center;"><div id="map"></div></div>

            @if(count($locationsArray))
                @for ($i = 0; $i < count($locationsArray); $i++)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Coordinates</th>
                            <th>Timestamp</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($locationsArray[$i] as $location)
                            <tr>
                                <td>{{ $location->getName() }}</td>
                                <td style="width: 175px">{{ $location->getCoordinates() }}</td>
                                <td>{{ $location->getTimestamp() }}</td>
                                <td>{{ $location->getDescription() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($i < count($locationsArray)-1)
                        <div class="page-break"></div>
                    @endif
                @endfor
            @else
                <div class="alert alert-info" role="alert">No locations have been found.</div>
            @endif
        </div>
    </div>

</div>
<!-- /#wrapper -->

</body>

</html>