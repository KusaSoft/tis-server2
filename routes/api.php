<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\SubjectUser;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\UserBooking;
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
    $group_id = $groups[0]->id;
    $group = $groups[0]->group;
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
        $res->total_students = $res->total_students;
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
            "total_students" => $request->total_students,
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
            "group_list" => $userbooking->group_list,
            "other_groups" => $userbooking->other_groups

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
    $reservations = UserBooking::where('state','sent')->get();
    $reservation = $reservations[0];

    date_default_timezone_set("America/La_Paz");
    $date_now = date('Y-m-d');
    // return date_diff($date_now,$reservation->reservation_date);
    return date('Y-m-d');
    return $reservations;
    
});

//Devuelve todas las solicitudes enviadas(sent)
Route::get('reservations', function () {
    $res_reqs = UserBooking::where('state','sent')->get();
    return $res_reqs->map(function ($elem){
        $subject_name = Subject::find($elem->subject_id)->name_subject;
        $user_name = User::find($elem->user_id)->name;
        $classroom_name = Classroom::find(1)->name_classroom;
        return array(
            "id" => $elem->id,
            "name" => $user_name,
            "subject" => $subject_name,
            "subject_id" => $elem->subject_id,
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

//Devuelve datos de todos los usuarios del sistema
Route::get('users', function () {
    //codigo
});

//Recibe datos de un nuevo usuario y los guarda
Route::post('users', function (Request $request) {
    //codigo
});

//Actualizar atributo "enabled" de el usuario indicado
Route::put('users/enable/{user_id}', function (Request $request, $user_id) {
    //codigo
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
