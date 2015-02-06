@foreach($curriculums as $key => $value)
    <tr>
        <td>{{ $value->code }}</td>
        <td>{{ $value->libelle }}</td>
        <td>{{ $value->time }}</td>
        <td>
            <a href="{{ URL::to('admin/curriculums/' . $value->id) }}"><i class="ui unhide link icon"></i></a>
            <a href="{{ URL::to('admin/curriculums/' . $value->id . '/edit') }}"><i class="ui edit link icon"></i></a>
            {{ Form::open(array('route' => array('admin.curriculums.destroy', $value->id), 'method' => 'delete')) }}
                <button type="submit" class="ui delete link icon">Supprimer</button>
            {{ Form::close() }}
        </td>
    </tr>
@endforeach