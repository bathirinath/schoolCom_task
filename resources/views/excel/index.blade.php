@extends('layout.layout')
@section('content')

<h2 class="text-title">Import Excel</h2>

<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="import_file" />
    <button class="btn btn-primary">Import File</button>
</form>

@endsection
