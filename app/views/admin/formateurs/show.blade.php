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
                    <a class="active item" href="{{ URL::to('admin/formateurs') }}">Gérer les formateurs</a>
                    <a class="item" href="{{ URL::to('admin/students') }}">Gérer les élèves</a>
                    <a class="item" href="{{ URL::to('admin/courses') }}">Gérer les cours</a>
                </div>
            </div>
        </div>
        @endIsGranted
        @endif
    @stop

@section('content')

<div class="ui card">
  <div class="image">
    {{ HTML::image("img/elliot.jpg", "User") }}
  </div>
  <div class="content">
    <a class="header">{{$formateur->firstname}} {{$formateur->lastname}}</a>
    <div class="meta">
      <span class="date">Dernière connexion le : {{ date("d M Y",strtotime($formateur->updated_at)) }}</span>
    </div>
  </div>
  <div class="extra content">
    <a>
      <i class="home icon"></i> {{ $formateur->address }} {{ $formateur->cp }}
      <br/>
      <i class="comment icon"></i> <a href="mailto:{{ $formateur->email }}">{{ $formateur->email }}</a>
    </a>
  </div>
</div>

@stop
@endIsGranted