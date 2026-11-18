@extends('layouts.app')
@section('title','Edit Task')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">UPDATE TASK</p><h1>Edit task</h1><p class="subhead">Update its details or mark it done.</p></div></section>
@include('tasks._form',['task'=>$task])
@endsection
