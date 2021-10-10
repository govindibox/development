@extends('layout')
@section('title','Payment')
@section('content')
<br>
Username : {{ $profile->name }}<br>
Email : {{ $profile->email }}<br>
First Name : {{ $profile->profile->first_name }}<br>
Last Name : {{ $profile->profile->last_name }}<br>
Mobile : {{ $profile->profile->mobile }}<br>
Date of Birth : {{ \Carbon\Carbon::parse($profile->profile->dob)->format('j F, Y') }}<br>
Role : {{ $profile->role->name }}<br>
<form action="{{ route('payment.payu') }}" method="POST">
    @csrf
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount" value="{{ old('amount') }}">
    @error('amount')
        {{ $message }}
    @enderror
    <br>
    <input type="submit" value="Pay">
</form>
@endsection