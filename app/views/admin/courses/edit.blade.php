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
                    <a class="item" href="{{ URL::to('admin/curriculums') }}">Gérer les cursus</a>
                    <a class="item" href="{{ URL::to('admin/classrooms') }}">Gérer les classes</a>
                    <a class="item" href="{{ URL::to('admin/formateurs') }}">Gérer les formateurs</a>
                    <a class="item" href="{{ URL::to('admin/students') }}">Gérer les élèves</a>
                    <a class="active item" href="{{ URL::to('admin/courses') }}">Gérer les cours</a>
                </div>
            </div>
        </div>
        @endIsGranted
        @endif
    @stop

    @section('content')

        <h1>Editer le cours : {{$cours->libelle}} </h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::model($cours, array('route' => array('admin.courses.update', $cours->id), 'method' => 'PUT', 'class' => 'ui form')) }}

                {{ Form::label('libelle', 'Libellé') }}
                {{ Form::text('libelle', Input::old('libelle')) }}

                {{ Form::label('time', 'Durée') }}
                {{ Form::text('time', Input::old('time')) }}


            {{ Form::submit('Editer', array('class' => 'ui positive button')) }}

        {{ Form::close() }}

    @stop


@endIsGranted