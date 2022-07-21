<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Study Load - Unified SIS</title>

    <style>
        *{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 0.8em;
        }
        th, td {
            border: 1px solid #777;
        }

    </style>
</head>
<body>
    <p style="text-align: center;">
        <strong>MATER DEI COLLEGE</strong> <br>
        Tubigon, Bohol <br><br>

        <strong>STUDY LOAD</strong> <br>
        [{{str_pad($enrol->student->id_number, 7, "0", STR_PAD_LEFT)}}-{{$enrol->student->id_extension}}] {{$enrol->student->full_name}} {{$enrol->program->short_name}}-{{ Str::substr($enrol->level, 1, 1) }} <br>
        {{$enrol->term->name}}
    </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Course</th>
                <th>Description</th>
                <th>Schedule</th>
                <th>Teacher</th>
                <th>Units</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalUnits = 0; ?>
            <?php $subjects = $enrol->withdrawn ? $enrol->withdrawnSubjects : $enrol->enrolSubjects; ?>
            @foreach($subjects as $index=>$subject)
                <?php $totalUnits += $subject->subjectClass->credit_units; ?>
                <tr>
                    <td>{{$index+1}}. </td>
                    <td>{{$subject->subjectClass->course->name}}</td>
                    <td style="width:30%">{{$subject->subjectClass->course->description}}</td>
                    <td style="width:30%">{{$subject->subjectClass->scheduleString}}</td>
                    <td>{{$subject->subjectClass->teacher->short_name}}</td>
                    <td style="text-align:center">{{$subject->subjectClass->credit_units}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">TOTAL UNITS</td>
                <td style="text-align:center">{{$totalUnits}}</td>
            </tr>
        </tbody>
    </table>

    <p style="font-size: 0.8em">
        Generated {{$now}} <br />Note: This is a system generated document and does not require a signature.
    </p>

</body>
</html>
