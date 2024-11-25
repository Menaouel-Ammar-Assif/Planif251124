<?php
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\DirecteurController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\UserBlockController;
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
    return view('auth.login');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/d',  [DirecteurController::class, 'DirecteurDashboard']);


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'Users'])->name('admin.users');
    Route::get('/admin/actions', [AdminController::class, 'Actions'])->name('admin.actions');
    Route::post('/admin/add_user_', [AdminController::class, 'Add_user'])->name('admin.add_user');
    Route::delete('/admin/delete_user/{userId}', [AdminController::class, 'Delete_user'])->name('admin.delete_user');
    Route::post('/admin/block_user/{userId}', [AdminController::class, 'Block_user'])->name('admin.block_user');
    Route::post('/admin/unblock_user/{userId}', [AdminController::class, 'Unblock_user'])->name('admin.unblock_user');
    Route::post('/admin/reset_user/{userId}', [AdminController::class, 'Reset_user'])->name('admin.reset_user');
    Route::get('/admin/getDirections/{dirId}', [AdminController::class, 'getDirections']);

    Route::post('/admin/add_action_DC', [AdminController::class, 'Add_actionDC'])->name('admin.add_actionDC');
    Route::post('/admin/delete_action_DC', [AdminController::class, 'Delete_actionDC'])->name('admin.delete_actionDC');
    Route::post('/admin/update_action_DC', [AdminController::class, 'Update_actionDC'])->name('admin.update_actionDC');

    Route::post('/admin/add_action_DR', [AdminController::class, 'Add_actionDR'])->name('admin.add_actionDR');
    Route::post('/admin/delete_action_DR', [AdminController::class, 'Delete_actionDR'])->name('admin.delete_actionDR');
    Route::post('/admin/update_action_DR', [AdminController::class, 'Update_actionDR'])->name('admin.update_actionDR');
    Route::get('/admin/actionsCop', [AdminController::class, 'ActionsCop'])->name('admin.actionsCop');
    Route::post('/admin/add_objectif_', [AdminController::class, 'Add_objectif'])->name('admin.add_objectif');
    Route::post('/admin/update_objectif', [AdminController::class, 'Update_objectif'])->name('admin.update_objectif');
    Route::post('/admin/delete_objectif', [AdminController::class, 'Delete_objectif'])->name('admin.delete_objectif');

    Route::post('/admin/add_sous_objectif_', [AdminController::class, 'Add_sous_objectif'])->name('admin.add_sous_objectif');
    Route::post('/admin/update_sous_objectif', [AdminController::class, 'Update_sous_objectif'])->name('admin.update_sous_objectif');
    Route::post('/admin/delete_sous_objectif', [AdminController::class, 'Delete_sous_objectif'])->name('admin.delete_sous_objectif');


    Route::get('/admin/getSousObj/{selectedObjectId}', [AdminController::class, 'getSousObj']);
    Route::get('/admin/getActionsDC/{selectedDirectionId}', [AdminController::class, 'getActionDC']);

    Route::post('/admin/add_action_copDC', [AdminController::class, 'Add_action_copDC'])->name('admin.add_action_copDC');


    //////////////////////////////////////////////////////////////Admin Dashboard///////////////////////////////////////////////////////////////////
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/Model/Indicateur', [AdminController::class, 'downloadPDF'])->name('Model.Indicateur');

    Route::get('admin/directionDc/{directionId}', [AdminController::class, 'ajaxDc']);
    Route::get('admin/directionDr/{directionDrId}', [AdminController::class, 'ajaxDr']);

    Route::get('/admin/downloadDc/{IdSelect}/{Name}', [AdminController::class, 'DownDC'])->name('downloadDcAdmin');
    Route::get('/admin/downloadDr/{IdSelect}/{Name}', [AdminController::class, 'DownDR'])->name('downloadDrAdmin');

    Route::get('/admin/directionCopDr/{directionDrId}', [AdminController::class, 'AjaxCopDr']);

    Route::get('/admin/ActionBtn/{directionId}/{idbtn}', [AdminController::class, 'btnDC']);

    Route::get('/admin/ActionBtnDr/{directionId}/{idbtn}', [AdminController::class, 'btnDR']);
    Route::get('/admin/ActionInfo/{idAct}', [AdminController::class, 'subAction']);

    Route::get('/admin/directionDrAjust/{directionDrId}', [AdminController::class, 'ajaxDrAjust']);



    Route::get('/admin/addValue', [AdminController::class, 'AdminPageAddValue'])->name('admin.pageAddValue');
    Route::post('/admin/calculations', [AdminController::class, 'AdminAddValue'])->name('admin.AddValue');

    Route::get('/addMonthTwo/{month}', [AdminController::class, 'addMonthTwo']);

});
//End group admin



