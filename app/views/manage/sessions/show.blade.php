@extends('admin/index')

@isGranted('admin')

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

<div class="ui card">
  <div class="image">
    {{ HTML::image("img/elliot.jpg", "User") }}
  </div>
  <div class="content">
    <a class="header">{{$session->cours->libelle}}</a>
    <div class="meta">
      <span class="date">Dispensé à partir du {{ date("d M Y",strtotime($session->date)) }} pour {{ $session->cours->time }}</span>
    </div>
  </div>
  <div class="extra content">
      <i class="users icon"></i>
      <div class="ui bulleted list">
        @foreach($session->students as $key => $value1)
        <a href="{{ URL::to('admin/students/' . $value1->id) }}" class="item">{{ $value1->firstname }} {{ $value1->lastname }}</a>
        @endforeach
        </div>
  </div>
</div>

@stop
@endIsGranted