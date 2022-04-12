<div class="row">
    <div class="col-md-3">
        <h4>Personal Identity</h4>
        <div class="mb-2">
            {!! Form::label("id_number", "ID Number") !!}
            {!! Form::text("id_number", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("id_extension", "ID Extension") !!}
            {!! Form::text("id_extension", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("lrn", "LRN") !!}
            {!! Form::text("lrn", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("last_name", "Last name") !!}
            {!! Form::text("last_name", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("first_name", "First Name") !!}
            {!! Form::text("first_name", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("middle_name", "Middle Name") !!}
            {!! Form::text("middle_name", null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <h4>Personal Details</h4>
        <div class="mb-2">
            {!! Form::label("sex", "Sex") !!}
            {!! Form::select("sex", ['Female'=>'Female', 'Male'=>'Male'],null, ['class'=>'form-control','placeholder'=>'Select sex']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("birth_date", "Date of Birth") !!}
            {!! Form::date("birth_date", isset($student)?$student->birth_date:null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("civil_status", "Civil Status") !!}
            {!! Form::select("civil_status", [
                'Single' => 'Single',
                'Married' => 'Married',
                'Widowed' => 'Widowed'
            ],null, ['class'=>'form-control', 'placeholder'=>'Select civil status']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("religion", "Religion") !!}
            {!! Form::text("religion", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("phone", "Phone Number") !!}
            {!! Form::text("phone", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("nationality", "Nationality") !!}
            {!! Form::text("nationality", null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <h4>&nbsp;</h4>
        <div class="mb-2">
            {!! Form::label("email", "Email Address") !!}
            {!! Form::email("email", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-2">
            {!! Form::label("address", "Address") !!}
            <div class="d-flex">
                {!! Form::text("street", null, ['class'=>'form-control mb-1','placeholder'=>'Street/Sitio','title'=>'Street/Sitio']) !!}
                {!! Form::text("barangay", null, ['class'=>'form-control mb-1','placeholder'=>'Barangay','title'=>'Barangay']) !!}
            </div>
            <div class="d-flex">
                {!! Form::text("town", null, ['class'=>'form-control mb-1','placeholder'=>'Town','title'=>'Town']) !!}
                {!! Form::text("province", null, ['class'=>'form-control mb-1','placeholder'=>'Province','title'=>'Province']) !!}
            </div>
        </div>
        <div class="mb-2">
            {!! Form::label("father", "Father") !!}
            <div class="d-flex">
                {!! Form::text("father", null, ['class'=>'form-control','placeholder'=>'Name of Father','title'=>'Name of Father']) !!}
                {!! Form::text("occupation_father", null, ['class'=>'form-control','placeholder'=>'Occupation of Father','title'=>'Occupation of Father']) !!}
            </div>
        </div>
        <div class="mb-2">
            {!! Form::label("mother", "Mother") !!}
            <div class="d-flex">
                {!! Form::text("mother", null, ['class'=>'form-control','placeholder'=>'Name of Mother','title'=>'Name of Mother']) !!}
                {!! Form::text("occupation_mother", null, ['class'=>'form-control','placeholder'=>'Occupation of Mother','title'=>'Occupation of Mother']) !!}
            </div>
        </div>
        <div class="mb-2">
            {!! Form::label("parents_address", "Address of Parents") !!}
            {!! Form::textarea("parents_address", null, ['class'=>'form-control','rows'=>'3']) !!}
        </div>
    </div>
</div>
