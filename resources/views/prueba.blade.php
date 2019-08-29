@extends('layouts.admin2')

@section('content')

dfd
@foreach($subcategories as $subcategory)
    <p> aquí {{$subcategory->nombre}}</p>
@endforeach

@endsection