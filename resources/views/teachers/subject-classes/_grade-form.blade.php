{!! Form::open(['url'=>'/teacher-classes/' . $subjectClass->id . '/set-grade/' . $col, 'method'=>'put']) !!}

<table class="table table-bordered table-stripped w-75">
    <thead>
        <tr class="bg-primary text-light">
            <th>ID Number</th>
            <th>Student Name</th>
            <th class="text-center" style="width:200px">
                Grade
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($subjectClass->enrolSubjects as $enrolSubject)
            <tr>
                <td>{{$enrolSubject->enrol->student->id_number}} - {{$enrolSubject->enrol->student->id_extension}}</td>
                <td>{{$enrolSubject->enrol->student->full_name}}</td>
                <td>
                    <?php $gradeField = "g" . $col; ?>
                    {!! Form::text("grade[]", $enrolSubject->$gradeField, ['class'=>'form-control float-right','style'=>'width:200px; text-align:center']) !!}
                    {!! Form::hidden("enrol_subject_id[]", $enrolSubject->id) !!}
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                <button class="btn btn-primary float-right">
                    <i class="fa fa-save"></i> Save Grade Changes
                </button>
            </td>
        </tr>
    </tfoot>
</table>

{!! Form::close() !!}}
