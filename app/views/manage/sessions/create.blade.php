@extends('layout')

    @section('navigation')
        <div class="ui secondary pointing blue vertical menu">
            <div class="item">
                <a class="item" href="{{ URL::to('home') }}">
                    Accueil <i class="home icon"></i>
                </a>
                <div class="menu">
                    <a class="active item" href="{{ URL::to('sessions') }}">Gérer les sessions</a>
                </div>
            </div>
        </div>
        @if(Auth::user())
        @isGranted('admin')
        <div class="ui secondary vertical pointing menu">
            <a class="item" href="{{ URL::to('admin') }}">
                <i class="dashboard icon"></i> Administration
            </a>
        </div>
        @endIsGranted
        @endif
    @stop

    @section('content')
        {{ HTML::ul($errors->all()) }}

        {{ Form::open(array('url' => '/sessions', 'class' => 'ui form')) }}

                {{ Form::label('date', 'Date') }}
                {{ Form::text('date', Input::old('date')) }}

                {{ Form::label('cours', 'Cours') }}
                {{ Form::select('cours', array('' => 'Choisir un cours') + $courses, Input::old('cours')) }}

                {{ Form::label('formateur', "Formateur") }}
                {{ Form::select('formateur', array('' => 'Choisir un formateur') + $formateurs, Input::old('formateur')) }}

                {{ Form::label('classroom', "Classe") }}
                {{ Form::select('classroom', array('' => 'Choisir une classe') + $classrooms, Input::old('classroom')) }}

                {{ Form::label('students[]', 'Elèves') }}
                {{ Form::select('students[]', array('' => 'Choisir des élèves') + $students, Input::old('students[]'), array('multiple')) }}


            {{ Form::submit('Ajouter', array('class' => 'ui positive button')) }}

        {{ Form::close() }}
    @stop