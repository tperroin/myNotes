@extends('admin/index')

@isGranted('admin')

@section('navigation')
        <div class="ui secondary vertical pointing menu">
          <a class="item" href="{{ URL::to('home') }}">
            <i class="home icon"></i> Accueil
          </a>
        </div>

        {{--Admin menu--}}
        @if(Auth::user())
        @isGranted('admin')
        <div class="ui secondary pointing blue vertical menu">
            <div class="item">
                <a href="{{ URL::to('admin') }}">
                    <i class="dashboard icon"></i> Administration
                </a>
                <div class="menu">

                    <a class="active item" href="{{ URL::to('admin/users') }}">Gérer les utilisateurs</a>
                    <a class="item" href="{{ URL::to('admin/curriculums') }}">Gérer les cursus</a>
                    <a class="item" href="{{ URL::to('admin/classrooms') }}">Gérer les classes</a>
                    <a class="item" href="{{ URL::to('admin/formateurs') }}">Gérer les formateurs</a>
                    <a class="item" href="{{ URL::to('admin/students') }}">Gérer les élèves</a>
                    <a class="item" href="{{ URL::to('admin/courses') }}">Gérer les cours</a>
                </div>
            </div>
        </div>
        @endIsGranted
        @endif
    @stop

    @section('content')

            <h1>Créer un compte utilisateur pour le formateur {{$formateur->lastname}} {{$formateur->firstname}}</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::open(array('url' => '/admin/formateurs/store/user', 'class' => 'ui form')) }}

                {{ Form::label('lastname', 'Nom') }}
                {{ Form::text('lastname', $formateur->firstname, Input::old('lastname')) }}

                {{ Form::label('firstname', 'Prénom') }}
                {{ Form::text('firstname', $formateur->lastname, Input::old('firstname')) }}

                {{ Form::label('email', "Email") }}
                {{ Form::email('email', $formateur->email, Input::old('email')) }}

                {{ Form::label('username', "Nom d'utilisateur") }}
                {{ Form::text('username', Input::old('username')) }}

                {{ Form::label('password', 'Mot de passe') }}
                {{ Form::password('password', Input::old('password')) }}

                {{ Form::label('role', 'Role') }}
                {{ Form::select('role', $roles , Input::old('role')) }}

                {{ Form::hidden('id', $formateur->id, Input::old('id')) }}


            {{ Form::submit('Ajouter', array('class' => 'ui positive button')) }}

        {{ Form::close() }}

    @stop


@endIsGranted