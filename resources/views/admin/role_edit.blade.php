@extends('layout')

@section('title','Edit New Role')
@section('content')

<div>
    @if(session('status'))
    {{ session('status') }}
    @endif
</div>

<form action="{{ route('role.update',['role'=>$role->id]) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.partial_template.role_form')
    <br><br>    
    <input type="submit" value="Update Role">
</form> 
  
@endsection