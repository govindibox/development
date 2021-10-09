@extends('layout')
@section('title','View Profile')
@section('content')
<br>
Username : {{ $profile->name }}<br>
First Name : {{ $profile->profile->first_name }}<br>
Last Name : {{ $profile->profile->last_name }}<br>
Mobile : {{ $profile->profile->mobile }}<br>
Date of Birth : {{ \Carbon\Carbon::parse($profile->profile->dob)->format('j F, Y') }}<br>
Role : {{ $profile->role->name }}<br>
<img src="{{ $profile->profile->user_picture() }}" width='200'/><br>
<a href="{{ route('profile.edit',['profile'=>$profile->id ]) }}">Edit</a>

@endsection