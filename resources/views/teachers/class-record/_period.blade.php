<?php $columns = \App\Models\ScoreColumn::where('period_id',$period->id)
        ->where('class_record_id', $subjectClass->classRecord->id)->get() ?>

<div class="p-3 bg-white border-left border-right border-bottom">
    <h5>{{$period->name}} Records</h5>
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="bg-light">
                <th class="text-center align-middle" style="min-width: 250px">Student</th>
                @foreach($period->scoreColumns as $scoreColumn)
                    <th class="text-center">
                        {{$scoreColumn->name}} <br>
                        <div style="font-size: 0.8em; font-weight: normal; font-style:italic">
                            Weight: {{$scoreColumn->weight}} <br>
                            Total: {{$scoreColumn->total}}
                        </div>
                    </th>
                @endforeach
                <th class="align-top text-center">Grade</th>
                <th class="align-top text-center">Transmuted Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjectClass->enrolleesList as $enrolSubject)

            <tr>
                <th class="text-left">{{$enrolSubject->enrol->student->full_name}}</th>
                @foreach($period->scoreColumns as $scoreColumn)
                    <?php $score = \App\Models\Score::getOrCreate($scoreColumn->id, $enrolSubject->id) ?>
                    <td>
                        <input type="number" name="score[{{$score->id}}]"
                                class="form-control form-control-sm text-center"
                                max="{{$scoreColumn->total}}"
                                value="{{$score->score}}">
                    </td>
                @endforeach
                <td class='text-center'>-</td>
                <td class='text-center'>-</td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>


@section('scripts2')

<script>

$(document).ready(()=>{
    $('.col-tab').click((evt)=>{
        $('.col-tab').removeClass('active')
        var col = $(evt.target)
        col.addClass('active')
        $('.column').css('display','none')
        $('#col-' + col.data('id')).css('display','block')
    })
})

</script>

@endsection
