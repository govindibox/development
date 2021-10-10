Username : {{ $profile->name }}<br>
Email : {{ $profile->email }}<br>
First Name : {{ $profile->profile->first_name }}<br>
Last Name : {{ $profile->profile->last_name }}<br>
Mobile : {{ $profile->profile->mobile }}<br>
Date of Birth : {{ \Carbon\Carbon::parse($profile->profile->dob)->format('j F, Y') }}<br>
Role : {{ $profile->role->name }}<br>
Transaction Id: {{ $profile->transaction[0]->transaction_id }}<br>
Amount : {{ $profile->transaction[0]->amount }}<br>