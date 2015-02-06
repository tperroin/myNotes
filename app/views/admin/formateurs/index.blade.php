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
        @if (Session::has('message'))
            <div class="ui info message">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('message_error'))
            <div class="ui error message">{{ Session::get('message_error') }}</div>
        @endif
            {{ Form::open(array('url' => '/admin/formateurs/filter', 'class' => 'ui form', 'id' => 'form_formateur_filter')) }}

                    <div class="six fields">
                        <div class="field">
                            {{ Form::label('firstname', 'Nom') }}
                            {{ Form::text('firstname', Input::old('firstname')) }}
                        </div>
                        <div class="field">
                            {{ Form::label('lastname', 'Prénom') }}
                            {{ Form::text('lastname', Input::old('lastname')) }}
                        </div>
                        <div class="field">
                            {{ Form::label('address', 'Adresse') }}
                            {{ Form::text('address', Input::old('address')) }}
                        </div>
                        <div class="field">
                            {{ Form::label('cp', 'Code Postal') }}
                            {{ Form::text('cp', Input::old('cp')) }}
                        </div>
                        <div class="field">
                            {{ Form::label('email', "Email") }}
                            {{ Form::text('email', Input::old('email')) }}
                        </div>
                        <div class="field">
                            {{ Form::label('Filtrer', "") }}
                            {{ Form::submit('Filtrer', array('class' => 'ui blue button')) }}
                        </div>
                    </div>

            {{ Form::close() }}
        <table class="ui table" id="formateur_table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>Email</th>
                    <th>Utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            @foreach($formateurs as $key => $value)
                <tr>
                    <td>{{ $value->firstname }}</td>
                    <td>{{ $value->lastname }}</td>
                    <td>{{ $value->address }}</td>
                    <td>{{ $value->cp }}</td>
                    <td>{{ $value->email }}</td>
                    @if($value->user)
                    <td><a href="{{ URL::to('admin/users/' . $value->user->id) }}">{{ $value->user->username }}</a></td>
                    @else
                    <td><a href="{{ URL::to('admin/formateurs/' . $value->id . '/create/user') }}">Créer un compte</a></td>
                    @endif
                    <td>
                        <a href="{{ URL::to('admin/formateurs/' . $value->id) }}"><i class="ui unhide link icon"></i></a>
                        <a href="{{ URL::to('admin/formateurs/' . $value->id . '/edit') }}"><i class="ui edit link icon"></i></a>
                        {{ Form::open(array('route' => array('admin.formateurs.destroy', $value->id), 'method' => 'delete')) }}
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
                        {{ $nb_formateurs }} formateurs
                    </a>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <a href="{{URL::to('admin/formateurs/create')}}" class="ui right floated small positive labeled icon button">
                            <i class="icon add"></i> Ajouter un formateur
                        </a>
                    </th>
                </tr>
            </tfoot>
        </table>
    @stop

@endIsGranted