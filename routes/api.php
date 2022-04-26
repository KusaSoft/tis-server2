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
    return Subject::all('id','name_subject');
});

Route::get('subjects/{user_id}',function($user_id){
    return User::find($user_id)->groups->map(function($val){
        $name = $val->name_subject;
        $group = $val->pivot->group;
        return array("id"=>$val->id,"subject_name"=>$name, "group"=>$group);
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
    $reservation->horario_ini = $request->horario_ini;
    $reservation->horario_fin = $request->horario_fin;
    $reservation->classroom_id = 1;
    $reservation->state = $request->state;
    $reservation->description  = $request->teacher_list;
    $reservation->group = $request->group;
    $reservation->save();
    return response()->json([
        "id" => UserBooking::all()->first()->id,
        "nombre" => $request->name,
        "materia" => $request->subject,
        "date_time" => date('Y-m-d H:i:s'),
        "reservation_time" => $reservation->horario_ini
    ]);
});

Route::get('reservation/{user_id}/{state}', function($user_id, $state){
    $user_name = User::find($user_id)->name;
    $reservations = UserBooking::where('user_id',$user_id)
                                ->where('state',$state)
                                ->get();
    return $reservations->map(function($elem) use($user_name){
        $subject_name = Subject::find($elem->subject_id)->name_subject;
        $classroom_name = Classroom::find(1)->name_classroom;
        return array("id"=>$elem->id,"name"=>$user_name,"subject"=>$subject_name,
                 "classroom"=>$classroom_name,"horario_ini"=>$elem->horario_ini,
                 "horario_fin"=>$elem->horario_fin,"state"=>$elem->state,"group"=>$elem->group
                 );
    });
});

Route::delete('draft/{userbooking_id}', function($userbooking_id){
    $reservation = UserBooking::find($userbooking_id)->delete();
    return response()->json([
        "message" => "eliminado con exito"
    ]);
});


