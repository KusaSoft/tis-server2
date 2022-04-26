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

Route::middleware('auth:sanctum')->get('/user', function () {
    return $request->user();
});


Route::get('subjects',function(){
    return Subject::all('name_subject');
});

Route::get('subjects/{user_id}',function($user_id){
    return User::find($user_id)->groups->map(function($val){
        $name = $val->name_subject;
        $group = $val->pivot->group;
        return array("subject_name"=>$name, "group"=>$group);
    });
}); 

Route::get('groups/{subject_id}/{user_id}',function($subject_id,$user_id){
    $groups = SubjectUser::where('subject_id',$subject_id)->where('user_id',$user_id)->get();
    return $groups->map(function($val){
        return $val->only(['group']);
    });
});

Route::get('groupsExc/{subject_id}/{user_id}',function($subject_id,$user_id){
    $groups = SubjectUser::where('subject_id',$subject_id)->where('user_id','!=',$user_id)->get();
    return $groups->map(function($val){
        return $val->only(['group']);
    });
});




Route::post('reservation-request',function(Request $request){
    $reservation = new UserBooking();
    $reservation->request_reason = $request->request_reason;
    $reservation->user_id = (User::where('name',$request->name)->first()->id); 
    $reservation->subject_id = (Subject::where('name_subject',$request->subject)->first()->id);
    $reservation->classroom_id = 1;
    $reservation->state = $request->state;
    $reservation->description  = $request->teacher_list;
    $reservation->group = $request->group;

    // return date('Y-m-d H:i:s');
    return response()->json([
        "nombre" => $request->name,
        "materia" => $request->subject,
        "grupos" => ":(",
        "date_time" => date('Y-m-d H:i:s'),
        "reservation_time" => $request->horario_ini
    ]);
});

Route::post('reservation-request-incom',function(Request $request){
    $reservation = new UserBooking();
    $reservation->request_reason = $request->request_reason;
    $reservation->user_id = (User::where('name',$request->name)->first()->id); 
    $reservation->subject_id = (Subject::where('name_subject',$request->subject)->first()->id);
    $reservation->classroom_id = 1;
    $reservation->state = $request->state;
    $reservation->description  = $request->teacher_list;
    $reservation->group = $request->group;

    // return date('Y-m-d H:i:s');
    return response()->json([
        "nombre" => $request->name,
        "materia" => $request->subject,
        "grupos" => ":(",
        "date_time" => date('Y-m-d H:i:s'),
        "reservation_time" => $request->horario_ini
    ]);
});


Route::get('reservation/{user_id}/{state}', function($user_id, $state){
    $reservation = UserBooking::where('user_id',$user_id)
                                ->where('state',$state)
                                ->get();
    return $reservation;
});
Route::delete('draft/{user_id}/{userbooking_id}', function($user_id, $userbooking_id){
    $reservation = UserBooking::where('user_id',$user_id)
                                ->where('userbooking_id',$userbooking_id)
                                ->delete();
    return "eliminado con exito";
});



Route::post('create-user',function(Request $request){
    $newUser = new User();

    $newUser->save();
});
Route::post('create-role', function(Request $request){
    $newRole = new Role();
    $newRole->
    $newRole->save();
});