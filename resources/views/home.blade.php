@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app" data-user="{{ json_encode($user) }}"></div>
</div>
@endsection
