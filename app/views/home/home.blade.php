@extends('layout')


    @section('navigation')
        <div class="ui secondary pointing blue vertical menu">
            <div class="item">
                <a class="item" href="{{ URL::to('home') }}">
                    Accueil <i class="home icon"></i>
                </a>
                <div class="menu">
                    <a class="item" href="{{ URL::to('sessions') }}">Gérer les sessions</a>
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
     <h2 class="ui orange header">
       Bienvenue, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
       <div class="sub header">Application de ...</div>
     </h2>

                <div class="ui cards">
                    <div class="card">
                        <div class="content">
                            <div class="header">Sessions</div>
                        </div>
                        <a href="{{ URL::to('sessions') }}" class="ui bottom teal attached button">
                            <i class="add icon"></i>
                            Gérer les sessions
                        </a>
                    </div>
                </div>
    @stop
