<?php

namespace App\Http\Controllers;
use App\Models\Block;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Models\Number;



use App\Models\Blocked;
use App\Models\User;
use App\Models\Token;
use App\Models\Spin;
use App\Models\Matche;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\Bot;
 use App\Models\Paymentrequest;
 use App\Models\Bankdetail;
 use App\Models\Moneytransfer;

class Activities extends Controller
{
    function blockUser(Request $req)
    {
        $opt = User::where('id',$req->id)->update(['isBlocked'=>1]);
        $usr = User::where('id',$req->id)->first();
        if($opt)
        {
            Blocked::insert(['id'=>$req->id,'activity'=>$req->activity,'reason'=>$req->reason]);

            $block = Block::where('devId',$usr->deviceId)->first();

            if(!$block){
                Block::insert(["devId"=>$usr->deviceId]);
            }
            
            header('Location:users');
        }
    }

    function ClearUser(Request $request)
    {
        $usr = User::where('id',$request->id)->update(["balance"=>0,"totalPlayPoints"=>0,"winPoint"=>0,"endPoint"=>0,"commisionReceived"=>0,"profit"=>0,"profitPercent"=>0]);

        return redirect()->back();
    }

    function SetNumber(Request $request)
    {
        Number::insert(["number"=>$request->number]);
        return redirect()->back();
    }

    function UpdatePassword(Request $request)
    {
        $usr = User::where("id",$request->id)->first();
        if($usr)
        {
            if($usr->password == $request->old)
            {
                User::where("id",$request->id)->update(["password"=>$request->new]);
                return response("done",200);
            }
            return response("not done",200);
        }
        return response("not found",200);
    }

    function SearchUser(Request $request)
    {
        $user = User::where('phone',$request->ph)->first();

        $resString = "<tr>No Data Found</tr>";
        if($user){
            $allPayments = 0;
            $allWithdrawn = 0;
            $payments = Payment::where('userName',$user->userName)->get();
            $withdrawn = Paymentrequest::where('userId',$user->id)->get();
            foreach($payments as $payment)
                                {
                                  $allPayments += $payment->amount;
                                }

                                foreach($withdrawn as $withdraw)
                                {
                                  $allWithdrawn += $withdraw->amount;
                                }                                  
            $online = "";                     
            if($user->isOnline == 0)
                $online = "No";
            else
                $online = "Yes";                     
                
                if($user->isBlocked == 0)
                {
                    $resString = "<tr id='".$user->phone."'><td>".$user->id."</td><td>".$user->name."</td><td>".$user->userName."</td><td>".$user->email."</td><td>".$user->phone."</td><td>".$user->createdAt."</td><td>".$user->lastLogin."</td><td>".$user->bounty."</td><td>".$user->referal."</td><td>".$online."</td><td>".$user->totalMatch."</td><td>".$user->totalWon."</td><td>".$user->refferd."</td><td>".$allPayments."</td><td>".$user->winBounty."</td><td>".$allWithdrawn."</td><td><div class='text-center'>
                    <a href='' class='btn btn-warning btn-rounded mb-4' data-toggle='modal' data-target='#modalRegisterForm' onclick='blockUser(".$user->id.")'>Block</a> <a href='' class='btn btn-success btn-rounded mb-4' data-toggle='modal' data-target='#modalAddmoney' onclick='blockUser(".$user->id.")'>Add Money</a> <a href='' class='btn btn-success btn-rounded mb-4' data-toggle='modal' data-target='#modalAddmoneyWithdraw' onclick='blockUser(".$user->id.")'>Add Money Winnings</a>
                  </div>";
                }
                else
                {
                    $resString = "<tr id='".$user->phone."'><td>".$user->id."</td><td>".$user->name."</td><td>".$user->userName."</td><td>".$user->email."</td><td>".$user->phone."</td><td>".$user->createdAt."</td><td>".$user->lastLogin."</td><td>".$user->bounty."</td><td>".$user->referal."</td><td>".$online."</td><td>".$user->totalMatch."</td><td>".$user->totalWon."</td><td>".$user->refferd."</td><td>".$allPayments."</td><td>".$user->winBounty."</td><td>".$allWithdrawn."</td><td><div class='text-center'>
                    <a href='unblock?id=".$user->id."' class='btn btn-danger btn-rounded mb-4'>Unblock</a>
                  </div>";
                }

                if($user->isInfluencer == 0)
                {
                    $resString .= "<div class='text-center'>
                    <a href='promote?id=".$user->id."' class='btn btn-info btn-rounded mb-4'>Promote</a>
                  </div></td></tr>";
                }
                else{
                    $resString .= "<div class='text-center'>
                    <a href='demote?id=".$user->id."' class='btn btn-danger btn-rounded mb-4'>Demote</a>
                  </div></td></tr>";
                }
                                      




        }

        return response($resString,200);


        
        
    }

    function unblockUser(Request $req)
    {
        //die($req->id);
        $opt = User::where('id',$req->id)->update(['isBlocked'=>0]);

        if($opt)
        {
           Blocked::where('id',$req->id)->delete();
           header('Location:users');
        }
    }

