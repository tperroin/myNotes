@extends('layout')

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
                    <a class="item" href="{{ URL::to('admin/classrom') }}">Gérer les classes</a>
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
            <div class="ui cards">
              <div class="card">
                <div class="content">
                  <div class="header">Utilisateurs</div>
                </div>
                <a href="{{ URL::to('admin/users') }}" class="ui bottom teal attached button">
                  <i class="add icon"></i>
                  Gérer les utilisateurs
                </a>
              </div>
              <div class="card">
                <div class="content">
                  <div class="header">Cursus</div>
                </div>
                <a href="{{ URL::to('admin/curriculums') }}" class="ui bottom teal attached button">
                  <i class="add icon"></i>
                  Gérer les cursus
                </a>
              </div>
              <div class="card">
                <div class="content">
                  <div class="header">Classes</div>
                </div>
                <a href="{{ URL::to('admin/classrooms') }}" class="ui bottom teal attached button">
                  <i class="add icon"></i>
                  Gérer les classes
                </a>
              </div>
              <div class="card">
                <div class="content">
                  <div class="header">Formateurs</div>
                </div>
                <a href="{{ URL::to('admin/formateurs') }}" class="ui bottom teal attached button">
                  <i class="add icon"></i>
                  Gérer les formateurs
                </a>
              </div>
              <div class="card">
                <div class="content">
                  <div class="header">Elèves</div>
                </div>
                <a href="{{ URL::to('admin/students') }}" class="ui bottom teal attached button">
                  <i class="add icon"></i>
                  Gérer les élèves
                </a>
              </div>
              <div class="card">
                <div class="content">
                  <div class="header">Cours</div>
                </div>
                <a href="{{ URL::to('admin/courses') }}" class="ui bottom teal attached button">
                  <i class="add icon"></i>
                  Gérer les cours
                </a>
              </div>
            </div>
    @stop