@extends('layouts.app')
@section('title', 'Create User')
@section('content')
<section class="page-heading"><p class="eyebrow">NEW RECORD</p><h1>Create user account</h1><p class="lead">Add a team member to the POS directory.</p></section>
@include('users._form', ['user' => $user])
@endsection
