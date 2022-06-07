<?php

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
            "message" => "no hay grupos registrados"
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
        $reservation->subject_id = (Subject::where('name_subject', $request->subject)->first()->id);
        $reservation->horario_ini = $request->horario_ini;
        $reservation->horario_end = $request->horario_end;
        $reservation->request_reason = $request->request_reason;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->classroom_id = 1;
        $reservation->state = $request->state;
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
        $reservation->group_list = $group_list;
        $reservation->total_students = $request->total_students;
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
            "register_date" => $elem->register_date
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
            "horario_ini" => $userbooking->horario_ini,
            "horario_end" => $userbooking->horario_end,
            "state" => $userbooking->state,
            "group_list" => $group_list,
            "other_groups" => $other_group_list

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
        $other_group_list_str = explode(" ", $elem->other_groups);
        $other_group_list = [];
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
            "register_date" => $elem->register_date
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
        $user->name = $request->name;
        $user->enabled = true;
        $user->password = $request->password;
        $user->email = $request->email;
        $role_id = Role::where('name', $role)->first()->id;
        $user->role_id = $role_id;
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
    $subj = Subject::where('name_subject', $request->name_subject)->first();
    if (!isset($subj)) {
        $newSubject = new Subject();
        $newSubject->name_subject = $request->name_subject;
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
    $su->user_id = User::where('name', $request->teacher)->first()->id;
    $su->subject_id = Subject::where('name_subject', $request->subject)->first()->id;
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

Route::get('classrooms/{userbooking_id}', function () {
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
    $res->state = $request->state;
    $res->rejection_reason = $request->rejection_reason;
    $res->assigned_classrooms = $request->assigned_classrooms;
    $res->save();
    return response()->json([
        "message" => "...",
        "successful" => true
    ]);
});

Route::get('reservations/{state}', function ($state) {
    $user_bookings = UserBooking::where('state', $state)->get();
    return $user_bookings->map(function ($elem) {
        $user = User::find($elem->user_id)->name;
        $subject = Subject::find($elem->subject_id)->name_subject;
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
            "assigned_classrooms" => $elem->assigned_classrooms
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
