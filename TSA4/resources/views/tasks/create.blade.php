@extends('layouts.app')
@section('title','Create Task')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">NEW TASK</p><h1>Make a plan.</h1><p class="subhead">Add a task to your list.</p></div></section>
@include('tasks._form',['task'=>$task])
@endsection
