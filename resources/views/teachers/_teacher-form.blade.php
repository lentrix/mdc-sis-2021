<div class="form-group">
    {!! Form::label("user_id", "User Account") !!}
    {!! Form::select("user_id", $usersList, null, ['class'=>'form-control','placeholder'=>'Select a user']) !!}
</div>

<div class="form-group">
    {!! Form::label("name", "Name") !!}
    {!! Form::text("name", null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label("specialization", "Specialization") !!}
    {!! Form::text("specialization", null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label("phone", "Phone Number") !!}
    {!! Form::text("phone", null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label("department_id", "Department") !!}
    {!! Form::select("department_id", $departmentsList, null, ['class'=>'form-control','placeholder'=>'Select a department']) !!}
</div>
