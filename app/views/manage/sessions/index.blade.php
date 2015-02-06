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
        <h2 class="ui orange header">
           Gérer les sessions
           <div class="sub header"></div>
         </h2>

        {{ Form::open(array('url' => '/sessions/filter', 'class' => 'ui form', 'id' => 'form_session_filter')) }}

                <div class="three fields">
                    <div class="field">
                        {{ Form::label('date', 'Date') }}
                        {{ Form::text('date', Input::old('date')) }}
                    </div>
                    <div class="field">
                        {{ Form::label('cours', "Cours") }}
                        {{ Form::text('cours', Input::old('cours')) }}
                    </div>
                    <div class="field">
                        {{ Form::label('Filtrer', "") }}
                        {{ Form::submit('Filtrer', array('class' => 'ui blue button')) }}
                    </div>
                </div>

        {{ Form::close() }}
        <table class="ui table" id="user_table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Elèves</th>
                    <th>Cours</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            @foreach($sessions as $key => $value)
                <tr>
                    <td>{{$value->date}}</td>
                    <td>
                    <div class="ui bulleted list">
                    @foreach($value->students as $key => $value1)
                    <a href="{{ URL::to('admin/students/' . $value1->id) }}" class="item">{{ $value1->firstname }} {{ $value1->lastname }}</a>

                    @endforeach
                    </div>
                    </td>
                    <td>{{$value->cours->libelle}} : {{ $value->cours->time }}</td>
                    <td>
                        <a href="{{ URL::to('sessions/' . $value->id) }}"><i class="ui unhide link icon"></i></a>
                        <a href="{{ URL::to('sessions/' . $value->id . '/edit') }}"><i class="ui edit link icon"></i></a>
                        {{ Form::open(array('route' => array('sessions.destroy', $value->id), 'method' => 'delete')) }}
                            <button type="submit" class="ui delete link icon">Supprimer</button>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach


            </tbody>
            <tfoot class="full-width">
                <tr>
                    <th>
                    Total :
                    <a class="ui purple circular label">
                         {{ $nb_sessions }} sessions
                    </a>
                    </th>
                    <th></th>
                    <th></th>
                    <th>
                        <a href="{{URL::to('sessions/create')}}" class="ui right floated small positive labeled icon button">
                            <i class="icon add"></i> Ajouter une session
                        </a>
                    </th>
                </tr>

            </tfoot>
        </table>
    @stop