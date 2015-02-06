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
