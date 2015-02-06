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