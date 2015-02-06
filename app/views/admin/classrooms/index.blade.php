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
                    <a class="active item" href="{{ URL::to('admin/classrooms') }}">Gérer les classes</a>
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
        {{ Form::open(array('url' => '/admin/classrooms/filter', 'class' => 'ui form', 'id' => 'form_classroom_filter')) }}

                    <div class="four fields">
                        <div class="field">
                            {{ Form::label('code', 'Code') }}
                            {{ Form::text('code', Input::old('code')) }}
                        </div>
                        <div class="field">
                            {{ Form::label('curriculum', 'Cursus') }}
                            {{ Form::select('curriculum', array('' => 'Tous') + $curriculums , Input::old('curriculum')) }}
                        </div>
                        <div class="field">
                            {{ Form::label('Filtrer', "") }}
                            {{ Form::submit('Filtrer', array('class' => 'ui blue button')) }}
                        </div>
                    </div>

            {{ Form::close() }}
        <table class="ui table" id="classroom_table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Libellé</th>
                    <th>Cursus</th>
                    <th>Nombre d'élèves</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            @foreach($classrooms as $key => $value)
                <tr>
                    <td>{{ $value->code }}</td>
                    <td>{{ $value->libelle }}</td>
                    <td><a href="{{ URL::to('admin/curriculums/' . $value->curriculum->id) }}">{{ $value->curriculum->code }}</a></td>
                    <td>
                        @foreach($nb_students_by_classroom as $key => $value1)
                            @if($value->id == $value1->id)
                                {{$value1->total}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ URL::to('admin/classrooms/' . $value->id) }}"><i class="ui unhide link icon"></i></a>
                        <a href="{{ URL::to('admin/classrooms/' . $value->id . '/edit') }}"><i class="ui edit link icon"></i></a>
                        {{ Form::open(array('route' => array('admin.classrooms.destroy', $value->id), 'method' => 'delete')) }}
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
                        {{ $nb_classrooms }} classes
                    </a>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <a href="{{URL::to('admin/classrooms/create')}}" class="ui right floated small positive labeled icon button">
                            <i class="icon add"></i> Ajouter une classe
                        </a>
                    </th>
                </tr>

            </tfoot>
        </table>
    @stop

@endIsGranted