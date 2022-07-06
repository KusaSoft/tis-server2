
@component('mail::message')

!Buenos dias {{$nombre}}! su solicitud de reserva fue <?php if($estado == 'assigned'){
  echo("asignada")."\n";
  echo("emitido: ".$emitido)."\n";
  echo("en nombre de: ".$nombre)."\n";
  echo("motivo: ".$motivo)."\n";
  echo("materia: ".$materia)."\n";
  echo("estudiantes: ".$estudiantes)."\n";
  echo("desde: ".$hora_ini." hasta: ".$hora_fin)."\n";
  echo("aulas: ")."\n";
  foreach($aulas as $aula){
    echo($aula." ");
  }
}else if($estado == 'rejected'){
    echo("rechazada");
  }
?>

Accede a tu cuenta: http://kusasoft.tis.cs.umss.edu.bo/login

@endcomponent