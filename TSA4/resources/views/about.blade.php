@extends('layouts.app')
@section('title','About')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">ABOUT DAYMARK</p><h1>A calmer way to see the day.</h1><p class="subhead">A task manager built with Laravel.</p></div></section>
<article class="about-card"><h2>About this application</h2><p>Daymark uses Laravel migrations and Eloquent to manage tasks. The Today and All Tasks pages stay public. Creating, editing, and archiving tasks requires an authenticated account.</p><p>When an active task changes from another status to done, the app creates an email using the log mail driver.</p><p class="credit">Developer · Mark Gian</p></article>
@endsection
