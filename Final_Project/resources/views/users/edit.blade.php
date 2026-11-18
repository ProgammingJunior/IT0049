@extends('layouts.app')
@section('title','Edit User')
@section('content')
<section class="page-heading"><p class="eyebrow">UPDATE RECORD</p><h1>Edit user account</h1><p class="lead">{{ $user->full_name }}</p></section>
@include('users._form',['user'=>$user])
@endsection
