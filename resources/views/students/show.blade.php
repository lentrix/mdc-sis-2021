@extends('page')

@section('content')

<h1>Student Information</h1>
<hr>

<div class="row">
    <div class="col-md-3">
        {{-- placeholder for student picture --}}
        {{-- <div style="width: 100%; padding-top: 134%; background-color: #aabbcc"></div> --}}
        <img src="{{$student->profile_pic}}" style="width: 100%" alt="">
    </div>
    <div class="col">
        <div class="d-flex align-items-start" style="margin:0; padding:0">
            <h2 style="flex: 1">{{$student->fullName}}</h2>
            <a href="{{url('/students/edit/' . $student->id)}}" class="btn btn-info">
                <i class="fa fa-edit"></i> Edit Info
            </a>
        </div>
        <hr class="p-0 mb-2 mt-0">
        <div>
            <div class="info-item"><i>ID Number</i><span>{{$student->id_number}}-{{$student->id_extension}}</span></div>
            <div class="info-item"><i>LRN</i><span>{{$student->lrn ? $student->lrn : "N/A"}}</span></div>
            <br>
            <div class="info-item"><i>Sex</i><span>{{$student->sex}}</span></div>
            <div class="info-item"><i>Date of birth</i><span>{{$student->birth_date->format('F d, Y')}}</span></div>
            <div class="info-item"><i>Civil Status</i><span>{{$student->civil_status}}</span></div>
            <div class="info-item"><i>Religion</i><span>{{$student->religion}}</span></div>
            <div class="info-item"><i>Address</i><span>{{$student->fullAddress}}</span></div>
            <div class="info-item"><i>Phone</i><span>{{$student->phone}}</span></div>
            <div class="info-item"><i>Nationality</i><span>{{$student->nationality}}</span></div>
            <br>
            <div class="info-item"><i>Father's Name</i><span>{{$student->father}}</span></div>
            <div class="info-item"><i>Father's Occupation</i><span>{{$student->occupation_father}}</span></div>
            <div class="info-item"><i>Mother's Name</i><span>{{$student->mother}}</span></div>
            <div class="info-item"><i>Mother's Occupation</i><span>{{$student->occupation_mother}}</span></div>
            <div class="info-item"><i>Address of Parents</i><span>{{$student->parents_address}}</span></div>

        </div>
    </div>
</div>
<div class="bg-light-blue pb-4">
    <div class="float-right">
        <button class="btn btn-info mt-3 mr-3">+Add</button>
    </div>
    <h3 class='col pt-3'>Educational Background</h3>
    <hr>

    <div class="col">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-info text-white">
                    <th>Level</th>
                    <th>School</th>
                    <th>Address</th>
                    <th>Year</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection
