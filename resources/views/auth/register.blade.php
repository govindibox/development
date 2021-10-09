@extends('layout')
@section('title','Register')
@section('content')
<form action='{{ route('register') }}' method='POST'>
    @csrf
    Username : <input type='text' id='username' name='username' value='{{ old('username') }}'>
    @error('username')
        {{ $message }}
    @enderror
    <br>
    Email : <input type='text' id='email' name='email' value='{{ old('email') }}'>
    @error('email')
        {{ $message }}
    @enderror
    <br>
    Password : <input type='password' id='password' name='password' value=''>
    @error('password')
        {{ $message }}
    @enderror
    <br>
    Confirm Password : <input type='password' id='password_confirmation' name='password_confirmation' value=''>
    @error('password_confirmation')
        {{ $message }}
    @enderror
    <br>
    Mobile : <input type='text' id='mobile' name='mobile' value='{{ old('mobile') }}'>
    @error('mobile')
        {{ $message }}
    @enderror
    <br>
    First Name : <input type='text' id='first_name' name='first_name' value='{{ old('first_name') }}'>
    @error('first_name')
        {{ $message }}
    @enderror
    <br>
    Last Name : <input type='text' id='last_name' name='last_name' value='{{ old('last_name') }}'>
    @error('last_name')
        {{ $message }}
    @enderror
    <br>
    Date of Birth : <input type='text' id='dob' name='dob' value='{{ old('dob') }}'>
    @error('dob')
        {{ $message }}
    @enderror
    <br>
    <input type='submit' id='register' name='register' value='Register'>
</form>
@endsection