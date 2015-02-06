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

<div class="ui card">
  <div class="image">
    {{ HTML::image("img/elliot.jpg", "User") }}
  </div>
  <div class="content">
    <a class="header">{{$user->firstname}} {{$user->lastname}}</a>
    <div class="meta">
      <span class="date">Dernière connexion le : {{ date("d M Y",strtotime($user->updated_at)) }}</span>
    </div>
  </div>
  <div class="extra content">
    <a>
      <i class="user icon"></i>
      Role : {{$user->role->name}}
    </a>
  </div>
</div>

@stop
@endIsGranted