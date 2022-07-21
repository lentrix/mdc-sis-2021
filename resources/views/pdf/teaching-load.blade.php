<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teaching Load - Unified SIS</title>
    <style>
        * {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif';
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

        <strong>TEACHING LOAD</strong> <br>
        {{$teacher->name}}
    </p>

    <table>
        <tr>
            <th>#</th>
            <th>Course</th>
            <th>Description</th>
            <th>Schedule</th>
            <th>Dept</th>
            <th>Pax</th>
            <th>Units</th>
        </tr>
        <?php $totalUnits = 0; ?>
        @foreach($subjectClasses as $index=>$class)
            <?php $totalUnits+=$class->credit_units; ?>
            <tr>
                <td>{{$index+1}}.</td>
                <td>{{$class->course->name}}</td>
                <td style="width: 38%">{{$class->course->description}}</td>
                <td style="width: 30%">{{$class->scheduleString}}</td>
                <td>{{$class->department->accronym}}</td>
                <td style="text-align: center">{{$class->studentCount}}</td>
                <td style="text-align: center">{{$class->credit_units}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="font-weight: bold">TOTAL UNITS</td>
            <td style="text-align: center; font-weight: bold">{{$totalUnits}}</td>
        </tr>
    </table>

    <p style="font-size: 0.8em">
        Generated {{$now}} <br />Note: This is a system generated document and does not require a signature.
    </p>
</body>
</html>