    function AcceptPayment(Request $request)
    {
        $payment = Paymentrequest::where('SN',$request->id)->first();
       Paymentrequest::where('SN',$request->id)->update(['status'=>1]);
       $phone = User::where('id',$payment->userId)->first()->phone;
       $name = User::where('id',$payment->userId)->first()->name;
      
       header('Location:activity');
    }
    function TransactionReport(Request $request)
    {
        if($request->duration == 'week')
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 7 days' ));
            $currentDate = date('Y-m-d 23:59:00');
        }
        else if($request->duration == 'day')
        {
            $newDate = date ( 'Y-m-d 00:00:00');
            $currentDate = date('Y-m-d 23:59:00');
        }
        else if($request->duration == 'yesterday')
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 1 days' ));
            $currentDate = date('Y-m-d 23:59:00', strtotime ( ' - 1 days' ));
        }
        else if($request->duration == 'month')
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 30 days' ));
            $currentDate = date('Y-m-d 23:59:00');
        }
        else if($request->duration == 'lastweek')
        {
            $newDate = date ( 'Y-m-d 00:00:00' , strtotime ( ' - 14 days' ));
            $currentDate =date ( 'Y-m-d 23:59:00' , strtotime ( ' - 7 days' ));
        }
            if($request->type == "mine"){

                if($request->user != "none")
                {
                    $allTransactions = Moneytransfer::where('payerName','admin')->where('userName',$request->user)->where('created_at','>',$newDate)->where('created_at','<',$currentDate)->orderBy('created_at','desc')->get();
                }
                else{
                    $allTransactions = Moneytransfer::where('payerName','admin')->where('created_at','>',$newDate)->where('created_at','<',$currentDate)->orderBy('created_at','desc')->get();
                }

                
            }
            else
            {
                if($request->user != "none")
                {
                    $allTransactions = Moneytransfer::where('userName',$request->user)->where('created_at','>',$newDate)->where('created_at','<',$currentDate)->orderBy('created_at','desc')->get();
                }
                else{
                    $allTransactions = Moneytransfer::where('created_at','>',$newDate)->where('created_at','<',$currentDate)->orderBy('created_at','desc')->get();
                }
                
            }
            
            return response(["all"=>$allTransactions],200);
        
    }

    function UpdateWithdraw()
    {
       $run = DB::statement('UPDATE users SET withdraw=2');
       header('Location:activity');
    }

    function SendSms($msg,$number)
    {
        $params=array(
            
            'route ' => 'q',
            'sender_id ' => 'FTZSMS',
            'message'=>$msg,
            
            'numbers'=>$number,
            
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => http_build_query($params),
              CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "authorization"=>"K3CgpXpvkr"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);

            return response($response);
    }

    function DeclinePayment(Request $request)
    {
        $payment = Paymentrequest::where('SN',$request->id)->first();
        Paymentrequest::where('SN',$request->id)->update(['status'=>2]);
        $winbounty = User::where('id',$payment->userId)->first()->winBounty;
        $refund = $payment->amount + $winbounty;
        User::where('id',$payment->userId)->update(['winBounty'=>$refund]);
        //$this->sendSmsToUser($payment->userId,"rejected");
        header('Location:activity');
    }

    function sendSmsToUser($uid,$type)
    {
        $phone = User::where('id',$uid)->first()->phone;
        $name = User::where('id',$uid)->first()->userName;
        
        if($type=="accept")
        {
            $text = "Hi ". $name.",Your withdrawal request have been accepted! Thanks from Todd apples.";
        }
        else
        {
            $text = "Hi ". $name.",Your payment withdraw request have been rejected! Thanks from Todd apples.";
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://sms.leariesservices.com/api/mt/SendSMS?user=Gamersgram&password=12345&senderid=TETENN&channel=Trans&DCS=0&flashsms=0&number=".$phone."&text=".$text);

// return the transfer as a string, also with setopt()
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// curl_exec() executes the started curl session
// $output contains the output string
$output = curl_exec($curl);

// close curl resource to free up system resources
// (deletes the variable made by curl_init)
curl_close($curl);
return $output;
    }

    function enableOrDiableToken(Request $request)
    {
       $dat = Token::where('SN',$request->id)->first();

       if($dat->status == 0)
       {
           Token::where('SN',$request->id)->update(['status'=>1]);
           header("Location:activity");
       }
       else
       {
           Token::where('SN',$request->id)->update(['status'=>0]);
           header("Location:activity");
       }
    }

    function updateSpinValues(Request $request)
    {
        $update = Spin::where("SN",1)->update(["zero"=>$request->one,"one"=>$request->two,"two"=>$request->three,"three"=>$request->four,"four"=>$request->five,"five"=>$request->six]);
        if($update)
        header("location:activity");
    }
    function AddBots(Request $request){
        
        $count = 1;
        $val = $count.'name';
        $pic = $count.'picture';
        while(!empty($request->$val) && !empty($request->$pic))
        {
            //$picture = $request->$pic;
            //print_r($request->$val.$request->$pic);exit(0);
            //$imageName = $request->$val.'.png';
            $imageSaveStat = $this->getProfImage($request,$request->$val,$pic);
            //$picture->move(public_path('profilePictures'), $imageName);
            $profUrl = url('/profilePictures/'.$request->$val.'.png?'.rand(10000000,900000000));

        if(!$imageSaveStat)
        {
            $profUrl = url('/profilePictures/default.png');
        }
            Bot::insert(['userName'=>$request->$val,'profilePic'=>$profUrl]);
            $count++;
            $val = $count.'name';
            $pic = $count.'picture';
        }

        header("Location:activity");
    }
    function getProfImage(Request $image,$userName,$picName)
    {
       // $base64Encoded = $image;
        
            
              $usrName = $userName;
              $poc =  \Image::make($image->file($picName)->getRealPath())->save(public_path('profilePictures/'.$usrName.'.png'));
              if($poc)
              {
               return true;
               }
               return false;
            
            
            
    }
    
}
