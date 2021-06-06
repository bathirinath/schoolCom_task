@extends('layout.layout')
@section('content')

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">



<div class="row">
    <div class="col-sm-4"><h2 class="text-title">Student List</h2></div>
    <div class="col-sm-4">
        @if($data)
        <span style="color:blue;font-weight: bold;">Class : </span>
        <select id="classSel" style="width:100px;" onchange="funList()">
            @foreach($data['class'] as $class)
                <option>{{ $class->class }}</option>
            @endforeach
        </select>
        <span style="color:blue;font-weight: bold;">Section : </span>
        <select id="sectionSel" style="width:100px;" onchange="funList()">
             @foreach($data['section'] as $section)
                <option>{{ $section->section }}</option>
            @endforeach
        </select>
        @endif
    </div>
    <div class="col-sm-4"></div>    
</div>
<hr>
<table class="table table-bordered yajra-datatable">
    <thead>
        <tr>
            <th>Roll No</th>
            <th>Admission No</th>
            <th>Name</th>           
            <th>Father Name</th>
            <th>Mother Name</th>
            <th>DOB</th>
            <th>Mobile</th>
        </tr>
    </thead>
    <tbody> 
    </tbody>
</table>

@endsection

@section('customscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
    funList();   
});
function funList() {
    var selClass = $('#classSel').val();
    var selSection = $('#sectionSel').val();
    var table = $('.yajra-datatable').DataTable({
        bDestroy: true,
        processing: true,
        serverSide: true,
        ajax: { 
            "url": "{{ route('studentList') }}", 
            "data": { 'selClass':selClass, 'selSection':selSection} 
        } ,
        columns: [
            {data: 'roll_no', name: 'roll_no'},
            {data: 'admission_no', name: 'admission_no'},
            {data: 'name', name: 'name'},
            {data: 'father_name', name: 'father_name'},
            {data: 'mother_name', name: 'mother_name'},
            {data: 'dob', name: 'dob'},
            {data: 'mobile', name: 'mobile'}
        ]
    });
}

</script>
@endsection