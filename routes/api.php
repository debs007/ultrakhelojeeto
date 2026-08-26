<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SetBet;
use App\Http\Controllers\Activities;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('loginWithOtp',[Users::class,'LoginWithPhone']);
Route::post('register',[SetBet::class,'Register']);
Route::post('loginWithPassword',[Users::class,'LoginWithPassword']);
//Route::post('register',[Users::class,'Register']);
Route::post('getMembers',[Users::class,'GetMembers']);
Route::post('setProfession',[Users::class,'SetProfessions']);
Route::get('getProfession',[Users::class,'GetProfessions']);
Route::post('becomeALine',[Users::class,'RequestLion']);
Route::get('getEvents',[Users::class,'GetEvents']);
Route::post('updatePRofile',[Users::class,'UpdateProfilePicture']);
Route::post('details',[SetBet::class,'GetCurrentDetails']);
Route::post('userDetails',[Users::class,'GetSpecificUser']);
Route::get('eventGallery',[Users::class,'GetEventGallery']);
Route::post('eventGalleryPics',[Users::class,'GetGalleryPictures']);
Route::post('resetPassword',[Users::class,'ResetPassword']);
Route::get('getAds',[Users::class,'GetAds']);
Route::post('getNotifications',[Users::class,'GetNotifications']);
Route::post('getEventFilter',[Users::class,'GetEventFilter']);
Route::post('contactUs',[Users::class,'SetMessage']);
Route::post('deleteAccount',[Users::class,'DeleteAccount']);
Route::get('version',[AdminController::class,'GetVersion']);
Route::get('social',[Users::class,'GetSocialConnect']);
Route::get('socialStar',[Users::class,'GetSocialConnectStar']);
Route::post('login',[SetBet::class,'Login']);
Route::post('updateBet',[SetBet::class,'UpdateBet']);
Route::post('getWin',[SetBet::class,'GetMyWinNumber']);
Route::post('setWinValue',[SetBet::class,'SetWinValue']);
Route::post('getMyBets',[SetBet::class,'GetMyBets']);
Route::post('setStatus',[SetBet::class,'SetOnline']);
Route::post('changePassword',[Activities::class,'UpdatePassword']);
Route::post('transferBalance',[SetBet::class,'TransferBalance']);
Route::get('getTransfers',[SetBet::class,'GetTransferRecords']);