Route::middleware(['auth', 'role:directeur', 'completins:', 'userBlock'])->group(function () {

    Route::get('/ActionBtn/{idbtn}', [DirecteurController::class, 'btnDC']);
    Route::get('/downloadDc/{Name}', [DirecteurController::class, 'Down'])->name('downloadExcel');
    Route::get('/downloadPdf/{Name}', [DirecteurController::class, 'DownPdf'])->name('downloadPdf');

    Route::get('/download-pdf', [DirecteurController::class, 'downloadPDFCop'])->name('directeur.downloadPDFCop');

    Route::get('/download-pdf-ind', [DirecteurController::class, 'downloadPDFInd'])->name('directeur.downloadPDFInd');

    // Route::get('/export-actions', [DirecteurController::class, 'Down'])->name('downloadExcel');
    Route::get('/directeur/dashboard', [DirecteurController::class, 'DirecteurDashboard'])->name('directeur.dashboard');
    Route::post('/directeur/dashboard/add_desc', [DirecteurController::class, 'add_desc'])->name('directeur.dashboard.add_desc');
    Route::post('/directeur/dashboard/add_desc_pre', [DirecteurController::class, 'add_desc_pre'])->name('directeur.dashboard.add_desc_pre');
    Route::post('/directeur/dashboard/add_desc_pre2', [DirecteurController::class, 'add_desc_pre2'])->name('directeur.dashboard.add_desc_pre2');


    Route::post('/directeur/dashboard/update_desc', [DirecteurController::class, 'update_desc'])->name('directeur.dashboard.update_desc');
    Route::post('/directeur/dashboard/update_desc2', [DirecteurController::class, 'update_desc2'])->name('directeur.dashboard.update_desc2');

    Route::get('/directeur/proposition', [DirecteurController::class, 'Proposition'])->name('directeur.proposition');
    Route::post('/directeur/proposition/add_act_pro', [DirecteurController::class, 'add_act_pro'])->name('directeur-proposition.add_act_pro');
    Route::get('/directeur/proposition/getSousObjs/{objId}', [DirecteurController::class, 'getSousObjs']);

    Route::get('/directeur/cop', [DirecteurController::class, 'Cop'])->name('directeur.cop');

    Route::post('/directeur/cop/add_act_cop', [DirecteurController::class, 'add_act_cop'])->name('directeur-cop.add_act_cop');

    Route::get('/directeur/copAdd', [DirecteurController::class, 'CopAddPage'])->name('directeur.copAdd');
    Route::post('/directeur/copAddStore', [DirecteurController::class, 'CopAddStore'])->name('directeur.CopAddStore');

    Route::get('/directeur/analyse', [DirecteurController::class, 'Analyse'])->name('directeur.analyse');
    Route::post('/directeur/CauseStore', [DirecteurController::class, 'CauseStore'])->name('directeur.CauseStore');

    Route::get('/fetch-cause-action', [DirecteurController::class, 'fetchCauseAction'])->name('directeur.fetchCauseAction');






    Route::get('/addMonth/{month}', [DirecteurController::class, 'addMonth']);

    Route::get('/directeur/addValue', [DirecteurController::class, 'DirecteurPageCalculate'])->name('directeur.pageCalculate');
    Route::post('/directeur/calculations', [DirecteurController::class, 'DirecteurCalculate'])->name('directeur.Calculate');

    Route::get('/addMonthTwo/{month}', [DirecteurController::class, 'addMonthTwo']);





    Route::get('/directeur/actionsPrio', [DirecteurController::class, 'DirecteurActionsPrio'])->name('directeur.ActionsPrio');
    Route::get('/directeur/ActionInfo/{idAct}', [DirecteurController::class, 'subAction']);
    Route::get('/directeur/actionsCop', [DirecteurController::class, 'DirecteurActionsCop'])->name('directeur.ActionsCop');

    Route::get('/directeur/cop', [DirecteurController::class, 'DrCop'])->name('directeur.cop');

    Route::post('/directeur/dashboard/add_desc_cop', [DirecteurController::class, 'add_desc_cop'])->name('directeur.dashboard.add_desc_cop');

    Route::post('/directeur/dashboard/add_desc_pre_cop', [DirecteurController::class, 'add_desc_pre_cop'])->name('directeur.dashboard.add_desc_pre_cop');

    Route::post('/directeur/dashboard/add_desc_pre2_cop', [DirecteurController::class, 'add_desc_pre2_cop'])->name('directeur.dashboard.add_desc_pre2_cop');

    Route::get('/descriptions/{actionId}', [DirecteurController::class, 'getDescriptions']);


    Route::post('/directeur/dashboard/update_desc_cop', [DirecteurController::class, 'update_desc_cop'])->name('directeur.dashboard.update_desc_cop');

    Route::get('directeur/subtable/{id_act}', [DirecteurController::class, 'subActionDirecteur']);

    Route::get('/export-copvaleur_D', [DirecteurController::class, 'export'])->name('export.copvaleur_D');
    Route::get('/export-copvaleurS_D', [DirecteurController::class, 'exportS'])->name('export.copvaleurS_D');
    Route::get('/export-copvaleurN_D', [DirecteurController::class, 'exportN'])->name('export.copvaleurN_D');
    Route::get('/export-copvaleurA_D', [DirecteurController::class, 'exportA'])->name('export.copvaleurA_D');

    //Route::get('directeur/ActionBtn/{idbtn}', [DirecteurController::class, 'btnDC']);

});






