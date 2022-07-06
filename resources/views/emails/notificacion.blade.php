@component('mail::message')

!Bienvenido {{$name}} a KUSASOFT! Usted fue registrado al Sistema de reserva de aulas.

Credenciales de acceso  

Usuario:  {{$email}}

Contraseña: {{$password}}   

Nota : Por tu seguridad no compartas con nadie tus credenciales de acceso.  

Accede a tu cuenta: http://kusasoft.tis.cs.umss.edu.bo/login

@endcomponent