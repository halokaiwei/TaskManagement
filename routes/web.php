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
})->middleware('can:isAdmin');
Route::post('/createTask',[TaskController::class,'createTask']);
// Route::middleware(['admin'])->group(function () {
//     Route::view('/createTaskPage');
// });

Route::get('/adminApprovalPage',[UserController::class,'adminApprovalPage']);
//middleware admin
Route::get('/adminApprovedConfirmationPage/{id}',[UserController::class,'adminApprovedConfirmationPage']);
Route::get('/adminRejectedConfirmationPage/{id}',[UserController::class,'adminRejectedConfirmationPage']);
Route::get('/adminApproved/{id}',[UserController::class,'adminApproved']);
Route::get('/adminRejected/{id}',[UserController::class,'adminRejected']);

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

Route::get('/submitProgressPage/{id}',[TaskController::class,'submitProgressPage']);
Route::post('/submitTaskProgress/{id}',[TaskController::class,'submitTaskProgress']);

Route::get('/dropTaskPage/{id}',[TaskController::class,'dropTaskPage']);
Route::get('/dropTask/{id}',[TaskController::class,'dropTask']);
Route::get('/dropTaskConfirmationPage',function() {
    return view('dropTaskConfirmationPage');
});
Route::get('/dropApprovedConfirmationPage/{id}',[TaskController::class,'dropApprovedConfirmationPage']);
Route::get('/dropRejectedConfirmationPage/{id}',[TaskController::class,'dropRejectedConfirmationPage']);
Route::get('/dropApprovalPage',[TaskController::class,'dropApprovalPage'])->middleware('can:isAdmin');
Route::get('/dropApproved/{id}',[TaskController::class,'dropApproved']);
Route::get('/dropRejected/{id}',[TaskController::class,'dropRejected']);