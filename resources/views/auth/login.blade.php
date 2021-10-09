@extends('layout')
@section('title','Login')
@section('content')
<form action='{{ route('login') }}' method='POST'>
    @csrf
    Username : <input type='text' id='name' name='name' value='{{ old('username') }}'>
    @error('name')
        {{ $message }}
    @enderror
    <br>
    Password : <input type='password' id='password' name='password' value=''>
    @error('password')
        {{ $message }}
    @enderror   
    <br>
    <input type='submit' id='login' name='login' value='Login'>
</form>
@endsection

