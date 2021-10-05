@extends('layout')

@section('title','Add New Role')
@section('content')

<div>
    @if(session('status'))
    {{ session('status') }}
    @endif
</div>

<form action="{{ route('role.store') }}" method="POST">
    @csrf
    @include('admin.partial_template.role_form')
    <br><br>    
    <input type="submit" value="Add Role">
</form> 
  
@endsection