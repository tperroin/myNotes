@extends('layout')

@section('center')

<div class="ui sixteen wide column segment">
{{ Form::open(array('url' => '/login', 'class' => 'ui form')) }}
<h1>Connexion </h1>

    {{ $errors->first('username') }}
    {{ $errors->first('password') }}

    {{ Form::label('username', "Nom d'utilisateur") }}
    {{ Form::text('username', Input::old('username'), array('placeholder' => 'p.nom')) }}

    {{ Form::label('password', 'Mot de passe') }}
    {{ Form::password('password') }}

{{ Form::submit('Submit!', array('class' => 'ui positive button')) }}
{{ Form::close() }}
</div>

@stop