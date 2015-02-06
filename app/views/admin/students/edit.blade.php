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

                    <a class="item" href="{{ URL::to('admin/users') }}">Gérer les utilisateurs</a>
                    <a class="active item" href="{{ URL::to('admin/curriculums') }}">Gérer les cursus</a>
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

        <h1>Editer l'élève : {{$student->firstname}} {{$student->lastname}}</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::model($student, array('route' => array('admin.students.update', $student->id), 'method' => 'PUT', 'class' => 'ui form')) }}

                {{ Form::label('firstname', 'Nom') }}
                {{ Form::text('firstname', Input::old('firstname')) }}

                {{ Form::label('lastname', 'Prénom') }}
                {{ Form::text('lastname', Input::old('lastname')) }}

                {{ Form::label('classroom', 'Classe') }}
                {{ Form::select('classroom', $classrooms , Input::old('classroom')) }}


            {{ Form::submit('Editer', array('class' => 'ui positive button')) }}

        {{ Form::close() }}

    @stop


@endIsGranted