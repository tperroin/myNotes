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