Route::middleware(['auth', 'role:consult'])->group(function () {
    Route::get('/consult/dashboard', [ConsultController::class, 'ConsultDashboard'])->name('consult.dashboard');
    // Route::get('/direction/regionale', [ConsultController::class, 'DirectionRegionale'])->name('direction.regionale');
    // Route::get('/direction/centrale', [ConsultController::class, 'DirectionCentrale'])->name('direction.centrale');
    Route::get('/consult/liaison', [ConsultController::class, 'Liaison'])->name('consult.liaison');
    Route::get('/consult/charts', [ConsultController::class, 'charts'])->name('consult.charts');
    Route::get('/consult/Adjusted', [ConsultController::class, 'ConsultAdjusted'])->name('consult.Adjusted');
    Route::get('/consult/cop', [ConsultController::class, 'ConsultCop'])->name('consult.cop');

    Route::get('sObj/{id_obj}', [ConsultController::class, 'ajaxObj']);
    Route::get('ind/{id_sous_obj}', [ConsultController::class, 'ajaxSouObj']);
    Route::get('res/{id_ind}', [ConsultController::class, 'ajaxInd']);
    Route::get('subtable/{act}', [ConsultController::class, 'subTable']);
    Route::get('subtableDr/{act}', [ConsultController::class, 'subTableDr']);
    // Route::get('consult/directionDc/{directionId}', [ConsultController::class, 'ajaxDc']);


    Route::get('/consult/Model/Indicateur', [ConsultController::class, 'downloadPDF'])->name('Model.Indic');
    Route::get('/consult/Model/SynthèseT1', [ConsultController::class, 'downloadPDFT1'])->name('Model.SynthT1');
    Route::get('/consult/Model/SynthèseS1', [ConsultController::class, 'downloadPDFS1'])->name('Model.SynthS1');


    Route::get('consult/directionDc/{directionId}', [ConsultController::class, 'ajaxDc']);
    Route::get('consult/directionDr/{directionDrId}', [ConsultController::class, 'ajaxDr']);

    Route::get('/downloadDc/{IdSelect}/{Name}', [ConsultController::class, 'DownDC'])->name('downloadDc');
    Route::get('/downloadDr/{IdSelect}/{Name}', [ConsultController::class, 'DownDR'])->name('downloadDr');

    Route::get('/cons/directionCopDr/{directionDrId}', [ConsultController::class, 'AjaxCopDr']);

    Route::get('/ActionBtn/{directionId}/{idbtn}', [ConsultController::class, 'btnDC']);
    Route::get('/ActionInfo/{idAct}', [ConsultController::class, 'infoDc']);
    Route::get('/ActionDrInfo/{idAct}', [ConsultController::class, 'subActionCopDr']);

    Route::get('/ActionBtnDr/{directionId}/{idbtn}', [ConsultController::class, 'btnDR']);
    Route::get('/ActionInfo/{idAct}', [ConsultController::class, 'subAction']);

    Route::get('/consult/directionDrAjust/{directionDrId}', [ConsultController::class, 'ajaxDrAjust']);

    Route::get('/export-copvaleur', [ConsultController::class, 'export'])->name('export.copvaleur');
    Route::get('/export-copvaleurS', [ConsultController::class, 'exportS'])->name('export.copvaleurS');
    Route::get('/export-copvaleurN', [ConsultController::class, 'exportN'])->name('export.copvaleurN');
    Route::get('/export-copvaleurA', [ConsultController::class, 'exportA'])->name('export.copvaleurA');

    Route::get('/downloadDcPdf/{IdSelect}/{Name}', [ConsultController::class, 'DownDcPdf'])->name('downloadDcPdf');
    Route::get('/downloadDrPdf/{IdSelect}/{Name}', [ConsultController::class, 'DownDrPdf'])->name('downloadDrPdf');

    Route::get('/downInfoCopPdf/{Name}', [ConsultController::class, 'downInfoCopPdf'])->name('downInfoCopPdf');

});
//End group consult


Route::get('/register', [RegisterController::class, 'completeProfileForm'])->name('complete-profile-form')->middleware('auth');
Route::post('/register', [RegisterController::class, 'completeProfile'])->name('complete-profile')->middleware('auth');
Route::get('/userBlock', [UserBlockController::class, 'userBlocked'])->name('userBlock')->middleware('auth');
Route::post('/userblocked/send_message', [UserBlockController::class, 'send_message'])->name('userblocked.send_message')->middleware('auth');
