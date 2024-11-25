@extends('layouts.hr')
@section('content')
<div class=" d-flex justify-content-center align-items-center ">
    <div class=" flex-column">
     <img src="{{asset('img/5605786.png')}}" alt="company-image">
     
      <h1 class="d-flex justify-content-center">welcome admin{{Auth::user()->name}}</h1>
 </div> 
 </div>
@endsection