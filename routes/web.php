<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/userLoginPage',function() {
    return view('userLoginPage');
}); 

Route::post('/userLogin',[UserController::class,'userLogin']);

Route::get('/userRegisterPage',function() {
    return view('userRegisterPage');
});
Route::post('/userRegister',[UserController::class,'userRegister']);

Route::get('registrationsuccessPage',function() {
    return view('registrationsuccessPage');
});


Route::get('/viewTasksPage',[TaskController::class,'viewTasksPage']);

//createTaskPage, adminApprovalPage, deleteTask, modifyTask need admin 

Route::get('/createTaskPage',function() {
    return view('createTaskPage');
});
Route::post('/createTask',[TaskController::class,'createTask']);
// Route::middleware(['admin'])->group(function () {
//     Route::view('/createTaskPage');
// });

Route::get('/adminApprovalPage',[UserController::class,'adminApprovalPage']);
// Route::middleware(['admin'])->group(function () {
//     Route::view('/adminApprovalPage');
// });

Route::get('/modifyTask/{id}',[TaskController::class,'modifyTaskPage']);
Route::post('/updateTask/{id}',[TaskController::class,'updateTask']);
// Route::middleware(['admin'])->group(function () {
//     Route::get('/modifyTask/{id}',[TaskController::class,'modifyTaskPage']);
// });

Route::get('/deleteTask/{id}',[TaskController::class,'deleteTaskPage']);
Route::delete('/deleteTask/{id}',[TaskController::class,'deleteTask']);
// Route::middleware(['admin'])->group(function () {
//     Route::get('/modifyTask/{id}',[TaskController::class,'modifyTaskPage']);
// });

Route::get('/pickUpTaskPage/{id}',[TaskController::class,'pickUpTaskPage']);
Route::post('/pickUpTask/{id}',[TaskController::class,'pickUpTask']);

Route::get('/myProfilePage',[UserController::class,'myProfilePage']);

Route::get('/dropTaskPage/{id}',[TaskController::class,'dropTaskPage']);
Route::delete('/dropTask/{id}',[TaskController::class,'dropTask']);