<form class="form-horizontal" method="post" id="findingsImpersonation" action="{{ url('/information/impersonation') }}" >
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
            <label for="selectCompanyLingo" class="control-label">Did you find internal documents which reveal company internal lingo?</label>
            @if(isset($companyInformation['companyLingo']))
                {!! Form::select('inputCompanyLingo', array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '5+'), $companyInformation['companyLingo'], ['class' => 'form-control']) !!}
            @else
                {!! Form::select('inputCompanyLingo', array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '5+'), null, ['class' => 'form-control']) !!}
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <label for="selectCompanyLocation" class="control-label">For how many percent of overall employees did you find a social media accounts?</label>
            @if(isset($companyInformation['socialAccounts']))
                {!! Form::select('inputSocialAccounts', array('0' => '0%', '10' => '10%', '20' => '20%', '30' => '30%', '40' => '40%', '50' => '50%', '60' => '60%', '70' => '70%', '80' => '80%', '90' => '90%', '100' => '100%'), $companyInformation['socialAccounts'], ['class' => 'form-control']) !!}
            @else
                {!! Form::select('inputSocialAccounts', array('0' => '0%', '10' => '10%', '20' => '20%', '30' => '30%', '40' => '40%', '50' => '50%', '60' => '60%', '70' => '70%', '80' => '80%', '90' => '90%', '100' => '100%'), null, ['class' => 'form-control']) !!}
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