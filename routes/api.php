<?php

use App\Mail\NotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\SubjectUser;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\UserBooking;
use Illuminate\Database\QueryException;
use Symfony\Component\Translation\Dumper\YamlFileDumper;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function () {
//     return $request->user();
// });


Route::get('subjects', function () {
    return Subject::all('id', 'name_subject');
});

Route::get('subjects/{user_id}', function ($user_id) {
    return User::find($user_id)->groups->map(function ($val) {
        $name = $val->name_subject;
        $group = $val->pivot->group;
        return array("id" => $val->id, "subject_name" => $name, "group" => $group);
    });
});

Route::get('groups/{subject_id}/{user_id}', function ($subject_id, $user_id) {
    $groups = SubjectUser::where('subject_id', $subject_id)->where('user_id', $user_id)->get();
    $user_id = $groups[0]->user_id;
    $subject_id = $groups[0]->subject_id;
    $user_name = User::find($user_id)->name;
    $subject_name = Subject::find($subject_id)->name_subject;

    return $groups->map(function ($val) use ($user_id, $user_name, $subject_name) {
        $val->user_id = $user_id;
        $val->name = $user_name;
        $val->subject = $subject_name;
        return $val->only(['id', 'group', 'user_id', 'name', 'subject']);
    });
});

Route::get('groupsExc/{subject_id}/{user_id}', function ($subject_id, $user_id) {
    $groups = SubjectUser::where('subject_id', $subject_id)->where('user_id', '!=', $user_id)->get();
    if (count($groups) == 0) {
        return response()->json([
            "message" => "no hay grupos registrados",
            "successful" => false
        ]);
    }
    $subject_name = Subject::find($subject_id)->name_subject;
    return $groups->map(function ($val) use ($subject_name) {
        $val->name = User::find($val->user_id)->name;
        $val->subject = $subject_name;
        return $val->only(['id', 'group', 'user_id', 'name', 'subject']);
    });
});

Route::post('reservation-request', function (Request $request) {
    if (isset($request->id)) {
        //actualizamos solicitud de reserva que se especifica
        $res = UserBooking::find($request->id);
        if (!isset($res)) {
            return response()->json([
                "message" => "no existe la solicitu de reserva especificada"
            ]);
        }
        $res->user_id = (User::where('name', $request->name)->first()->id);
        $res->subject_id = (Subject::where('name_subject', $request->subject)->first()->id);
        $res->horario_ini = $request->horario_ini;
        $res->horario_end = $request->horario_end;
        $res->request_reason = $request->request_reason;
        $res->reservation_date = $request->reservation_date;
        $res->total_students = $request->total_students;
        $res->state = $request->state;
        // -----------------------------------------------------
        $reservations = UserBooking::where(function ($q) {
            return $q->where('state', 'assigned')->orWhere('state', 'confirmed')->orWhere('state', 'sent');
        })->where('reservation_date', $res->reservation_date)->get()->toArray();
        $reservations = array_filter($reservations, function ($reserv) use ($res) {
            $user_id = $reserv['user_id'];
            $other_groups = $reserv['other_groups'];
            $other_groups_str = preg_split('/\s+/', $other_groups);

            $user_ids = [];
            foreach($other_groups_str as $group){
                $u_id = SubjectUser::find($group)->user_id;
                array_push($user_ids,$u_id);
            }
            if ($user_id == $res->user_id) {
                return true;
            } else if (in_array($user_id, $user_ids)) {
                return true;
            }
            return false;
        });
        $hi1 = $res->horario_ini;
        $he1 = $res->horario_end;
        foreach ($reservations as $reserv) {
            $hi2 = $reserv['horario_ini'];
            $he2 = $reserv['horario_end'];
            if (seSolapan($hi1, $he1, $hi2, $he2)) {
                return response()->json([
                    "message" => "No se puede llevar a cabo la solicitud ya que existen conflicto de hora con solicitudes anteriores",
                    "successful" => false
                ]);
            }
        }
        // ---------------------------------------------------------
        $group_list = "";
        $groups = $request->group_list;
        $len = count($groups);
        for ($i = 0; $i < $len; $i++) {
            if ($i == 0) {
                $group_list .= $groups[$i];
            } else {
                $group_list .= " " . $groups[$i];
            }
        }
        $res->group_list = $group_list;

        $other_groups = "";
        $other_group_list = $request->other_group_list;
        $len2 = count($other_group_list);
        for ($i = 0; $i < $len2; $i++) {
            if ($i == 0) {
                $other_groups .= $other_group_list[$i];
            } else {
                $other_groups .= " " . $other_group_list[$i];
            }
        }
        $res->other_groups = $other_groups;
        $res->save();
        return response()->json([
            "id" => $res->id,
            "user_id" => $res->user_id,
            "name" => $request->name,
            "subject_id" => $res->subject_id,
            "subject" => $request->subject,
            "total_students" => $request->total_students,
            "register_date" => $res->register_date,
            "reservation_date" => $res->reservation_date,
            "horario_ini" => $res->horario_ini,
            "horario_end" => $res->horario_end,
            "state" => $res->state,
            "request_reason" => $res->request_reason,
            "group_list" => $res->group_list,
            "other_group_list" => $res->other_groups
        ]);
    } else {
        //creamos una nueva solicitud de reserva
        $reservation = new UserBooking();
        $reservation->user_id    = (User::where('name', $request->name)->first()->id);
        if (!Subject::where('name_subject', $request->subject)->exists()) {
            return response()->json([
                "message" => "La materia especificada no existe"
            ]);
        }
        $reservation->subject_id = (Subject::where('name_subject', $request->subject)->first()->id);

        $reservation->horario_ini = $request->horario_ini;
        $reservation->horario_end = $request->horario_end;
        $reservation->request_reason = $request->request_reason;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->classroom_id = 1;
        $reservation->state = $request->state;
        // --------------------------------------------------
        $reservations = UserBooking::where(function ($q) {
            return $q->where('state', 'assigned')->orWhere('state', 'confirmed')->orWhere('state', 'sent');
        })->where('reservation_date', $reservation->reservation_date)->get()->toArray();
        $reservations = array_filter($reservations, function ($reserv) use ($reservation) {
            $user_id = $reserv['user_id'];
            $other_groups = $reserv['other_groups'];
            $other_groups_str = preg_split('/\s+/', $other_groups);

            $user_ids = [];
            foreach($other_groups_str as $group){
                $u_id = SubjectUser::find($group)->user_id;
                array_push($user_ids,$u_id);
            }
            if ($user_id == $reservation->user_id) {
                return true;
            } else if (in_array($user_id, $user_ids)) {
                return true;
            }
            return false;
        });
        $hi1 = $reservation->horario_ini;
        $he1 = $reservation->horario_end;
        foreach ($reservations as $reserv) {
            $hi2 = $reserv['horario_ini'];
            $he2 = $reserv['horario_end'];
            if (seSolapan($hi1, $he1, $hi2, $he2)) {
                return response()->json([
                    "message" => "No se puede llevar a cabo la solicitud ya que existen conflicto de hora con solicitudes anteriores",
                    "successful" => false
                ]);
            }
        }
        // -----------------------------------------------------
        $group_list = "";
        $groups = $request->group_list;
        foreach ($groups as $group) {
            if (!SubjectUser::where('id', $group)->exists()) {
                return response()->json([
                    "message" => "Un grupo de la solicitud no esta registrado"
                ]);
            }
        }
        $len = count($groups);
        for ($i = 0; $i < $len; $i++) {
            if ($i == 0) {
                $group_list .= $groups[$i];
            } else {
                $group_list .= " " . $groups[$i];
            }
        }
        $reservation->group_list = $group_list;
        $reservation->total_students = $request->total_students;
        $other_groups = "";
        $other_group_list = $request->other_group_list;
        foreach ($other_group_list as $group) {
            if (!SubjectUser::where('id', $group)->exists()) {
                return response()->json([
                    "message" => "Un grupo de la solicitud no esta registrado"
                ]);
            }
        }
        $len2 = count($other_group_list);
        for ($i = 0; $i < $len2; $i++) {
            if ($i == 0) {
                $other_groups .= $other_group_list[$i];
            } else {
                $other_groups .= " " . $other_group_list[$i];
            }
        }
        $reservation->other_groups = $other_groups;
        date_default_timezone_set("America/La_Paz");
        $reservation->register_date = date('Y-m-d H:i:s');
        $reservation->save();
        return response()->json([
            "id" => $reservation->id,
            "user_id" => $reservation->user_id,
            "name" => $request->name,
            "subject_id" => $reservation->subject_id,
            "subject" => $request->subject,
            "total_students" => $reservation->total_students,
            "register_date" => $reservation->register_date,
            "reservation_date" => $reservation->reservation_date,
            "horario_ini" => $reservation->horario_ini,
            "horario_end" => $reservation->horario_end,
            "state" => $reservation->state,
            "request_reason" => $reservation->request_reason,
            "group_list" => $reservation->group_list,
            "other_group_list" => $reservation->other_groups
        ]);
    }
});

Route::get('reservation/{user_id}/{state}', function ($user_id, $state) {
    $user_name = User::find($user_id)->name;
    $reservations = UserBooking::where('user_id', $user_id)
        ->where('state', $state)
        ->get();
    return $reservations->map(function ($elem) use ($user_name) {
        $subject_name = Subject::find($elem->subject_id)->name_subject;
        $classroom_name = Classroom::find(1)->name_classroom;

        $assigned_classrooms = [];
        $assigned_classrooms_str  = explode(" ", $elem->assigned_classrooms);
        if (strlen($elem->assigned_classrooms)) {
            for ($i = 0; $i < count($assigned_classrooms_str); $i++) {
                $classroom_id = $assigned_classrooms_str[$i];
                $classroom = Classroom::find($classroom_id);
                $classroom_name = $classroom->name_classroom;
                $edifice = $classroom->edifice;
                $floor = $classroom->floor;
                $amount = $classroom->total_students;
                $classroom_arr = [
                    "id" => $classroom_id,
                    "name_classroom" => $classroom_name,
                    "edifice" => $edifice,
                    "floor" => $floor,
                    "amount" => $amount
                ];
                $assigned_classrooms[$i] = $classroom_arr;
            }
        }

        return array(
            "id" => $elem->id,
            "name" => $user_name,
            "subject" => $subject_name,
            "classroom" => $classroom_name,
            "total_students" => $elem->total_students,
            "request_reason" => $elem->request_reason,
            "horario_ini" => $elem->horario_ini,
            "horario_end" => $elem->horario_fin,
            "state" => $elem->state,
            "group_list" => $elem->group_list,
            "other_group_list" => $elem->other_groups,
            "reservation_date" => $elem->reservation_date,
            "register_date" => $elem->register_date,
            "assigned_classrooms" => $assigned_classrooms
        );
    });
});

Route::get('reservation/{userbooking_id}', function ($userbooking_id) {
    $userbooking = UserBooking::find($userbooking_id);
    if (isset($userbooking)) {
        $user_id = $userbooking->user_id;
        $user_name = User::find($user_id)->name;
        $subject_id = $userbooking->subject_id;
        $subject_name = Subject::find($subject_id)->name_subject;
        $group_list_str = explode(" ", $userbooking->group_list);
        $group_list = [];
        for ($i = 0; $i < count($group_list_str); $i++) {
            $group_id = $group_list_str[$i];
            $group = SubjectUser::find($group_id);
            $group_num = $group->group;
            $user = User::find($group->user_id)->name;
            $group_arr = [
                "id" => $group_id,
                "group" => $group_num,
                "teacher" => $user
            ];
            $group_list[$i] = $group_arr;
        }
        $other_group_list_str = preg_split("/\s+/", $userbooking->other_groups);
        $other_group_list = [];
        if (strlen($userbooking->other_groups) > 0) {
            for ($i = 0; $i < count($other_group_list_str); $i++) {
                $group_id = $other_group_list_str[$i];
                $group = SubjectUser::find($group_id);
                $group_num = $group->group;
                $user = User::find($group->user_id)->name;
                $group_arr = [
                    "id" => $group_id,
                    "group" => $group_num,
                    "teacher" => $user
                ];
                $other_group_list[$i] = $group_arr;
            }
        }
        $assigned_classrooms_str = preg_split("/\s+/", $userbooking->assigned_classrooms);
        $assigned_classrooms = [];
        if (strlen($userbooking->assigned_classrooms) > 0) {
            for ($i = 0; $i < count($assigned_classrooms_str); $i++) {
                $classroom_id = $assigned_classrooms_str[$i];
                $classroom = Classroom::find($classroom_id);
                $classroom_name = $classroom->name_classroom;
                $edifice = $classroom->edifice;
                $floor = $classroom->floor;
                $amount = $classroom->total_students;
                $classroom_arr = [
                    "id" => $classroom_id,
                    "name_classroom" => $classroom_name,
                    "edifice" => $edifice,
                    "floor" => $floor,
                    "amount" => $amount
                ];
                $assigned_classrooms[$i] = $classroom_arr;
            }
        }
        return response()->json([
            "id" => $userbooking_id,
            "user_id" => $user_id,
            "user" => $user_name,
            "subject_id" => $subject_id,
            "subject" => $subject_name,
            "classroon_id" => 1,
            "register_date" => $userbooking->register_date,
            "reservation_date" => $userbooking->reservation_date,
            "total_students" => $userbooking->total_students,
            "request_reason" => $userbooking->request_reason,
            "rejection_reason" => $userbooking->rejection_reason,
            "horario_ini" => $userbooking->horario_ini,
            "horario_end" => $userbooking->horario_end,
            "state" => $userbooking->state,
            "group_list" => $group_list,
            "other_groups" => $other_group_list,
            "notification_date" => $userbooking->notification_date,
            "assigned_classrooms" => $assigned_classrooms
        ]);
    } else {
        return response()->json([
            "message" => "no existe esta reserva con el id especificado"
        ]);
    }
});


Route::put('reservation/{userbooking_id}', function (Request $request, $userbooking_id) {
    $reservation = UserBooking::find($userbooking_id);
    if (isset($reservation)) {
        if (isset($request->name)) {
            $user_id = User::where('name', $request->name)->first()->id;
            $reservation->user_id = $user_id;
        }
        if (isset($request->subject)) {
            $subject_id = Subject::where('name_subject', $request->subject)->first()->id;
            $reservation->subject_id = $subject_id;
        }
        if (isset($request->total_students)) {
            $reservation->total_students = $request->total_students;
        }
        if (isset($request->horario_ini)) {
            $reservation->horario_ini = $request->horario_ini;
        }
        if (isset($request->horario_end)) {
            $reservation->horario_end = $request->horario_end;
        }
        if (isset($request->request_reason)) {
            $reservation->request_reason = $request->request_reason;
        }
        if (isset($request->reservation_date)) {
            $reservation->reservation_date = $request->reservation_date;
        }
        if (isset($request->state)) {
            $reservation->state = $request->state;
        }
        if (isset($request->group_list)) {
            $group_list = "";
            for ($i = 0; $i < count($request->group_list); $i++) {
                if ($i == 0) {
                    $group_list .= ($request->group_list[$i]);
                } else {
                    $group_list .= " " . ($request->group_list[$i]);
                }
            }
            $reservation->group_list = $group_list;
        }
        if (isset($request->other_group_list)) {
            $other_groups = "";
            for ($i = 0; $i < count($request->other_group_list); $i++) {
                if ($i == 0) {
                    $group_list .= ($request->other_group_list[$i]);
                } else {
                    $group_list .= " " . ($request->other_group_list[$i]);
                }
            }
            $reservation->other_groups = $other_groups;
            return response()->json([
                "message" => "reserva actualizada"
            ]);
        }
    } else {
        return response()->json([
            "message" => "no existe reserva con el id especificado"
        ]);
    }
});

Route::put('reservation/reject/{userbooking_id}', function (Request $request, $userbooking_id) {
    $reserv = UserBooking::find($userbooking_id);
    if (!isset($reserv)) {
        return response()->json([
            "message" => "La solicitud especificada no existe",
            "successfull" => false
        ]);
    }
    $status = $request->status;
    $rejection_reason = $request->rejection_reason;
    $reserv->state = $status;
    $reserv->rejection_reason = $rejection_reason;
    $reserv->assigned_classrooms = "";
    $reserv->save();
    return response()->json([
        "message" => "La solicitud de reserva se actualizo",
        "successful" => true
    ]);
});

Route::delete('draft/{userbooking_id}', function ($userbooking_id) {
    $ub = UserBooking::find($userbooking_id);
    if (isset($ub)) {
        $reservation = UserBooking::find($userbooking_id)->delete();
        return response()->json([
            "message" => "eliminado con exito"
        ]);
    } else {
        return response()->json([
            "message" => "no existe esta reserva"
        ]);
    }
});

Route::post('/login', function (Request $request) {
    $username = $request->email;
    $password = $request->password;
    $users = User::where('email', $username)->where('password', $password)->get();
    if (count($users) >= 1) {
        $user = $users[0];
        if ($user->enabled == true) {
            return response()->json([
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "role" => $user->role->name,
                "token" => "no hay token",
                "successful" => true
            ]);
        } else {
            return response()->json([
                "message" => "Usted no esta habilidado para acceder al sistema",
                "successful" => false
            ]);
        }
    } else {
        return response()->json([
            "message" => "Credenciales incorrectas",
            "successful" => false
        ]);
    }
});
// ---------------------------------------------------------------------------------------------

//Devuelve todas las solicitudes enviadas(sent) urgentes, osea hasta maximo una semana
Route::get('reservations/urgent', function () {
    date_default_timezone_set("America/La_Paz");
    $reservations = UserBooking::where('state', 'sent')->get();
    $correctReservations = $reservations->filter(function ($res) {
        $d1 = strtotime($res->reservation_date);
        $datetime_now = strtotime(date('Y-m-d h:i:s'));
        if ($d1 < $datetime_now) {
            return false;
        }
        $diff = ($d1 - $datetime_now) / (24 * 60 * 60);
        return $diff <= 7;
    });
    return array_values($correctReservations->toArray());
});

//Devuelve todas las solicitudes enviadas(sent)
Route::get('reservations', function () {
    $res_reqs = UserBooking::where('state', 'sent')->get();

    return array_values($res_reqs->map(function ($elem) {
        $subject_name = Subject::find($elem->subject_id)->name_subject;
        $user_name = User::find($elem->user_id)->name;
        $classroom_name = Classroom::find(1)->name_classroom;
        $group_list_str = explode(" ", $elem->group_list);
        $group_list = [];
        if (strlen($elem->group_list) > 0) {
            for ($i = 0; $i < count($group_list_str); $i++) {
                $group_id = $group_list_str[$i];
                $group = SubjectUser::find($group_id);
                $group_num = $group->group;
                $user = User::find($group->user_id)->name;
                $group_arr = [
                    "id" => $group_id,
                    "group" => $group_num,
                    "teacher" => $user
                ];
                $group_list[$i] = $group_arr;
            }
        }
        $other_group_list_str = explode(" ", $elem->other_groups);
        $other_group_list = [];
        if (strlen($elem->other_groups)) {
            for ($i = 0; $i < count($other_group_list_str); $i++) {
                $group_id = $other_group_list_str[$i];
                $group = SubjectUser::find($group_id);
                $group_num = $group->group;
                $user = User::find($group->user_id)->name;
                $group_arr = [
                    "id" => $group_id,
                    "group" => $group_num,
                    "teacher" => $user
                ];
                $other_group_list[$i] = $group_arr;
            }
        }
        return array(
            "id" => $elem->id,
            "name" => $user_name,
            "subject" => $subject_name,
            "subject_id" => $elem->subject_id,
            "classroom" => $classroom_name,
            "total_students" => $elem->total_students,
            "request_reason" => $elem->request_reason,
            "horario_ini" => $elem->horario_ini,
            "horario_end" => $elem->horario_end,
            "state" => $elem->state,
            "group_list" => $group_list,
            "other_group_list" => $other_group_list,
            "reservation_date" => $elem->reservation_date,
            "register_date" => $elem->register_date,
            "notification_date" => $elem->notification_date
        );
    })->toArray());
});
//Devuelve datos de todos los usuarios del sistema
Route::get('users', function () {
    $user = User::with('role:id,name')->get();
    return response()->json($user);
});

//Recibe datos de un nuevo usuario y los guarda
Route::post('users', function (Request $request) {
    try {
        $user = new User();
        $role = $request->role;
        $name = $request->lastName . " " . $request->firstName;
        if (User::where('name', 'ilike', $name)->exists()) {
            return response()->json([
                "message" => "Ya existe un usuario con el mismo nombre",
                "successful" => false
            ]);
        }
        $email = strtolower($request->email);
        if (User::where('email', $email)->exists()) {
            return response()->json([
                "message" => "Ya existe un usuario con el mismo correo electronico",
                "successful" => false
            ]);
        }
        $user->email = $email;
        $user->name = $name;
        $user->enabled = true;
        $user->password = $request->password;

        $user->email = $request->email;
        $role_id = Role::where('name', $role)->first()->id;
        $user->role_id = $role_id;
        Mail::to($request->email)->send(new NotificationMail("Registro en Kusasoft", $user->name, $user->email, $user->password));
        $user->save();
        return response()->json([
            "message" => 'Enviado exitosamente',
            'successful' => true
        ]);
    } catch (QueryException $exc) {
        return response()->json([
            "message" => 'Hubo un error con el registro',
            'successful' => false
        ]);
    }
});

//Actualizar atributo "enabled" de el usuario indicado
Route::put('users/{user_id}', function (Request $request, $user_id) {
    $user = User::find($user_id);
    $user->enabled = $request->enabled;
    $user->save();
    return response()->json([
        "message" => "Modificado exitosamente",
        "successful" => true
    ]);
});



//----------------------------------------------------------------------------------

Route::post('subjects/', function (Request $request) {
    $subj = null;
    $name_subject = remove_accents($request->name_subject);
    $name_subject = strtoupper($name_subject);
    $subj = Subject::where('name_subject', $name_subject)->first();
    if (!isset($subj)) {
        $newSubject = new Subject();
        $newSubject->name_subject = $name_subject;
        $newSubject->save();
        return response()->json([
            "message" => "Nueva materia registrada con exito"
        ]);
    } else {
        return response()->json([
            "message" => "Esta materia ya esta registrada"
        ]);
    }
});

Route::delete('subjects/{subject_id}', function ($subject_id) {
    $subj = Subject::find($subject_id);
    if (isset($subj)) {
        $subj->delete();
        return response()->json([
            "message" => "materia eliminada satisfactoriamente"
        ]);
    } else {
        return response()->json([
            "message" => "no existe la materia"
        ]);
    }
});

Route::get('subject_user', function () {
    $groups = SubjectUser::all();
    return $groups->map(function ($elem) {
        $user_id = $elem->user_id;
        $subject_id = $elem->subject_id;
        $teacher = User::find($user_id)->name;
        $subject = Subject::find($subject_id)->name_subject;
        return array(
            "id" => $elem->id,
            "subject" => $subject,
            "teacher" => $teacher,
            "number_group" => $elem->group
        );
    });
    return SubjectUser::all();
});

Route::post('subject_user', function (Request $request) {
    $su = new SubjectUser();
    $user_id = User::where('name', $request->teacher)->first()->id;
    $subject_id = Subject::where('name_subject', $request->subject)->first()->id;
    $su->user_id = User::where('name', $request->teacher)->first()->id;
    $su->subject_id = Subject::where('name_subject', $request->subject)->first()->id;
    if (SubjectUser::where('subject_id', $subject_id)->where('group', $request->number_group)->exists()) {
        return response()->json([
            "message" => "Este grupo ya esta registrado",
            "successful" => false
        ]);
    }
    $su->group = $request->number_group;
    $su->save();
    return response()->json([
        "message" => "El grupo se registro exitosamente",
        "successful" => true
    ]);
});

Route::delete('subject_user/{subject_user_id}', function ($subject_user_id) {
    $subj = SubjectUser::find($subject_user_id);
    $message = "";
    $success = false;
    if (isset($subj)) {
        $success = true;
        $message = "El grupo se elimino exitosamente";
        $subj->delete();
    } else {
        $message = "No existe el grupo";
    }
    return response()->json([
        "message" => $message,
        "successful" => $success
    ]);
});

Route::get('classrooms/debug/{userbooking_id}', function ($userbooking_id) {
    $reservation = UserBooking::find($userbooking_id);
    $classrooms = array_values(Classroom::all(['id'])->toArray());
    $classrooms_id = [];
    foreach ($classrooms as $classroom) {
        array_push($classrooms_id, $classroom["id"] . "");
    }
    $day = $reservation->reservation_date;
    $x = $reservation->horario_ini;
    $y = $reservation->horario_end;
    $classrooms_used = [];
    //             en un futuro cambiara a      'confirmed'
    $reservations = UserBooking::where(function ($q) {
        return $q->where('state', 'assigned')->orWhere('state', 'confirmed');
    })->where('reservation_date', $day)->get();
    // $reservations = UserBooking::where('state', 'assigned')->where('reservation_date', $day)->get();
    foreach ($reservations as $reserv) {
        $horario_ini = $reserv->horario_ini;
        $horario_end = $reserv->horario_end;
        $classrooms_ids = [];
        if (strlen($reserv->assigned_classrooms) > 0) {
            $classrooms_ids = preg_split("/\s+/", $reserv->assigned_classrooms);
        }

        if (seSolapan($x, $y, $horario_ini, $horario_end)) {
            foreach ($classrooms_ids as $classroom_id) {
                array_push($classrooms_used, $classroom_id);
            }
        }
    }
    $classrooms_allowed = [];
    foreach ($classrooms_id as $classroom) {
        if (!in_array($classroom, $classrooms_used)) {
            array_push($classrooms_allowed, $classroom);
        }
    }
    return array(
        $classrooms_id,
        $classrooms_ids,
        $classrooms_used,
        $reservations,
        $classrooms_allowed
    );
    return array_map(function ($elem) {
        $class = Classroom::find($elem);
        return array(
            "id" => $class->id,
            "name_classroom" => $class->name_classroom,
            "edifice" => $class->edifice,
            "floor" => $class->floor,
            "amount" => $class->total_students
        );
    }, $classrooms_allowed);
});
Route::get('classrooms/{userbooking_id}', function ($userbooking_id) {
    $reservation = UserBooking::find($userbooking_id);
    $classrooms = array_values(Classroom::all(['id'])->toArray());
    $classrooms_id = [];
    foreach ($classrooms as $classroom) {
        array_push($classrooms_id, $classroom["id"] . "");
    }

    $day = $reservation->reservation_date;
    $x = $reservation->horario_ini;
    $y = $reservation->horario_end;
    $classrooms_used = [];
    //             en un futuro cambiara a      'confirmed'
    $reservations = UserBooking::where(function ($q) {
        return $q->where('state', 'assigned')->orWhere('state', 'confirmed');
    })->where('reservation_date', $day)->get();
    // $reservations = UserBooking::where('state', 'assigned')->where('reservation_date', $day)->get();
    foreach ($reservations as $reserv) {
        $horario_ini = $reserv->horario_ini;
        $horario_end = $reserv->horario_end;
        $classrooms_ids = [];
        if (strlen($reserv->assigned_classrooms) > 0) {
            $classrooms_ids = preg_split("/\s+/", $reserv->assigned_classrooms);
        }
        if (seSolapan($x, $y, $horario_ini, $horario_end)) {
            foreach ($classrooms_ids as $classroom_id) {
                array_push($classrooms_used, $classroom_id);
            }
        }
    }
    $classrooms_allowed = [];
    foreach ($classrooms_id as $classroom) {
        if (!in_array($classroom, $classrooms_used)) {
            array_push($classrooms_allowed, $classroom);
        }
    }
    return array_map(function ($elem) {
        $class = Classroom::find($elem);
        return array(
            "id" => $class->id,
            "name_classroom" => $class->name_classroom,
            "edifice" => $class->edifice,
            "floor" => $class->floor,
            "amount" => $class->total_students
        );
    }, $classrooms_allowed);
});

Route::get('classroom/{classroom_id}', function ($classroom_id) {
    $classroom = Classroom::find($classroom_id);
    return response()->json([
        "id" => 1,
        "name_classrooms" => $classroom->name_classroom,
        "building" => $classroom->building,
        "floor" => $classroom->floor,
        "amount" => $classroom->total_students
    ]);
    return $classroom;
});

Route::put('reservations', function (Request $request) {
    $id = $request->id;
    $res = UserBooking::find($id);

    if ($res->state == 'assigned') {
        return response()->json([
            "message" => "Esta solicitud ya fue asignada",
            "successful" => false
        ]);
    }
    if ($res->state == 'rejected') {
        return response()->json([
            "message" => "Esta solicitud ya fue rechazada",
            "successful" => false
        ]);
    }
    $res->state = $request->state;
    $res->rejection_reason = $request->rejection_reason;

    // $assigned_classrooms_str = implode(" ",array_column($request->assigned_classrooms,"id"));
    $assigned_classrooms_str = "";
    if (count($request->assigned_classrooms) > 0) {
        $assigned_classrooms_str = implode(" ", $request->assigned_classrooms);
    }
    $res->assigned_classrooms = $assigned_classrooms_str;
    date_default_timezone_set("America/La_Paz");
    $res->notification_date = date('Y-m-d H:i:s');

    // if ($res->state == 'assigned') {

    //     Mail::to('madavaing@gmail.com')->send(new NotificationMail("Prueba de envio", $nombre, 'madavaing@gmail.com', '12345'));
    // } else if ($res->state == 'rejected') {
    //     Mail::to('madavaing@gmail.com')->send(new NotificationMail("Prueba de envio", $nombre, 'madavaing@gmail.com', '12345'));
    // }
    $res->save();
    return response()->json([
        "message" => "...",
        "successful" => true
    ]);
});

Route::get('reservations/{state}', function ($state) {
    $user_bookings = UserBooking::where('state', $state)->get();
    if ($state == 'assigned') {
        $user_bookings = UserBooking::where(function ($q) {
            return $q->where('state', 'assigned')->orWhere('state', 'confirmed');
        })->get();
    }
    return $user_bookings->map(function ($elem) {
        $user = User::find($elem->user_id)->name;
        $subject = Subject::find($elem->subject_id)->name_subject;
        $assigned_classrooms = [];
        $assigned_classrooms_str  = explode(" ", $elem->assigned_classrooms);
        if (strlen($elem->assigned_classrooms)) {
            for ($i = 0; $i < count($assigned_classrooms_str); $i++) {
                $classroom_id = $assigned_classrooms_str[$i];
                $classroom = Classroom::find($classroom_id);
                $classroom_name = $classroom->name_classroom;
                $edifice = $classroom->edifice;
                $floor = $classroom->floor;
                $amount = $classroom->total_students;
                $classroom_arr = [
                    "id" => $classroom_id,
                    "name_classroom" => $classroom_name,
                    "edifice" => $edifice,
                    "floor" => $floor,
                    "amount" => $amount
                ];
                $assigned_classrooms[$i] = $classroom_arr;
            }
        }
        return array(
            "id" => $elem->id,
            "user_id" => $elem->user_id,
            "user" => $user,
            "subject_id" => $elem->subject_id,
            "subject" => $subject,
            "classroom_id" => $elem->classroom_id,
            "register_date" => $elem->register_date,
            "reservation_date" => $elem->reservation_date,
            "total_students" => $elem->total_students,
            "request_reason" => $elem->request_reason,
            "horario_ini" => $elem->horario_ini,
            "horario_end" => $elem->horario_end,
            "state" => $elem->state,
            "group_list" => $elem->group_list,
            "other_groups" => $elem->other_groups,
            "rejection_reason" => $elem->rejection_reason,
            "assigned_classrooms" => $assigned_classrooms
        );
    });
});

Route::get('roles/users/{role}', function ($role) {
    $role = Role::where('name', $role)->first();
    if (!isset($role)) {
        return response()->json([
            "message" => "El rol dado no existe"
        ]);
    }
    $role_id = $role->id;
    $users = User::where('role_id', $role_id)->get();
    return $users->map(function ($elem) use ($role) {
        return array(
            "id" => $elem->id,
            "name" => $elem->name,
            "rol" => $role->name
        );
    });
});

// ---------------------------------------------------------------------------------------------
Route::get('reservations/assigned/{user_id}', function ($user_id) {
    $reservations = UserBooking::where('user_id', $user_id)->where(function ($v) {
        $v->where('state', 'assigned')->orWhere('state', 'confirmed');
    })->get();
    return $reservations->map(function ($elem) {
        $user = User::find($elem->user_id)->name;
        $subject = Subject::find($elem->subject_id)->name_subject;
        $assigned_classrooms = [];
        $assigned_classrooms_str  = explode(" ", $elem->assigned_classrooms);
        if (strlen($elem->assigned_classrooms)) {
            for ($i = 0; $i < count($assigned_classrooms_str); $i++) {
                $classroom_id = $assigned_classrooms_str[$i];
                $classroom = Classroom::find($classroom_id);
                $classroom_name = $classroom->name_classroom;
                $edifice = $classroom->edifice;
                $floor = $classroom->floor;
                $amount = $classroom->total_students;
                $classroom_arr = [
                    "id" => $classroom_id,
                    "name_classroom" => $classroom_name,
                    "edifice" => $edifice,
                    "floor" => $floor,
                    "amount" => $amount
                ];
                $assigned_classrooms[$i] = $classroom_arr;
            }
        }
        return array(
            "id" => $elem->id,
            "user_id" => $elem->user_id,
            "user" => $user,
            "subject_id" => $elem->subject_id,
            "subject" => $subject,
            "classroom_id" => $elem->classroom_id,
            "register_date" => $elem->register_date,
            "reservation_date" => $elem->reservation_date,
            "total_students" => $elem->total_students,
            "request_reason" => $elem->request_reason,
            "horario_ini" => $elem->horario_ini,
            "horario_end" => $elem->horario_end,
            "state" => $elem->state,
            "group_list" => $elem->group_list,
            "other_groups" => $elem->other_groups,
            "rejection_reason" => $elem->rejection_reason,
            "assigned_classrooms" => $assigned_classrooms
        );
    });
});

Route::get('reservations/rejected/{user_id}', function ($user_id) {
    $reservations = UserBooking::where('user_id', $user_id)->where('state', 'rejected')->get();
    return $reservations->map(function ($elem) {
        $user = User::find($elem->user_id)->name;
        $subject = Subject::find($elem->subject_id)->name_subject;
        $assigned_classrooms = [];
        $assigned_classrooms_str  = explode(" ", $elem->assigned_classrooms);
        if (strlen($elem->assigned_classrooms)) {
            for ($i = 0; $i < count($assigned_classrooms_str); $i++) {
                $classroom_id = $assigned_classrooms_str[$i];
                $classroom = Classroom::find($classroom_id);
                $classroom_name = $classroom->name_classroom;
                $edifice = $classroom->edifice;
                $floor = $classroom->floor;
                $amount = $classroom->total_students;
                $classroom_arr = [
                    "id" => $classroom_id,
                    "name_classroom" => $classroom_name,
                    "edifice" => $edifice,
                    "floor" => $floor,
                    "amount" => $amount
                ];
                $assigned_classrooms[$i] = $classroom_arr;
            }
        }
        return array(
            "id" => $elem->id,
            "user_id" => $elem->user_id,
            "user" => $user,
            "subject_id" => $elem->subject_id,
            "subject" => $subject,
            "classroom_id" => $elem->classroom_id,
            "register_date" => $elem->register_date,
            "reservation_date" => $elem->reservation_date,
            "total_students" => $elem->total_students,
            "request_reason" => $elem->request_reason,
            "horario_ini" => $elem->horario_ini,
            "horario_end" => $elem->horario_end,
            "state" => $elem->state,
            "group_list" => $elem->group_list,
            "other_groups" => $elem->other_groups,
            "rejection_reason" => $elem->rejection_reason,
            "assigned_classrooms" => $assigned_classrooms
        );
    });
});

Route::get('notifications/{user_id}', function ($user_id) {
    $reservations = UserBooking::where('user_id', $user_id)->where(function ($q) {
        $q->where('state', 'assigned')->orWhere('state', 'rejected')->orWhere('state', 'confirmed');
    })->get();
    return $reservations->map(function ($elem) {
        $user = User::find($elem->user_id)->name;
        $subject = Subject::find($elem->subject_id)->name_subject;
        $assigned_classrooms = [];
        $assigned_classrooms_str  = explode(" ", $elem->assigned_classrooms);
        $classrooms = "Se asigno las aulas: ";
        if (strlen($elem->assigned_classrooms)) {
            for ($i = 0; $i < count($assigned_classrooms_str); $i++) {
                $classroom_id = $assigned_classrooms_str[$i];
                $classroom = Classroom::find($classroom_id);
                $classroom_name = $classroom->name_classroom;
                $classrooms .= " " . $classroom_name;
            }
        }
        return array(
            "id" => $elem->id,
            "emisor_id" => $elem->emisor_id,
            "user_id" => $elem->user_id,
            "reservation_request_id" => $elem->id,
            "state" => $elem->state,
            "reservation_date" => $elem->reservation_date,
            "notification_date" => $elem->notification_date,
            "detail" => $elem->state == "rejected" ? $elem->rejection_reason : $classrooms,
            "subject" => $subject
        );
    });
})->where('user_id', '[0-9]+');

Route::get('notifications/all/', function () {
    $reservations = UserBooking::where(function ($q) {
        $q->where('state', 'assigned')->orWhere('state', 'rejected')->orWhere('state', 'confirmed');
    })->get();
    return $reservations->map(function ($elem) {
        $user = User::find($elem->user_id)->name;
        $subject = Subject::find($elem->subject_id)->name_subject;
        $assigned_classrooms = [];
        $assigned_classrooms_str  = explode(" ", $elem->assigned_classrooms);
        $classrooms = "Se asigno las aulas: ";
        if (strlen($elem->assigned_classrooms) > 0) {
            for ($i = 0; $i < count($assigned_classrooms_str); $i++) {
                $classroom_id = $assigned_classrooms_str[$i];
                $classroom = Classroom::find($classroom_id);
                $classroom_name = $classroom->name_classroom;
                $classrooms .= " " . $classroom_name;
            }
        }
        return array(
            "id" => $elem->id,
            "emisor_id" => $elem->emisor_id,
            "user_id" => $elem->user_id,
            "userName" => $user,
            "reservation_request_id" => $elem->id,
            "state" => $elem->state,
            "reservation_date" => $elem->reservation_date,
            "subject" => $subject,
            "notification_date" => $elem->notification_date,
            "detail" => $elem->state == "rejected" ? $elem->rejection_reason : $classrooms
        );
    });
});

Route::put('reservations/confirm/{userbooking_id}/{state}', function ($userbooking_id, $state) {
    $reservation = UserBooking::find($userbooking_id);
    $reservation->state = $state;
    $reservation->save();
    return response()->json([
        "message" => "Asignacion de aula " . ($reservation->state == "confirmed" ? "confirmada" : "rechazada")
    ]);
});

Route::get('reservations/timed-out', function () {
    $reservs = UserBooking::all()->toArray();
    date_default_timezone_set("America/La_Paz");
    $dateToday = new DateTime(date('Y-m-d'));

    return array_filter($reservs, function ($elem) use ($dateToday) {
        $reservation_date = $elem->reservation_date;
        $dateReservation = new DateTime($reservation_date);
        return $dateToday->getTimestamp() > $dateReservation->getTimestamp();
    });
});

Route::get('prueba', function () {
    return response()->json([
        "message" => "prueba"
    ], 501);
});
// ---------------------------------------------------------------------------------------------
Route::get('test/users', function () {
    return User::all();
});
Route::get('test/subjects', function () {
    return Subject::all();
});
Route::get('test/classrooms', function () {
    return Classroom::all();
});
Route::get('test/subject_user', function () {
    return SubjectUser::all();
});
Route::get('test/user_booking', function () {
    return UserBooking::all();
});
Route::get('test/roles', function () {
    return Role::all();
});

Route::get('email/notificar', function () {
    $nombre = "mauricio";
    Mail::to('madavaing@gmail.com')->send(new NotificationMail("Prueba de envio", $nombre, 'madavaing@gmail.com', '12345'));
    return response()->json([
        "message" => "notificacion enviada"
    ]);
    // return view('emails.notificacion');
});
