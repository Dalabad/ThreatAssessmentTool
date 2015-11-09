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

@if($companyInformation['attackType'] == 'phishing')
    @include('app.forms.findings.phishing')
@elseif($companyInformation['attackType'] == 'baiting')
    @include('app.forms.findings.baiting')
@elseif($companyInformation['attackType'] == 'impersonation')
    @include('app.forms.findings.impersonation')
@endif