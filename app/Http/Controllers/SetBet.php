<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Tempbet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Currentbet;
use App\Models\User;
use App\Models\Bet;
use App\Models\Transaction;
use App\Models\Setwin;
use App\Models\Result;
use App\Models\Prewin;
use App\Models\Backup;
use Carbon\Carbon;
use App\Models\Tempholder;
use App\Models\Moneytransfer;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SetBet extends Controller
{
    //

    public function CheckTemp(Request $request)
    {
        $allTemp = Tempbet::where('user',$request->id)->where('session',$request->session)->get();
        return response($allTemp,200);

    }

    function Register(Request $request)
    {

    $validator = Validator::make($request->all(), [
        'password' => [
            'required',
            'string',
            'min:4',
            'regex:/\S/',
        ],
    ]);

    if ($validator->fails()) {
        return response("Password must be 4 digits atleast",401);
    }



    if (filter_var($request->userName, FILTER_VALIDATE_EMAIL)) {
    // Valid email
    } else {
        return response("Not a valid email address",403);
    }

        $exists = User::where('name',$request->userName);

        if($exists)
         {
            return response("This email address exists!",403);
         } 
        
        User::insert(["name"=>$request->userName,"password"=>$request->password,"token"=>$this->generateRandomString(12),"stockist"=>$request->stockist,"type"=>$request->type,"percent"=>$request->percent]);
        $usr = User::where('name',$request->userName)->first();
        return response(["data"=>$usr],200);
         
    }

    public function TakeABackup()
    {
        $allUsers = User::select('*')->get();
        foreach($allUsers as $usr)
        {
            Backup::insert(["name"=>$usr->name,"balance"=>$usr->balance,"stockist"=>$usr->stockist,"type"=>$usr->type,"percent"=>$usr->percent,"totalPlayPoints"=>$usr->totalPlayPoints,"winPoint"=>$usr->winPoint,"endPoint"=>$usr->endPoint,"commisionReceived"=>$usr->commisionReceived,"profit"=>$usr->profit,"profitPercent"=>$usr->profitPercent,"created_at"=>date('Y-m-d')]);

            User::where('id',$usr->id)->update(["totalPlayPoints"=>0,"winPoint"=>0,"endPoint"=>0,"commisionReceived"=>0,"profit"=>0,"profitPercent"=>0]);
        }
    }
    
    public function TransferBalance(Request $request)
    {
        $me = User::where('id',$request->id)->first();
        $other = User::where('name',$request->other)->first();
        
        if($me && $other)
            if($me->balance >= $request->amount)
            {
                User::where('id',$request->id)->update(["balance"=>($me->balance - $request->amount)]);
                User::where('id',$other->id)->update(["balance"=>($other->balance + $request->amount)]);
                Moneytransfer::insert(["userName"=>$other->name,"payerName"=>$me->name,"amount"=>$request->amount,"type"=>"transfer", "created_at"=>date('Y-m-d H:i:s')]);
                
                $newBal = User::where('id',$request->id)->first()->balance;
                
                return response($newBal,200);
            }
            
        return response([
            "response_msg"=>"Bad result"
            ],402);
    }
    
    public function GetTransferRecords(Request $request)
    {
        $me = User::where('id',$request->id)->first();
        if($me)
        {
          $all = Moneytransfer::where("payerName", $me->name)
                    ->where("type", "transfer")
                    ->orderBy('created_at', 'desc')
                    ->limit(100)
                    ->get();
                
                foreach ($all as $al) {
                    $al->formatted_date = $al->created_at->format('d M Y, h:i A');
                }
                
                return response()->json([
                    "response_data" => $all
                ]);
        }
        
        return response("bad response",401);
    }
    
    public function ForceLogout(Request $request)
    {

        if($request->id == "all")
        {
            User::Select('*')->update(["isOnline"=>"no"]);
            
        }
        else
        {
            User::where('id',$request->id)->update(["isOnline"=>"no"]);
        }

        
        return redirect()->back();
    }

    public function GetTurnoverReport(Request $request)
{
    // ✅ Date Range
    if ($request->range == "month") {
        $from = now()->subDays(30)->startOfDay();
        $to   = now()->endOfDay();
    } elseif ($request->range == "week") {
        $from = now()->subDays(7)->startOfDay();
        $to   = now()->endOfDay();
    } elseif ($request->range == "lastweek") {
        $from = now()->subDays(14)->startOfDay();
        $to   = now()->subDays(7)->endOfDay();
    } elseif ($request->range == "day") {
        $from = now()->startOfDay();
        $to   = now()->endOfDay();
    } elseif ($request->range == "yesterday") {
        $from = now()->subDay()->startOfDay();
        $to   = now()->subDay()->endOfDay();
    } else {
        $from = Carbon::parse($request->startDate)->startOfDay();
        $to   = Carbon::parse($request->endDate)->endOfDay();
    }

    $userType = $request->user;

    // 🔥 BASE QUERY (single optimized query)
    $query = Backup::whereBetween('created_at', [$from, $to]);

    // ============================================
    // 🟣 STOCKIST REPORT
    // ============================================
    if ($userType == "allstock") {

        if (Session::has('super')) {
            $query->where('stockist', Session::get('super'));
        } else {
            $query->where('type', 'stockist');
        }

        $data = $query->select(
                'name',
                'type',
                DB::raw('AVG(balance) as balance'),
                DB::raw('SUM(totalPlayPoints) as playPoints'),
                DB::raw('SUM(winPoint) as winPoints'),
                DB::raw('SUM(profit) as profit'),
                DB::raw('SUM(commisionReceived) as commision'),
                DB::raw('SUM(endPoint) as endPoints')
            )
            ->groupBy('name', 'type')
            ->get();

        return response(["data" => $data], 200);
    }

    // ============================================
    // 🔵 SUPER REPORT
    // ============================================
    if ($userType == "allsuper") {

        $data = $query->where('type', 'super')
            ->select(
                'name',
                'type',
                DB::raw('AVG(balance) as balance'),
                DB::raw('SUM(totalPlayPoints) as playPoints'),
                DB::raw('SUM(winPoint) as winPoints'),
                DB::raw('SUM(profit) as profit'),
                DB::raw('SUM(commisionReceived) as commision'),
                DB::raw('SUM(endPoint) as endPoints')
            )
            ->groupBy('name', 'type')
            ->get();

        return response(["data" => $data], 200);
    }

    // ============================================
    // 🟢 AGENT REPORT
    // ============================================
    if ($userType == "allagent") {

        if (Session::has('super')) {
            $query->whereIn('stockist', function ($q) {
                $q->select('name')->from('backups')->where('stockist', Session::get('super'));
            });
        } elseif (Session::has('stk')) {
            $query->where('stockist', Session::get('stk'));
        } else {
            $query->where('type', 'agent');
        }

        $data = $query->select(
                'name',
                'type',
                'stockist',
                DB::raw('AVG(balance) as balance'),
                DB::raw('SUM(totalPlayPoints) as playPoints'),
                DB::raw('SUM(winPoint) as winPoints'),
                DB::raw('SUM(profit) as profit'),
                DB::raw('SUM(commisionReceived) as commision'),
                DB::raw('SUM(endPoint) as endPoints')
            )
            ->groupBy('name', 'type', 'stockist')
            ->get();

        return response(["data" => $data], 200);
    }

    return response(["data" => []], 200);
}

    public function SetPreWinX(Request $request)
    {
        //return;
    //     $whiteList = ["223.237.98.196"];
    //   $ip = $request->getClientIp();

    //     if(!in_array($ip,$whiteList))
    //     {
    //         Session::flush();
    //         return redirect('admin');
    //     }


        $prewin = Prewin::where("session",$request->session)->first();
        
        if($prewin)
        {
            $xValToInsert = null;
            if($request->xval > 0)
            {
                $xValToInsert = $request->xval;
            }

            Prewin::where("session",$request->session)->update(["xval"=>$xValToInsert]);
            $prewin = Prewin::where("session",$request->session)->first()->number;
            $num = $prewin;
            $tempBet = Tempbet::where('session',$request->session)->first();
            switch($num)
            {
                case 0 : 
                    $tempVal = $tempBet->zero; break; 
                case 1 : 
                    $tempVal = $tempBet->one; break;
                case 2 : 
                    $tempVal = $tempBet->two; break;
                case 3 : 
                    $tempVal = $tempBet->three; break;
                case 4 : 
                    $tempVal = $tempBet->four; break;
                case 5 : 
                    $tempVal = $tempBet->five; break;
                case 6 : 
                    $tempVal = $tempBet->six; break;
                case 7 : 
                    $tempVal = $tempBet->seven; break;
                case 8 : 
                    $tempVal = $tempBet->eight; break;
                case 9: 
                    $tempVal = $tempBet->nine; break;
                case 10: 
                    $tempVal = $tempBet->ten; break;
                case 11: 
                    $tempVal = $tempBet->eleven; break;
                    
            }
            $tempVal  = $tempVal * 10;
            if($xValToInsert == null)
                $xValToInsert = 1;

            $carry = Currentbet::where('sessionId',$request->session)->first()->inAdd;
            $multVal = $tempVal * $xValToInsert;
            $totalValue = $tempBet->one + $tempBet->two + $tempBet->three + $tempBet->four + $tempBet->five + $tempBet->six + $tempBet->seven+$tempBet->eight+$tempBet->nine + $tempBet->zero;
            return response(["totalValue"=>$totalValue,"disburse"=>$multVal,"xval"=>$request->xval,"carry"=>$carry],200);
        }

        return response(null,403);
    }

    public function SetPreWin(Request $request)
    {
        //return;
    //     $whiteList = ["223.237.98.196"];
    //   $ip = $request->getClientIp();

    //     if(!in_array($ip,$whiteList))
    //     {
    //         Session::flush();
    //         return redirect('admin');
    //     }


        $prewin = Prewin::where("session",$request->session)->first();
        if($prewin)
        {
            if($prewin->number == $request->number)
            {
                Prewin::where("session",$request->session)->delete();
                return response(["totalValue"=>0,"disburse"=>0,"xval"=>0,"carry"=>0],200);
            }
            else
            {
                Prewin::where("session",$request->session)->update(["number"=>$request->number]);
            }
        }
        else
        {
            Prewin::insert(["session"=>$request->session,"number"=>$request->number]);
        }
        $num = $request->number;
        $tempBet = Tempbet::where('session',$request->session)->first();
        
        switch($num)
        {
            case 0 : 
                $tempVal = $tempBet->zero; break; 
            case 1 : 
                $tempVal = $tempBet->one; break;
            case 2 : 
                $tempVal = $tempBet->two; break;
            case 3 : 
                $tempVal = $tempBet->three; break;
            case 4 : 
                $tempVal = $tempBet->four; break;
            case 5 : 
                $tempVal = $tempBet->five; break;
            case 6 : 
                $tempVal = $tempBet->six; break;
            case 7 : 
                $tempVal = $tempBet->seven; break;
            case 8 : 
                $tempVal = $tempBet->eight; break;
            case 9: 
                $tempVal = $tempBet->nine; break;
            case 10: 
                $tempVal = $tempBet->ten; break;
            case 11: 
                $tempVal = $tempBet->eleven; break;
                
        }
        
        $tempVal  = $tempVal * 10;
        $totalValue = $tempBet->one + $tempBet->two + $tempBet->three + $tempBet->four + $tempBet->five + $tempBet->six + $tempBet->seven+$tempBet->eight+$tempBet->nine + $tempBet->zero;
        $setting = Setting::where('name','mult')->first()->value;
        $disburse = Setting::where('name','disburse')->first()->value;
        $carry = Currentbet::where('sessionId',$request->session)->first()->inAdd;
        $prewinXval = Prewin::where("session",$request->session)->first()->xval;
        if($prewinXval != null)
        {
            $multVal = $tempVal * $prewinXval;
            return response(["totalValue"=>$totalValue,"disburse"=>$multVal,"xval"=>$prewinXval,"carry"=>$carry],200);
        }


        if($setting == "on")
        {
            $mult = 5;
            $found = false;
            while($mult > 0)
            {
                $multVal = $tempVal * $mult;
                if($multVal <= (($totalValue + $carry) * $disburse/100))
                {   
                    $found = true;
                    return response(["totalValue"=>$totalValue,"disburse"=>$multVal,"xval"=>$mult,"carry"=>$carry],200);
                   // break;
                }
                $mult--;
            }
            if(!$found)
            {
                $multVal = $tempVal;
                return response(["totalValue"=>$totalValue,"disburse"=>$multVal,"xval"=>$mult,"carry"=>$carry],200);
            }
            
            
        }
        $multVal = $tempVal;
        return response(["totalValue"=>$totalValue,"disburse"=>$multVal,"xval"=>0,"carry"=>$carry],200);

        //return response($tempBet,200);
    }

    function numToWords($number) {
        $units = array('zero', 'one', 'two', 'three', 'four',
                       'five', 'six', 'seven', 'eight', 'nine');
    
        $tens = array('', 'ten', 'twenty', 'thirty', 'forty',
                      'fifty', 'sixty', 'seventy', 'eighty', 
                      'ninety');
    
        $special = array('eleven', 'twelve', 'thirteen',
                         'fourteen', 'fifteen', 'sixteen',
                         'seventeen', 'eighteen', 'nineteen');
    
        $words = '';
        if ($number < 10) {
            $words .= $units[$number];
        } elseif ($number < 20) {
            $words .= $special[$number - 11];
        } else {
            $words .= $tens[(int)($number / 10)] . ' '
                      . $units[$number % 10];
        }
    
        return $words;
    }
    // public function CreateBet()
    // {
    //     //return;
    //   $session = $this->generateRandomString(20);
    //   $sessionNum = rand(1000000000000,9999999999999);
    //   $toadd = Bet::select("*")->orderBy("created_at","desc")->limit(1)->first();
    //   $lastBet = Currentbet::select('*')->orderBy("created_at","desc")->limit(1)->first();
      
    //   if($lastBet)
    //   {
    //       if($lastBet->target > 0 && $toadd->amount > 0)
    //       {
    //           $randTarget = --$lastBet->target;
    //       }
    //       else if($lastBet->target > 0)
    //       {
    //           $randTarget = $lastBet->target;
    //       }
    //       else
    //       {
    //           $randTarget = rand(10,15);
    //       }
        
    //   }
    //   else
    //   {
    //       $randTarget = rand(10,15);
    //   }
      
    //   //$randTarget = rand(10,15);
    //   if($toadd)
    //     Currentbet::insert(["sessionId"=>$session,"inAdd"=>$toadd->carry,"sessionNum"=>$sessionNum,"created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s'),"target"=>$randTarget]);
    // else
    //     Currentbet::insert(["sessionId"=>$session,"sessionNum"=>$sessionNum,"created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s'),"target"=>$randTarget]);
    //   return response("done",200);
    // }
    
    public function CreateBet()
    {
        return DB::transaction(function () {
    
            $lastBet = Currentbet::orderBy('created_at', 'desc')
                ->lockForUpdate()
                ->first();
    
            $toadd = Bet::orderBy('created_at', 'desc')
                ->first();
    
            // Calculate target
            if ($lastBet->target > 0 && $toadd && $toadd->amount > 0) {
                $randTarget = $lastBet->target - 1;
            } elseif ($lastBet->target > 0) {
                $randTarget = $lastBet->target;
            } else {
                $randTarget = rand(10, 15);
            }
    
            $data = [
                'sessionId' => $this->generateRandomString(20),
                'sessionNum' => rand(1000000000000, 9999999999999),
                'created_at' => now(),
                'updated_at' => now(),
                'target' => $randTarget,
            ];
    
            if ($toadd) {
                $data['inAdd'] = $toadd->carry;
            }
    
            Currentbet::insert($data);
    
            return response('done', 200);
        });
    }

    public function Login(Request $request)
    {
        $usr = User::where('name',$request->userName)->where('password',$request->password)->where('type','agent')->first();
        if($usr)
        {
            if($usr->isOnline == 'yes')
            {
                $timeLast = strtotime($usr->updated_at);
                $timeNow = strtotime(date('Y-m-d H:i:s'));

                $diff = round(abs($timeNow - $timeLast) / 60,2);

                // if($diff < 5)
                // return response("Invalid",203);
            }


            User::where('name',$request->userName)->update(['lastLogin'=>date('Y-m-d')]);
            $usr->whatsapp = Setting::where('name','whatsapp')->first()->value;
            $usr->qr = Setting::where('name','qr')->first()->value;
            return response(["data"=>$usr],200);
        }
        return response("Invalid",203);
    }

    

    public function SetOnline(Request $request)
    {
        $usr = User::where("id",$request->id)->update(["isOnline"=>$request->data]);
        return response("done",200);
    }

    public function UpdateBet(Request $request)
    {
        $bet = Currentbet::where("sessionId",$request->session)->first();
        $usr = User::where("id",$request->id)->first();

        

        if($bet && $usr)
        {
            if($bet->status == "pending")
            {               

                $zero = ($request->zero);
                $one =   $request->one;
                $two =   $request->two;
                $three = $request->three;
                $four =  $request->four;
                $five =  $request->five;
                $six =   $request->six;
                $seven = $request->seven;
                $eight = $request->eight;
                $nine =  $request->nine;
                $ten =  $request->ten;
                $eleven =  $request->eleven;
                

                $tempBet = Tempbet::where("session",$request->session)->where("user",$request->id)->first();
                $allAmount = 0;
                $zero_1 = 0; $one_1=0;$two_1=0;$three_1=0;$four_1=0;$five_1=0;$six_1=0;$seven_1=0;$eight_1=0;$nine_1=0;$ten_1=0;$eleven_1=0;

                if($tempBet)
                {
                    
                        $zero_1 = $request->zero - $tempBet->zero;
                        $one_1 = $request->one - $tempBet->one;
                        $two_1 = $request->two - $tempBet->two;
                        $three_1 = $request->three - $tempBet->three;
                        $four_1 = $request->four - $tempBet->four;
                        $five_1 = $request->five - $tempBet->five;
                        $six_1 = $request->six - $tempBet->six;
                        $seven_1 = $request->seven - $tempBet->seven;
                        $eight_1 = $request->eight - $tempBet->eight;
                        $nine_1 = $request->nine - $tempBet->nine;
                        $ten_1 = $request->ten - $tempBet->ten;
                        $eleven_1 = $request->eleven - $tempBet->eleven;
                    
                   
                    $allAmount = $zero_1+$one_1+$two_1+$three_1+$four_1+$five_1+$six_1+$seven_1+$eight_1+$nine_1+$ten_1+$eleven_1;
                    if($usr->balance < $allAmount)
                    {
                        return response("over",203);
                    }
                    $commision = $allAmount * $usr->percent / 100;
                    User::where("id",$request->id)->update(["balance"=>($usr->balance - $allAmount),"totalPlayPoints"=>($usr->totalPlayPoints+$allAmount)]);
                }
                else
                {

                    if($usr->balance < $request->amount)
                    {
                        return response("over",203);
                    }

                    $commision = $request->amount * $usr->percent / 100;
                    User::where("id",$request->id)->update(["balance"=>($usr->balance - $request->amount),"totalPlayPoints"=>($usr->totalPlayPoints+$request->amount)]);

                    $allAmount = $request->amount;

                }

                

                if($tempBet)
                {
                    Tempbet::where("session",$request->session)->where("user",$request->id)->update(["zero"=>$zero,"one"=>$one,"two"=>$two,"three"=>$three,"four"=>$four,"five"=>$five,"six"=>$six,"seven"=>$seven,"eight"=>$eight,"nine"=>$nine,"ten"=>$ten,"eleven"=>$eleven]);
                }
                else
                {
                    Tempbet::insert(["session"=>$request->session,"user"=>$request->id,"zero"=>$zero,"one"=>$one,"two"=>$two,"three"=>$three,"four"=>$four,"five"=>$five,"six"=>$six,"seven"=>$seven,"eight"=>$eight,"nine"=>$nine,"ten"=>$ten,"eleven"=>$eleven]);
                }
                $amountToDeduct = 0;

                
                 $usr = User::where("id",$request->id)->first();

                $betString = $request->zero."|".$request->one."|".$request->two."|".$request->three."|".$request->four."|".$request->five."|".$request->six."|".$request->seven."|".$request->eight."|".$request->nine."|".$request->ten."|".$request->eleven;
                $this->InitTransaction($request->amount,$request->id,$request->session,$betString );
                return response($usr->balance.'|'.$request->amount,200);

            }

            return response("over",203);
        }
        return response("Invalid",401);
    }

    function InitTransaction($amount,$uid,$session,$bet=null)
    {
        $exists = Transaction::where('userId',$uid)->where('sessionId',$session)->first();
        if($exists)
        {

            if($amount == 0)
            {
                Transaction::where('userId',$uid)->where('sessionId',$session)->delete();
                return;
            }

            Transaction::where('userId',$uid)->where('sessionId',$session)->update(["amount"=>$amount,"bets"=>$bet, "updated_at"=>date('Y-m-d H:i:s')]);
        }
        else
        {
            if($amount > 0)
            Transaction::insert(["userId"=>$uid,"amount"=>$amount,"bets"=>$bet,"sessionId"=>$session, "created_at"=>date('Y-m-d H:i:s'), "updated_at"=>date('Y-m-d H:i:s')]);
        }
        
        
    }

    function GetUserReport(Request $request)
    {

    }

    // public static function WaitForSeconds($delay)
    // {
    //         $timestamp = time();
    // while (true) {
    //     if (time() - $timestamp > $delay) {
    //         //main functionality
    //         //reset timer
    //         return;
    //         }
    //     //the other functionality you mentioned
    //         }
    // }

    // public function checkResult()
    // {
    //     while(true)
    //     {
    //         //return yield SetBet::WaitForSeconds(90);
    //         sleep(90);
    //         $this->GetBetResult();
    //     }
    // }
    
    public function GetCurrentDetails(Request $request)
    {
        $usr = User::where('name',$request->userName)->where('password',$request->password)->where('type','agent')->first();
        if($usr)
        {
            


            //User::where('name',$request->userName)->update(['lastLogin'=>date('Y-m-d')]);
            return response(["data"=>$usr],200);
        }
        return response("Invalid",203);
    }

    public function GetCurrentBetstatus()
    {
        $bet = Currentbet::select("*")->orderBy("created_at","desc")->limit(1)->first();
        $totalTime = Setting::where('name','time')->first()->value;
        $dateTimeNow = time();
        $betTime = strtotime($bet->created_at);

        $diff = $dateTimeNow - $betTime;
        $diff = $totalTime-$diff ;
        $allTempBets = Tempbet::where("session",$bet->sessionId)->get();
        $zero = 0;$one = 0;$two = 0;$three = 0;$four = 0;$five = 0;$six = 0;$seven = 0;$eight = 0;$nine = 0;$ten = 0;$eleven = 0;
        if($allTempBets)
        {
            foreach($allTempBets as $atb)
            {
                $zero += $atb->zero;
                $one += $atb->one;
                $two += $atb->two;
                $three += $atb->three;
                $four += $atb->four;
                $five += $atb->five;
                $six += $atb->six;
                $seven += $atb->seven;
                $eight += $atb->eight;
                $nine += $atb->nine;
                $ten += $atb->ten;
                $eleven += $atb->eleven;
            }
        }

        $dats = ["zero"=>$zero,"one"=>$one,"two"=>$two,"three"=>$three,"four"=>$four,"five"=>$five,"six"=>$six,"seven"=>$seven,"eight"=>$eight,"nine"=>$nine,"ten"=>$ten,"eleven"=>$eleven,"session"=>$bet->sessionId,"sessionNum"=>$bet->sessionNum,"diff"=>$diff];

        return response(["response_data"=>$dats],200);
    }

    public function GetBetResult($session)
{
    return DB::transaction(function () use ($session) {

        $bet = Currentbet::where("sessionId", $session)->lockForUpdate()->first();

        if (!$bet) return response("invalid session", 404);

        $exists = Bet::where("sessionId", $session)->first();
        if ($bet->status != "pending" || $exists) {
            return response("already cleared", 200);
        }

        //  Sum all bets
        $allTempBets = Tempbet::where("session", $session)->get();

        $values = array_fill(0, 12, 0);

        foreach ($allTempBets as $atb) {
            $values[0] += $atb->zero;
            $values[1] += $atb->one;
            $values[2] += $atb->two;
            $values[3] += $atb->three;
            $values[4] += $atb->four;
            $values[5] += $atb->five;
            $values[6] += $atb->six;
            $values[7] += $atb->seven;
            $values[8] += $atb->eight;
            $values[9] += $atb->nine;
            $values[10] += $atb->ten;
            $values[11] += $atb->eleven;
        }

        Currentbet::where("sessionId", $session)->update([
            "zero"=>$values[0],"one"=>$values[1],"two"=>$values[2],"three"=>$values[3],
            "four"=>$values[4],"five"=>$values[5],"six"=>$values[6],"seven"=>$values[7],
            "eight"=>$values[8],"nine"=>$values[9],"ten"=>$values[10],"eleven"=>$values[11]
        ]);

        $totalValue = array_sum($values);

        $settings = Setting::where('id',1)->first();
        $dis = Setting::where('id',2)->first();

        //  PREWIN CHECK
        $prewin = Prewin::where("session", $session)->first();

        $allSelected = [];
        $randVal = 0;

        if (!$prewin) {

            //  SORT DESC
            $sorted = $values;
            rsort($sorted);

            foreach ($sorted as $val) {
                if (($val * 10) <= (($totalValue + $bet->inAdd) * $dis->value / 100)) {

                    $randVal = $val;

                    // find all matching indexes
                    foreach ($values as $index => $v) {
                        if ($v == $val) {
                            $allSelected[] = $index;
                        }
                    }
                    break;
                }
            }

        } else {
            $num = $prewin->number;
            $allSelected[] = $num;
            $randVal = $values[$num];
        }

        // fallback
        if (count($allSelected) < 1) {
            $nowNumber = rand(0, 11);
            $randVal = $values[$nowNumber];
        } else {
            $nowNumber = $allSelected[array_rand($allSelected)];
        }

        // MULTIPLIER
        $times = 0;

        for ($i = 5; $i > 1; $i--) {
            if (($randVal * 10 * $i) <= (($totalValue + $bet->inAdd) * $dis->value / 100)) {
                $times = $i;
                break;
            }
        }

        // settings OFF
        if ($settings->value != "on") {
            $times = 0;
        }

        // PREWIN X override
        if ($prewin && $prewin->xval != null) {
            $times = $prewin->xval;
        }
        else
        {
            if($bet->target == 0 && $totalValue>0 && $settings->value == "on")
            {
                $times = rand(2,4);
            }
        }

        // DISBURSE
        $disbursed = ($times > 0) ? $randVal * 10 * $times : $randVal * 10;

        // CARRY
        if ($totalValue > 0)
            $carry = (($totalValue + $bet->inAdd) * $dis->value / 100) - $disbursed;
        else
            $carry = ($totalValue + $bet->inAdd) - $disbursed;

        // SAVE RESULT
        Bet::create([
            "sessionId"=>$session,
            "amount"=>$totalValue,
            "disbursed"=>$disbursed,
            "percent"=>$dis->value,
            "number"=>$nowNumber,
            "times"=>$times,
            "status"=>"cleared",
            "carry"=>$carry
        ]);

        Currentbet::where("sessionId",$session)->update(["status"=>"cleared"]);

        return response("done",200);
    });
}

    public function GetMyWinNumber(Request $request)
{
    $session = $request->session;

    // Ensure result row exists
    Result::firstOrCreate([
        "session" => $session
    ], [
        "totalDisbursed" => 0
    ]);

    // âœ… Only ONE request generates result
    if (!Bet::where("sessionId", $session)->exists()) {

        $this->GetBetResult($session);

        $temps = Tempbet::where('session', $session)->get();

        foreach ($temps as $tmp) {
            $req = new Request([
                "id" => $tmp->user,
                "session" => $tmp->session,
                "laxmi" => "yes"
            ]);
            $this->SetWinValue($req);
        }
    }

    // âœ… Safe retry (NO infinite loop)
    $retry = 0;
    $bet = null;

    while ($retry < 10) {
        $bet = Bet::where("sessionId", $session)->first();
        if ($bet) break;

        usleep(100000); // 0.1 sec
        $retry++;
    }

    if (!$bet) {
        return response(["error" => "Result not ready"], 202);
    }

    $time = explode(' ', $bet->created_at)[1];

    return response([
        "number"=>$bet->number,
        "times"=>$bet->times,
        "status"=>$bet->status,
        "time"=>$time
    ]);
}

    public function SetWinValue(Request $request)
    {

        if(empty($request->laxmi))
        {
            $usr = User::where("id",$request->id)->first();
            if($usr)
            {
                return response($usr->balance,200);
            }
            return response("0",200);

        }

        $exists = Setwin::where("userId",$request->id)->where("sessionId",$request->session)->first();
        if(!$exists)
        {
            Setwin::insert(["userId"=>$request->id,"sessionId"=>$request->session]);
            $bet = Bet::where("sessionId",$request->session)->first();
            
           $usr = User::where("id",$request->id)->first();
           $tmp = Tempbet::where('user',$usr->id)->where('session',$request->session)->first();
           $atNumber = 0;
           $times = 1;

           $totalPlayPoint = $tmp->zero + $tmp->one + $tmp->two + $tmp->three + $tmp->four + $tmp->five + $tmp->six + $tmp->seven + $tmp->eight + $tmp->nine + $tmp->ten + $tmp->eleven;

           if($tmp->zero > 0 && $bet->number == 0)
           {
                $atNumber = $tmp->zero;
                
           }
           else if($tmp->one > 0 && $bet->number == 1)
           {
                $atNumber = $tmp->one;
                
           }
           else if($tmp->two > 0 && $bet->number == 2)
           {
                $atNumber = $tmp->two;
                
           }
           else if($tmp->three > 0 && $bet->number == 3)
           {
                $atNumber = $tmp->three;
                
           }
           else if($tmp->four > 0 && $bet->number == 4)
           {
                $atNumber = $tmp->four;
                
           }
           else if($tmp->five > 0 && $bet->number == 5)
           {
                $atNumber = $tmp->five;
                
           }
           else if($tmp->six > 0 && $bet->number == 6)
           {
                $atNumber = $tmp->six;
                
           }
           else if($tmp->seven > 0 && $bet->number == 7)
           {
                $atNumber = $tmp->seven;
                
           }
           else if($tmp->eight > 0 && $bet->number == 8)
           {
                $atNumber = $tmp->eight;
                
           }
           else if($tmp->nine > 0 && $bet->number == 9)
           {
                $atNumber = $tmp->nine;
                
           }
           else if($tmp->ten > 0 && $bet->number == 10)
           {
                $atNumber = $tmp->ten;
                
           }
           else if($tmp->eleven > 0 && $bet->number == 11)
           {
                $atNumber = $tmp->eleven;
                
           }

           if($bet->times > 0)
            {
                $times = $bet->times;
            }

           if($usr)
           {

            $totalWon = $atNumber * 10 * $times;
            $prof = $totalPlayPoint - $totalWon;
            $commReceive = $prof * $usr->percent / 100;
            //$profitPercent = round(($endPoint * 100)/($totalPlayPoint-$usr->commisionReceived));
            User::where("id",$request->id)->update(["balance"=>($usr->balance+$totalWon),"winPoint"=>($usr->winPoint+$totalWon),"commisionReceived"=>($usr->commisionReceived+$commReceive)]);

            $usr = User::where("id",$request->id)->first();
            $endPoint = $usr->totalPlayPoints - $usr->winPoint;
            
            $profit = $endPoint - $usr->commisionReceived;
            $profitPercent = round(($endPoint * 100)/($usr->totalPlayPoints-$usr->commisionReceived));
            User::where("id",$request->id)->update(["endPoint"=>$endPoint,"profit"=>$profit,"profitPercent"=>$profitPercent]);
            return response($usr->balance,200);
           }
        }
        return response("No user",401);
    }

    public function GetNewSession($checker = false)
    {
        $totalTime = Setting::where('name', 'time')->value('value');

        /*
        * Critical section:
        * Lock the latest Currentbet row so only one request can
        * decide/create the next session at a time.
        */
        $bet = DB::transaction(function () use ($totalTime) {

            // IMPORTANT:
            // This row is locked until the transaction commits.
            $bet = Currentbet::orderBy('created_at', 'desc')
                ->lockForUpdate()
                ->first();

            $dateTimeNow = time();
            $betTime = strtotime($bet->created_at);

            $diff = $totalTime - ($dateTimeNow - $betTime);

            if ($bet->status != "pending") {

                /*
                * Current bet has already finished.
                * Allow a small 10 second buffer before creating
                * the next session.
                */
                if ($diff < -10) {

                    $this->CreateBet();

                    /*
                    * CreateBet() creates a new Currentbet row.
                    * Get the newly-created latest row.
                    */
                    $bet = Currentbet::orderBy('created_at', 'desc')
                        ->first();
                }

            } else {

                /*
                * Current bet is pending.
                */
                if ($diff < -$totalTime) {

                    // Clear the old current bet first.
                    Currentbet::where('sessionId', $bet->sessionId)
                        ->update([
                            'status' => 'cleared'
                        ]);

                    // Create the next session.
                    $this->CreateBet();

                    // Get the newly-created current bet.
                    $bet = Currentbet::orderBy('created_at', 'desc')
                        ->first();
                }
            }

            /*
            * Transaction commits here.
            *
            * The row lock is released only after all of the above
            * operations have completed.
            */
            return $bet;
        });


        /*
        * Everything below this point doesn't need the database lock.
        */

        $prevBets = Bet::select("*")
            ->orderBy("created_at", "desc")
            ->limit(10)
            ->get();

        foreach ($prevBets as $pv) {
            $pv["time"] = explode(' ', $pv->created_at)[1];
        }


        $dateTimeNow = time();
        $betTime = strtotime($bet->created_at);

        $diff = $totalTime - ($dateTimeNow - $betTime);


        $fspeed = Setting::where('name', 'speedF')->value('value');
        $sspeed = Setting::where('name', 'speedS')->value('value');


        if ($checker) {
            return $bet->sessionId;
        }


        return response([
            "diff"       => $diff,
            "session"    => $bet->sessionId,
            "sessionNum" => $bet->sessionNum,
            "bets"       => $prevBets,
            "totalTime"  => $totalTime,
            "lastChance" => 15,
            "minLimit"   => 5,
            "fSpeed"     => $fspeed,
            "sSpeed"     => $sspeed,
            "stopper"    => 3
        ], 200);
    }

    public function GetMyBets(Request $request)
    {
        $allbets =[];

        if(empty($request->range)){
            
            $user = User::where('id',$request->id)->first();
    

        
        $allbets =[];
        if(!empty($request->type)){
            if(empty($request->from) || empty($request->to))
                $allBetsGet = Transaction::where('userId',$request->id)->where("created_at",'>',date('Y-m-d 23:59:59'))->orderBy("created_at","desc")->limit(1000)->get();
            else{
            $allBetsGet = Transaction::where('userId',$request->id)->where("created_at",'>=',$request->from)->where("created_at",'<=',$request->to)->orderBy("created_at","desc")->get();
            }
        }
        else{
            $allBetsGet = Transaction::select('*')->orderBy("created_at","desc")->limit(1000)->get();
        }
        foreach($allBetsGet as $ab)
        {
            // if(explode(' ',$ab->created_at)[0] == date('Y-m-d'))
            
                $cr = Currentbet::where("SessionId",$ab->sessionId)->first()->sessionNum;
                $win = Bet::where("SessionId",$ab->sessionId)->first();
                if($win)
                    $win = $win->number;
                else
                    $win = -1;

                $ab["sessionNum"]=$cr;
                $time = explode(' ',$ab->created_at);
                $ab["time"]=$time[1];
                $ab["number"] = $win;
                array_push($allbets,$ab);
            
            
        }
        
       // $allbets = array_reverse($allbets);
    }
    else{

        $user = User::where('name',$request->user)->first();
        
        $allbets =[];
        $allBetsGet = Transaction::where('userId',$user->id)->orderBy("created_at","desc")->get();


        if($request->range == "month")
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 30 days' ));
            $currentDate = date('Y-m-d 23:59:00');
        }
        else if($request->range == "week")
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 7 days' ));
            $currentDate = date('Y-m-d 23:59:00');
        }
        else if($request->range == "lastweek")
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 14 days' ));
            $currentDate = date('Y-m-d 23:59:00', strtotime ( ' - 7 days' ));
        }
        else if($request->range == "day")
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 1 days' ));
            $currentDate = date('Y-m-d 23:59:00');
        }
        else if($request->range == "yesterday")
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 2 days' ));
            $currentDate = date('Y-m-d 23:59:00', strtotime ( ' - 1 days' ));
        }
        else{
            $newDate = date ($request->startDate);
            $currentDate = date($request->startDate);
        }

        foreach($allBetsGet as $ab)
        {
            if(explode(' ',$ab->created_at)[0] >= $newDate && explode(' ',$ab->created_at)[0] <= $currentDate)
            {
                array_push($allbets,$ab);
            }
            
        }
    }

        foreach($allbets as $ab)
        {
            $bet = Bet::where("sessionId",$ab->sessionId)->first();
            if($bet)
            {
                $ab["won"] = $bet->number;
                $times = 1;
                $allNums = explode('|',$ab->bets);
                if($bet->times > 0)
                {
                    $times = $bet->times;
                }
                $getVal = $allNums[$bet->number];
                

                $disbursed = $getVal * 10 * $times;
                $ab["win"] = $disbursed;
            }
            else
            {
                $ab["won"] = "N/A";
                $ab["win"] = "0";
            }

            if(empty($request->range))
                $ab["time"] = explode(' ',$ab->created_at)[1];
            else
                $ab["time"] = date('Y-m-d H:i:s',strtotime($ab->created_at));
                
                
            $ab["session"] = $ab->sessionId;
        }


        return response(["allBets"=>$allbets,"totalPlayPoint"=>$user->totalPlayPoints,"winPoint"=>$user->winPoint,"date"=>date('Y-m-d'),"playerName"=>$user->name,],200);
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
