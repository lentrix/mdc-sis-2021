<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Section List</title>
    <style>
        *{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
    </style>

</head>
<body>

    <p style="text-align: center;">
        <strong>MATER DEI COLLEGE</strong> <br>
        Tubigon, Bohol <br><br>

        <strong>SECTION LIST</strong> <br>
        Section: {{$section->name}} | Adviser: {{$section->adviser->short_name}}
    </p>

    <table style="margin-left: auto; margin-right:auto">
        <tr>
            <th style="text-align:left">#</th>
            <th style="text-align:left">ID Number</th>
            <th style="text-align:left">Last Name</th>
            <th style="text-align:left">First Name</th>
            <th style="text-align:left">Program</th>
            <th style="text-align:left">Level</th>
        </tr>
        @foreach($section->enrols as $index=>$enrol)
        <tr>
            <td>{{$index+1}}.&nbsp;&nbsp;</td>
            <td>{{str_pad($enrol->student->id_number, 7, "0", STR_PAD_LEFT)}}-{{$enrol->student->id_extension}}&nbsp;&nbsp;</td>
            <td>{{$enrol->student->last_name}}</td>
            <td>, &nbsp;&nbsp;{{$enrol->student->first_name}}</td>
            <td>{{$enrol->program->short_name}}</td>
            <td>{{ Str::substr($enrol->level, 1, 1) }}</td>
        </tr>
        @endforeach
    </table>

    <p style="font-size: 0.8em">
        Generated {{$now}} <br />Note: This is a system generated document and does not require a signature.
    </p>

</body>
</html>
