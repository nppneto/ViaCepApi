@extends('includes.header')

@section('title', "Cadastrar CEP")

@section('content')

<br>

<h2>Cadastrar CEP</h2>

<br>

<div class="container col-sm">
	
	<form action="{{route('ceps.store')}}" method="POST">
		@include('ceps.fields')
	</form>

</div>

@endsection

@extends('includes.footer')