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
        return $val->only(['id','group', 'user_id', 'name', 'subject']);
    });
});




Route::get('groupsExc/{subject_id}/{user_id}', function ($subject_id, $user_id) {
    $groups = SubjectUser::where('subject_id', $subject_id)->where('user_id', '!=', $user_id)->get();
    if(count($groups) == 0){
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


    return $groups->map(function ($val) use ( $user_id, $user_name, $subject_name) {
        $val->user_id = $user_id;
        $val->name = $user_name;
        $val->subject = $subject_name;
        return $val->only(['id','group','user_id', 'name', 'subject' ]);
    });
});





Route::post('reservation-request', function (Request $request) {
    $reservation = new UserBooking();
    $reservation->user_id =      (User::where('name', $request->name)->first()->id);
    $reservation->subject_id = (Subject::where('name_subject', $request->subject)->first()->id);

    if (isset($reservation->horario_ini)) {
        $reservation->horario_ini = $request->horario_ini;
    }

    $reservation->horario_end = $request->horario_end;
    $reservation->request_reason = $request->request_reason;

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
    $reservation->date = date('Y-m-d H:i:s');
    $reservation->save();
    return response()->json([
        "id" => $reservation->id,
        "name" => $request->name,
        "subject" => $request->subject,
        "date creation" => date('Y-m-d H:i:s'),
        "horario_ini" => $reservation->horario_ini,
        "horario_end" => $reservation->horario_end,
        "state" => $reservation->state,
        "request_reason" => $reservation->request_reason,
        "group_list" => $reservation->group_list,
        "other_group_list" => $reservation->other_groups
    ]);
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
            "id" => $elem->id, "name" => $user_name, "subject" => $subject_name,
            "classroom" => $classroom_name, "horario_ini" => $elem->horario_ini,
            "horario_end" => $elem->horario_fin, "state" => $elem->state, "group_list" => $elem->group_list, "other_group_list" => $elem->other_groups,
            "date_time" => $elem->date
        );
    });
});





Route::delete('draft/{userbooking_id}', function ($userbooking_id) {
    $ub = UserBooking::find($userbooking_id);
    if (isset($ub)) {
        $reservation = UserBooking::find($userbooking_id)->delete();
        return response()->json([
            "message" => "eliminado con exito"
        ]);
    }
    else{
        return response()->json([
            "message" => "no existe esta reserva"
        ]);
    }
});



Route::post('/login', function (Request $request) {
    $username = $request->email;
    $password = $request->password;
    $users = User::where('email', $username)->where('password', $password)->get();
    $user = $users[0];
    return response()->json([
        "id" => $user->id,
        "name" => $user->name,
        "email" => $user->email,
        "role" => $user->role->name,
        "token" => "no hay token"
    ]);
});




Route::get('test/users',function(){
    return User::all();
});
Route::get('test/subjects',function(){
    return Subject::all();
});
Route::get('test/classrooms',function(){
    return Classroom::all();
});
Route::get('test/subject_user',function(){
    return SubjectUser::all();
});
Route::get('test/user_booking',function(){
    return UserBooking::all();
});
Route::get('test/roles',function(){
    return Role::all();
});