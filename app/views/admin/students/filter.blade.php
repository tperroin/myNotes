@foreach($students as $key => $value)
    <tr>
        <td>{{ $value->firstname }}</td>
        <td>{{ $value->lastname }}</td>
        <td><a href="{{ URL::to('admin/classrooms/' . $value->classroom_id) }}">{{ $value->classroom_code }}</a></td>
        @if($value->user_id)
        <td><a href="{{ URL::to('admin/users/' . $value->user_id) }}">{{ $value->user_username }}</a></td>
        @else
        <td><a href="{{ URL::to('admin/students/' . $value->id . '/create/user') }}">Créer un compte</a></td>
        @endif
        <td>
            <a href="{{ URL::to('admin/students/' . $value->id) }}"><i class="ui unhide link icon"></i></a>
            <a href="{{ URL::to('admin/students/' . $value->id . '/edit') }}"><i class="ui edit link icon"></i></a>
            {{ Form::open(array('route' => array('admin.students.destroy', $value->id), 'method' => 'delete')) }}
                <button type="submit" class="ui delete link icon">Supprimer</button>
            {{ Form::close() }}
        </td>
    </tr>
@endforeach