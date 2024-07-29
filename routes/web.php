<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/about-us',function(){
//     if(true){
//         return redirect()->route('article');
//     }
//     return '<h1>Hello world guys</h1>';
// });

Route::get('/about-us',[HomeController::class,'aboutUs']);


// admin related   (add prefix)

// Route::get('/admin/user/{id}',function($id){
//     return 'user id is <b>'.$id.'</b>';
// });

// Route::get('/admin/settings',function(){
//     return 'Settings';
// });  

Route::group(['prefix' => 'admin123'],function(){
    Route::get('/user/{id}',function($id){
        return 'user id is <b>'.$id.'</b>';
    });
    
    Route::get('/settings',function(){
        return 'Settings';
    });
});

Route::get('/bhaijaan/{id}',function($id){
    return 'bhaijaan with id '.$id;
});

Route::get('/candidate/{resume_id}',function($resume_id){
    return '<h1>candidate with resume id '.$resume_id.'</h1>';
});

Route::get('/article/technology/elon-musk-buys-twitter',function(){
    return 'buys 2023';
})->name('article');

Route::get('/sachin',function(){
    return 'sachin in mumbai indians';
})->name('mumbai');


Route::get('/tendulkar',function(){
    return redirect()->route('mumbai');
});


// Employee Routes

Route::get('/employees',[EmployeeController::class,'index'])->name('employee.index');
Route::get('/employees/create',[EmployeeController::class,'create'])->name('employee.create');
Route::post('/employees/store',[EmployeeController::class,'store'])->name('employee.store');
// Route::get('/employees/{id}',[EmployeeController::class,'show'])->name('employee.show');
Route::get('/employees/{employee}',[EmployeeController::class,'show'])->name('employee.show');
// Route::get('/employees/{id}/edit',[EmployeeController::class,'edit'])->name('employee.edit');
Route::get('/employees/{employee}/edit',[EmployeeController::class,'edit'])->name('employee.edit');
// Route::put('/employees/{id}',[EmployeeController::class,'update'])->name('employee.update');
Route::put('/employees/{employee}',[EmployeeController::class,'update'])->name('employee.update');
Route::delete('/employees/{employee}',[EmployeeController::class,'destroy'])->name('employee.destroy');
