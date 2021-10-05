@extends('layout')

@section('content')

@if(session('status'))
{{ session('status') }}
@endif

@foreach ($roles as $k=>$role)
{{ $role->name }} 
<form action="{{ route('role.destroy',['role'=>$role->id]) }}" method="POST" onsubmit="return delete_confirm();">
    @method('DELETE')
    @csrf
    <button>Delete</button>
</form>
<br>
@endforeach
  
@endsection

<script>
function delete_confirm(){
    var r = confirm("Are you sure want to delete this record ?");
    if (r == true){
        return true;
    }else{
        return false;
    }   
}
</script>