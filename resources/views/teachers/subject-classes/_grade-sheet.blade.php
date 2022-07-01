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
                    {{$enrolSubject->$gradeField}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
