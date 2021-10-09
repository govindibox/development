@extends('layout')
@section('title','Update Profile')
@section('content')

@if(session('status'))
<div>{{ session('status') }}</div>
@endif
<br>
<form action='{{ route('profile.update',['profile'=> $profile->id]) }}' method='POST' enctype='multipart/form-data'>
    @method('PUT')
    @csrf
    Username : <input type='text' id='username' name='username' value='{{ old('username', optional($profile??null)->name) }}'>
    @error('username')
        {{ $message }}
    @enderror
    <br>
    Email : <input type='text' id='email' name='email' value='{{ old('email', optional($profile??null)->email) }}'>
    @error('email')
        {{ $message }}
    @enderror
    <br>
    Mobile : <input type='text' id='mobile' name='mobile' value='{{ old('mobile', optional($profile??null)->profile->mobile) }}'>
    @error('mobile')
        {{ $message }}
    @enderror
    <br>
    First Name : <input type='text' id='first_name' name='first_name' value='{{ old('first_name', optional($profile??null)->profile->first_name) }}'>
    @error('first_name')
        {{ $message }}
    @enderror
    <br>
    Last Name : <input type='text' id='last_name' name='last_name' value='{{ old('last_name', optional($profile??null)->profile->last_name) }}'>
    @error('last_name')
        {{ $message }}
    @enderror
    <br>
    Date of Birth : <input type='text' id='dob' name='dob' value='{{ old('dob', \Carbon\Carbon::parse(optional($profile??null)->profile->dob)->format('d/m/Y')) }}'>
    @error('dob')
        {{ $message }}
    @enderror
    <br>
    Role : 
    <select id='role' name='role'>
        <option value=''>Select</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ ($role->id==old('role', optional($profile??null)->profile->role_id))?'selected':''}}>{{ $role->name }}</option>
        @endforeach        
    </select>
    @error('role')
        {{ $message }}
    @enderror
    <br>
    Picture : <input type='file' id='picture' name='picture'>
    @error('picture')
        {{ $message }}
    @enderror
    <br>
    <img src="{{ $profile->profile->user_picture() }}" width='200'/><br>
    <input type='submit' id='update_profile' name='update_profile' value='Update'>
</form>
@endsection