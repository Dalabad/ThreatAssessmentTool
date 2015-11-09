<form class="form-horizontal" method="post" id="findingsPhishing" action="{{ url('/information/baiting') }}" enctype="multipart/form-data">
    {!! Form::token() !!}
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <label for="selectCompanyLocation" class="control-label">How many company locations did you find?</label>
            @if(isset($companyInformation['companyLocation']))
                {!! Form::select('inputCompanyLocation', array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '5+'), $companyInformation['companyLocation'], ['class' => 'form-control']) !!}
            @else
                {!! Form::select('inputCompanyLocation', array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '5+'), null, ['class' => 'form-control']) !!}
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <label for="selectCompanySoftware" class="control-label">Based on the gathered information, what is your knowledge of internal software?</label>
            @if(isset($companyInformation['companySoftware']))
                {!! Form::select('inputCompanySoftware', array('0' => 'No Knowledge', '50' => 'Medium Knowledge', '100' => 'Extensive Knowledge'), $companyInformation['companySoftware'], ['class' => 'form-control']) !!}
            @else
                {!! Form::select('inputCompanySoftware', array('0' => 'No Knowledge', '50' => 'Medium Knowledge', '100' => 'Extensive Knowledge'), null, ['class' => 'form-control']) !!}
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <label for="selectCompanyNetwork" class="control-label">Based on the gathered information, what is your knowledge of the internal network?</label>
            @if(isset($companyInformation['companyNetwork']))
                {!! Form::select('inputCompanyNetwork', array('0' => 'No Knowledge', '50' => 'Medium Knowledge', '100' => 'Extensive Knowledge'), $companyInformation['companyNetwork'], ['class' => 'form-control']) !!}
            @else
                {!! Form::select('inputCompanyNetwork', array('0' => 'No Knowledge', '50' => 'Medium Knowledge', '100' => 'Extensive Knowledge'), null, ['class' => 'form-control']) !!}
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <label for="selectCompanyNetwork" class="control-label">Based on the gathered information, what is your knowledge of the internal security?</label>
            @if(isset($companyInformation['companySecurity']))
                {!! Form::select('inputCompanySecurity', array('0' => 'No Knowledge', '50' => 'Medium Knowledge', '100' => 'Extensive Knowledge'), $companyInformation['companySecurity'], ['class' => 'form-control']) !!}
            @else
                {!! Form::select('inputCompanySecurity', array('0' => 'No Knowledge', '50' => 'Medium Knowledge', '100' => 'Extensive Knowledge'), null, ['class' => 'form-control']) !!}
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Update Information</button>
        </div>
    </div>
</form>