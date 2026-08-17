<?php

namespace App\Http\Controllers;
use App\Http\Controllers\SetBet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Currentbet;
use App\Models\Bet;
use Illuminate\Support\Facades\DB;

class CronManager extends Controller
{
  public function GenerateAutoBet()
  {
    $onlineUser = User::where('isOnline','yes')->get();

    if(count($onlineUser) <= 0){
    $setBet = new SetBet();

   $response = $setBet->GetNewSession(true);
   //$response = json_decode($response);
   echo ("response is ".$response);
   
   
    $request = new Request(["session"=>$response]);
    $result = $setBet->GetMyWinNumber($request);
    return response($result,200);
   
}
  }

  public function ClearUpPrevData()
  {
    $cbet = Currentbet::count();
    if($cbet > 100){
      Currentbet::orderBy('id','asc')->limit(100)->delete();
      Bet::orderBy('id','asc')->limit(100)->delete();
      return response("done clear",200);
    }
    return response("can't clear",200);
  }

  public function FlushQuery()
  {
    $flush = DB::statement("FLUSH QUERY CACHE");
    if($flush)
    {
      return response("done clear",200);
    }
    return response("can't clear",200);
  }

}