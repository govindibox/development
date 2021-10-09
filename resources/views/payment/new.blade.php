@extends('layout')

@section('title','Payment')
@section('content')

<div>
    @if(session('status'))
    {{ session('status') }}
    @endif
</div>

<form action="{{ route('payment.payu') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}">
    @error('name')
        {{ $message }}
    @enderror
    <br><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="{{ old('email') }}">
    @error('email')
        {{ $message }}
    @enderror
    <br><br>
    <label for="mobile">Mobile:</label>
    <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}">
    @error('mobile')
        {{ $message }}
    @enderror
    <br><br>
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount" value="{{ old('amount') }}">
    @error('amount')
        {{ $message }}
    @enderror
    <br><br>    
    <input type="submit" value="Pay">
</form> 
  
@endsection