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
        @if (Session::has('message'))
            <div class="ui info message">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('message_error'))
            <div class="ui error message">{{ Session::get('message_error') }}</div>
        @endif
                {{ Form::open(array('url' => '/admin/users/filter', 'class' => 'ui form', 'id' => 'form_user_filter')) }}

                        <div class="six fields">
                            <div class="field">
                                {{ Form::label('firstname', 'Prénom') }}
                                {{ Form::text('firstname', Input::old('firstname')) }}
                            </div>
                            <div class="field">
                                {{ Form::label('lastname', 'Nom') }}
                                {{ Form::text('lastname', Input::old('lastname')) }}
                            </div>
                            <div class="field">
                                {{ Form::label('username', "Nom d'utilisateur") }}
                                {{ Form::text('username', Input::old('username')) }}
                            </div>
                            <div class="field">
                                {{ Form::label('email', "Email") }}
                                {{ Form::text('email', Input::old('email')) }}
                            </div>
                            <div class="field">
                                {{ Form::label('role', 'Role') }}
                                {{ Form::select('role', array('' => 'Tous') + $roles, Input::old('role')) }}
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
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Nom d'utilisateur</th>
                    <th>E-mail</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            @foreach($users as $key => $value)
                <tr>
                    <td>{{$value->firstname}}</td>
                    <td>{{$value->lastname}}</td>
                    <td>{{$value->username}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->role->name}}</td>
                    <td>
                        <a href="{{ URL::to('admin/users/' . $value->id) }}"><i class="ui unhide link icon"></i></a>
                        <a href="{{ URL::to('admin/users/' . $value->id . '/edit') }}"><i class="ui edit link icon"></i></a>
                        {{ Form::open(array('route' => array('admin.users.destroy', $value->id), 'method' => 'delete')) }}
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
                        {{ $nb_users }} utilisateurs
                    </a>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <a href="{{URL::to('admin/users/create')}}" class="ui right floated small positive labeled icon button">
                            <i class="icon add"></i> Ajouter un utilisateur
                        </a>
                    </th>
                </tr>

            </tfoot>
        </table>
    @stop

@endIsGranted