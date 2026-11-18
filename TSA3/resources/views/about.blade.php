@extends('layouts.app')
@section('title','About')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">ABOUT DAYMARK</p><h1>A calmer way to see the day.</h1><p class="subhead">A small task manager built for the Laravel summative assessment.</p></div></section>
<article class="about-card"><h2>About this application</h2><p>Daymark demonstrates Laravel migrations, Eloquent models, controllers, and separate Blade views. The Today page filters tasks by the current date; All tasks displays every record in date order.</p><p class="credit">Developer · Mark Gian</p></article>
@endsection
