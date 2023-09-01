<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\AmenityController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Group route admin middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');


    // Property Type

Route::controller(PropertyTypeController::class)->group(function(){
    Route::get('all/property', 'AllProperty')->name('all.property')->middleware('permission:all.property');
    Route::get('add/property', 'AddProperty')->name('add.property')->middleware('permission:add.property');
    Route::post('store/property', 'StoreProperty')->name('store.property');
    Route::get('edit/property/{id}', 'EditProperty')->name('edit.property')->middleware('permission:edit.property');
    Route::post('update/property/{id}', 'UpdateProperty')->name('update.property');
    Route::get('delete/property/{id}', 'DeleteProperty')->name('delete.property')->middleware('permission:delete.property');

});
    // End Property Type

    // amenitie Type

Route::controller(AmenityController::class)->group(function(){
    Route::get('all/amenity', 'AllAmenity')->name('all.amenity')->middleware('permission:all.amenity');
    Route::get('add/amenity', 'AddAmenity')->name('add.amenity')->middleware('permission:add.amenity');
    Route::post('store/amenity', 'StoreAmenity')->name('store.amenity');
    Route::get('edit/amenity/{id}', 'EditAmenity')->name('edit.amenity')->middleware('permission:edit.amenity');
    Route::post('update/amenity/{id}', 'UpdateAmenity')->name('update.amenity');
    Route::get('delete/amenity/{id}', 'DeleteAmenity')->name('delete.amenity')->middleware('permission:delete.amenity');

});
    // End amenitie Type

    // Permission Type

Route::controller(RoleController::class)->group(function(){
    Route::get('all/permission', 'AllPermission')->name('all.permission');
    Route::get('add/permission', 'AddPermission')->name('add.permission');
    Route::post('store/permission', 'StorePermission')->name('store.permission');
    Route::get('edit/permission/{id}', 'EditPermission')->name('edit.permission');
    Route::post('update/permission/{id}', 'UpdatePermission')->name('update.permission');
    Route::get('delete/permission/{id}', 'DeletePermission')->name('delete.permission');



    Route::get('import/permission', 'ImportPermission')->name('import.permission');
    Route::get('/export', 'Export')->name('export');
    Route::post('import', 'Import')->name('import');


// role
    Route::get('all/role', 'AllRole')->name('all.role');
    Route::get('add/role', 'AddRole')->name('add.role');
    Route::post('store/role', 'StoreRole')->name('store.role');
    Route::get('edit/role/{id}', 'EditRole')->name('edit.role');
    Route::post('update/role/{id}', 'UpdateRole')->name('update.role');
    Route::get('delete/role/{id}', 'DeleteRole')->name('delete.role');



// role & permission
    Route::get('add/role/permission', 'AddRolePermission')->name('add.role.permission');
    Route::post('role/permission/store', 'RolePermissionStore')->name('role.permission.store');
    Route::get('all/role/permission', 'AllRolePermission')->name('all.role.permission');
    Route::get('edit/role/permission/{id}', 'EditRolePermission')->name('edit.role.permission');
    Route::post('update/role/permission/{id}', 'UpdateRolePermission')->name('update.role.permission');
    Route::get('delete/role/permission/{id}', 'DeleteRolePermission')->name('delete.role.permission');


});
    // End Permission Type


 // Add admin

Route::controller(AdminController::class)->group(function(){
    Route::get('all/admin', 'AllAdmin')->name('all.admin');
    Route::get('add/admin', 'AddAdmin')->name('add.admin');
    Route::post('store/admin', 'StoreAdmin')->name('store.admin');
    Route::get('edit/admin/{id}', 'EditAdmin')->name('edit.admin');
    Route::post('update/admin/{id}', 'UpdateAdmin')->name('update.admin');
    Route::get('delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
});



});
// End Group route admin middleware

// admin login
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// end admin login



// Group route agent middleware

Route::middleware(['auth', 'roles:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
});

// End Group route admin middleware
