{!!Form::open(['route'=>['reactivos.destroy',$reactivo->id],'method'=>'DELETE'])!!}
{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
