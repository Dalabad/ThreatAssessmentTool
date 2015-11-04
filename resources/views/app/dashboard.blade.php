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

@if ($notification)
    <div class="alert alert-info alert-dismissible">
        <p><b>Notification:</b> {{ $notification }}</p>
    </div>
@endif

@if (count($errors))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="row">
        <div class="col-md-6">
            @if(!count($companyInformation))
                <form class="form-horizontal" method="post" id="companyInformationForm" action="{{ url('/information/companyinformation') }}">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label for="inputCompanyName" class="col-sm-2 control-label">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCompanyName" name="companyName" placeholder="Company Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCompanySize" class="col-sm-2 control-label">Amount of Employees</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCompanySize" name="companyEmployeeCount" placeholder="100">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCompanyWebsite" class="col-sm-2 control-label">Company Website</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCompanyWebsite" name="companyWebsite" placeholder="http://www.company.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectAttackType" class="col-sm-2 control-label">Attack Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="attackType" id="selectAttackType">
                                <option value="phishing">Phishing</option>
                                <option value="baiting">Baiting</option>
                                <option value="impersonation">Impersonation</option>
                                <option value="4">Coming soon ...</option>
                                <option value="5">Coming soon ...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Start Information Gathering</button>
                        </div>
                    </div>
                </form>

            @else

                <form class="form-horizontal" method="post" id="findingsUploadForm" action="{{ url('/information/upload') }}" enctype="multipart/form-data">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label for="files" class="col-sm-2 control-label">Exported Results</label>
                        <div class="col-sm-10">
                            <input name="files[]" type="file" id="files">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectTool" class="col-sm-2 control-label">Tool</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="inputToolName" id="selectTool">
                                <option value="reconng">ReconNg (*.json)</option>
                                <option value="theharvester">TheHarvester (*.xml)</option>
                                <option value="maltego">Maltego (*.xml)</option>
                                <option value="creepy">Cree.py (*.kml)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Upload Findings</button>
                        </div>
                    </div>
                </form>

                <hr/>

                <form class="form-horizontal" method="post" id="findingsXingForm" action="{{ url('/information/xing') }}" enctype="multipart/form-data">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label for="xingUrl" class="col-sm-2 control-label">Xing Url</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="inputXingUrl" id="xingUrl" placeholder="https://www.xing.com/companies/foobar/">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectUrlType" class="col-sm-2 control-label">Url Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="inputUrlType" id="selectUrlType">
                                <option value="company">Company Url</option>
                                <option value="person">Person Url</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Add Person/Company</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <!-- /.row -->

    @if(count($companyInformation))
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-info"></i> Characteristics for {{ ucwords($companyInformation['attackType']) }} Attacks
                    </div>
                    <div class="panel-body">

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
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    @endif

    <div class="row">
        <div class="col-md-12">
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

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <i class="fa fa-info"></i> Reset all information
                </div>
                <div class="panel-body">
                    <p>By clicking this button, all gathered information will be deleted! In case you want to restore it later, you have to upload all files again.</p>
                    <a class="btn btn-danger" href="{{ url('/information/reset') }}">Reset</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop