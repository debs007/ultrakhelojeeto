<?php

use App\Http\Controllers\Activities;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CronManager;
use App\Http\Controllers\SetBet;
use Illuminate\Http\Request;
use App\Models\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin', function () {
    return view('tabler-dev.demo.adminSignin');
});
Route::get('stockist', function () {
    return view('tabler-dev.demo.stockistsignin');
});
Route::get('superstockist', function () {
    return view('tabler-dev.demo.superstockistSignin');
});
Route::get('session', function () {
    return view('tabler-dev.demo.session');
});
Route::get('home', function () {
    return view('tabler-dev.demo.home');
});
Route::get('stockistHome', function () {
    return view('tabler-dev.demo.stockisthome');
});
Route::get('users', function () {
    return view('tabler-dev.demo.users');
});
Route::get('stockistAgents', function () {
    return view('tabler-dev.demo.stockistusers');
});
Route::get('userProf', function () {
    return view('tabler-dev.demo.userProf');
});
Route::get('upcomingEvents', function () {
    return view('tabler-dev.demo.upcoming');
});
Route::get('pastEvents', function () {
    return view('tabler-dev.demo.past');
});
Route::get('gallery', function () {
    return view('tabler-dev.demo.gallery');
});
Route::get('ads', function () {
    return view('tabler-dev.demo.ads');
});
Route::get('requestLion', function () {
    return view('tabler-dev.demo.requestlion');
});
Route::get('message', function () {
    return view('tabler-dev.demo.contacts');
});
Route::get('dbmanage', function () {
    return view('tabler-dev.demo.management');
});

Route::get('bagman', function () {
    return view('tabler-dev.PacmanNew.pacman');
});
Route::get('professions', function () {
    return view('tabler-dev.demo.profession');
});
Route::get('delete', function () {
    return view('tabler-dev.demo.deleteaccount');
});
Route::get('settings', function () {
    return view('tabler-dev.demo.settings');
});
Route::get('transaction', function () {
    return view('tabler-dev.demo.transactionreport');
});
Route::get('report', function () {
    return view('tabler-dev.demo.report');
});
Route::get('turnover', function () {
    return view('tabler-dev.demo.turnover');
});
Route::get('profile',[AdminController::class,"GetUserDetails"]);
Route::get('clearUser',[Activities::class,"ClearUser"]);
Route::get('removeAd',[AdminController::class,"RemoveAd"]);
Route::get('acceptLion',[AdminController::class,"AcceptLion"]);
Route::get('rejectLion',[AdminController::class,"RejectLion"]);
Route::get('revoke',[AdminController::class,"Revoke"]);
Route::get('renew',[AdminController::class,"Renew"]);
Route::post("adminLogin",[AdminController::class,"LoginAdmin"])->name('webconnect.adminLogin');
Route::post("stockistLogin",[AdminController::class,"LoginStockist"])->name('webconnect.stockistlogin');
Route::post("superStockistLogin",[AdminController::class,"LoginSuperStockist"])->name('webconnect.superStockistLogin');
Route::post("createEvent",[AdminController::class,"Create_Event"])->name('webconnect.createEvent');
Route::post("sendNotification",[AdminController::class,"SentNotification"])->name('webconnect.sendNotification');
Route::post("createGallery",[AdminController::class,"UploadDetailsToGallery"])->name('webconnect.createGallery');
Route::post("createUser",[AdminController::class,"createUser"])->name('webconnect.createUser');
Route::post("updateUser",[AdminController::class,"updateUser"])->name('webconnect.updateUser');
Route::post("createAd",[AdminController::class,"CreateAd"])->name('webconnect.createAd');
Route::post("sortAd",[AdminController::class,"UpdateAd"])->name('webconnect.sortAd');
Route::post("addUsersBulk",[AdminController::class,"AddUsersBulk"])->name('webconnect.addUsersBulk');
Route::post("deleteTable",[AdminController::class,"TruncateDetails"]);
Route::post("deleteUser",[AdminController::class,"DeleteAUser"]);
Route::post("deleteEvent",[AdminController::class,"DeleteEvent"]);
Route::post("deleteGallery",[AdminController::class,"DeleteGalllery"]);
Route::get('enableEvent',[AdminController::class,'EnableEvent']);
Route::get('disableEvent',[AdminController::class,'DisableEvent']);
Route::get('enableGallery',[AdminController::class,'EnableGallery']);
Route::get('disableGallery',[AdminController::class,'DisableGallery']);
Route::get('resize',[AdminController::class,'ResizeAllImages']);
Route::get('export',[AdminController::class,'export']);
Route::get('searchUser',[AdminController::class,'SerachUser']);
Route::get('getBetStat',[SetBet::class,'GetCurrentBetstatus']);
Route::get('getBetResult',[SetBet::class,'GetBetResult']);
Route::get('createBet',[SetBet::class,'CreateBet']);
Route::get('getNewSession',[SetBet::class,'GetNewSession']);

Route::post("addMoney",[AdminController::class,"AddMoney"])->name('webconnect.addMoney');
Route::post("addMoneyStockist",[AdminController::class,"AddMoneyStockist"])->name('webconnect.addMoneyStockist');
Route::post("withdrawMoneyStockist",[AdminController::class,"WithdrawMoneyStockist"])->name('webconnect.withdrawMoneyStockist');
Route::post("withdrawMoney",[AdminController::class,"WithdrawMoney"])->name('webconnect.withdrawMoney');

Route::post("block",[AdminController::class,"BlockUser"])->name('webconnect.blockUser');
Route::get("unblock",[AdminController::class,"UnBlockUser"]);
Route::post("resetPassword",[AdminController::class,"ResetPassword"])->name('webconnect.resetPassword');
Route::get("changeMultiplier",[AdminController::class,"ChangeMultiplier"]);
Route::post("editUser",[AdminController::class,"EditUser"])->name('webconnect.editUser');
Route::post("setDisburse",[AdminController::class,"SetDisburse"])->name('webconnect.setDisburse');
Route::post("changeTimer",[AdminController::class,"ChangeTimer"])->name('webconnect.changeTimer');
Route::post("changeSpeed",[AdminController::class,"ChangeSpeed"])->name('webconnect.changeSpeed');
Route::post("changeSpeedSecond",[AdminController::class,"ChangeSpeedSecond"])->name('webconnect.changeSpeedSecond');
Route::post("setWhatsapp",[AdminController::class,"SetWhatsapp"])->name('webconnect.setWhatsapp');
Route::post("setQr",[AdminController::class,"SetQr"])->name('webconnect.setQr');
Route::get('getTransaction',[Activities::class,'TransactionReport']);
Route::get('getMyReports',[SetBet::class,'GetMyBets']);
Route::get('setPreWin',[SetBet::class,'SetPreWin']);
Route::get('setPreWinX',[SetBet::class,'SetPreWinX']);
Route::get('resetData',[SetBet::class,'TakeABackup']);
Route::get('getTurnoverReports',[SetBet::class,'GetTurnoverReport']);
Route::get('checkTemp',[SetBet::class,'CheckTemp']);
Route::get('forceLogout',[SetBet::class,'ForceLogout']);
Route::get('logout',[AdminController::class,"Logout"]);
Route::get('resetCarry',[AdminController::class,"ResetCarry"]);

Route::get('resetpass',function(){
    return view('tabler-dev.demo.changepassword');
});

Route::post('changePassword',function(Request $request){
    $admin = Admin::where('id',1)->first();
    if($admin)
    {
        if($admin->password == $request->old)
        {
            Admin::where('id',1)->update(["password"=>$request->new]);
            return redirect('/resetpass?with=success');
        }

        return redirect('/resetpass?with=not');
    }
    return redirect('/admin');
});
Route::get('generateAutoBet',[CronManager::class,"GenerateAutoBet"]);
Route::get('clearRecord',[CronManager::class,"ClearUpPrevData"]);
Route::get('flushQuery',[CronManager::class,"FlushQuery"]);
//Route::get('addSpouseBulk',[AdminController::class,'AddSpouseBulk']);
//Route::post("",[AdminController::class,"LoginAdmin"])->name('webconnect.adminLogin');
