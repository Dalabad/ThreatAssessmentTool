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
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Start Information Gathering</button>
        </div>
    </div>
</form>