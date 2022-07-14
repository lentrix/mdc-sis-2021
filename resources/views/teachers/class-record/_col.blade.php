<table class="table table-bordered">
    @foreach($subjectClass->enrolSubjects as $idx=>$enrolSubject)
    <?php $score = \App\Models\Score::getOrCreate($col->id, $enrolSubject->id)  ?>

    <tr>
        <th class="text-left">{{++$idx}}. {{$enrolSubject->enrol->student->full_name}}</th>
        <td style="width: 100px">{{$enrolSubject->enrol->program->short_name}}-{{$enrolSubject->enrol->level}}</td>
        <td style="width: 100px">
            <input type="number" class="form-control form-control-sm" name="score[{{$score->id}}]" max="{{$col->total}}" value="{{$score->score}}">
        </td>
        <td>{{$col->total}}</td>
    </tr>

    @endforeach
</table>
