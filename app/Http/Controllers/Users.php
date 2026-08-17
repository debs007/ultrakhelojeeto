<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Lionrequest;
use App\Models\Profession;
use Illuminate\Support\Facades\Hash;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\Gallary;
use App\Models\Gallerypicture;
use App\Models\Ad;
use ZipArchive;
use App\Models\Notification;
use App\Models\Notificationread;
use App\Models\Message;
use App\Models\Moneytransfer;
use Exception;


class Users extends Controller
{

    public function ResetPassword(Request $request)
    {
        $user = User::where('token',$request->token)->first();
        if($user)
        {
            if(Hash::check($request->password,$user->password))
            {
                User::where('id',$request->id)->update(["password"=>Hash::make($request->newPassword)]);
                return response("Password reset successfully",200);
            }
            else
            {
                return response("Old password does not match",200);
            }
        }

        return response("Invalid request",200);
    }

    public function GetSocialConnect()
    {
        return response("f",200);
    }
    public function GetSocialConnectStar()
    {
        return response("f",200);
    }

    public function SetMessage(Request $request)
    {
       $msg = Message::insert(['userId'=>$request->id,'message'=>$request->message]);
        if($msg)
        {
            return response("Message sent successfully",200);
        }
        return response("Could not sent message",200);
    }

    public function GetAds()
    {
        $ads = Ad::select("*")->orderBy("orderId","asc")->limit(6)->get();

        return response(["all"=>$ads],200);
    }

    public function LoginWithPhone(Request $request)
    {
        $user = User::where('phone',$request->phone)->first();
        $notiCount = $this->NotificationCount($user->id);
        $hasAd = Ad::where('userId',$user->id)->orderBy('created_at','desc')->first();
        if($user)
        {

            if($user->status == "deactivated")
            {
                return response([
                    "response_code"=>"203",
                    "response_msg"=>"Logged in failed",
                    "response_data"=>null
                    ]);
            }

            $birthDay = [];
            $anneversary = [];
            $allUser = User::where('status','member')->get();
    
            foreach($allUser as $usr)
            {
                if(strlen($usr->dob) >= 10){
                        $splitDate = explode('-',$usr->dob)[2];
                    $splitMonth = explode('-',$usr->dob)[1];
        
                    $dt = date('Y-m-d');
                    $splitDateToday = explode('-',$dt)[2];
                    $splitMonthToday = explode('-',$dt)[1];
        
                    if($splitDate == $splitDateToday && $splitMonth == $splitMonthToday)
                    {
                        array_push($birthDay,$usr);
                    }
                }
                
    
                if(strlen($usr->aniversery) >= 10){
                        $splitDate = explode('-',$usr->aniversery)[2];
                    $splitMonth = explode('-',$usr->aniversery)[1];
        
                    $dt = date('Y-m-d');
                    $splitDateToday = explode('-',$dt)[2];
                    $splitMonthToday = explode('-',$dt)[1];
        
                    if($splitDate == $splitDateToday && $splitMonth == $splitMonthToday)
                    {
                        array_push($anneversary,$usr);
                    }
                }
                
            }

            $user["notificationCount"] = $notiCount;
            if($hasAd)
                $user["ads"] = $hasAd;
            else
                $user["ads"] = null;

                $user["birthday"] = $birthDay;
                $user["anneversary"] = $anneversary;
            
            return response([
                "response_code"=>"200",
                "response_msg"=>"Logged in successfully",
                "response_data"=>$user
        ]);
        }

        return response([
            "response_code"=>"203",
            "response_msg"=>"Logged in failed",
            "response_data"=>null
            ]);
    }

    public function GetNotifications(Request $request)
    {
       $all = Notification::select('*')->orderBy('created_at','desc')->get();

        foreach($all as $an)
        {
            $have = Notificationread::where('userId',$request->id)->where('notificationId',$an->id)->first();
            if(!$have)
            {
                Notificationread::insert(["userId"=>$request->id,"notificationId"=>$an->id]);
            }
        }

       return response([
        "response_code"=>"200",
        "response_msg"=>"All notifications fetched",
        "response_data"=>$all
        ],200);
    }

    public function GetEventGallery()
    {
       $allGallery = Gallary::where('status','active')->orderBy('created_at','desc')->get();
        $allGallerEvent = [];
        foreach($allGallery as $ag)
        {
            $event = Event::where('id',$ag->eventId)->first();
            $ag->eventBanner = $event->imageUri;
            array_push($allGallerEvent,$event);
        }

       return response([
        "response_code"=>"200",
        "response_msg"=>"success",
        "response_data"=>$allGallerEvent
        ]);
    }

    public function GetGalleryPictures(Request $request)
    {
        $allPictures = Gallerypicture::where('eventId',$request->id)->get();
        return response([
            "response_code"=>"200",
            "response_msg"=>"success",
            "response_data"=>$allPictures
            ]);
    }

    public function NotificationCount($id)
    {
        $all = Notification::select('*')->get();
        
        $count = 0;
        foreach($all as $an)
        {
            if($an->forId == "all" || $an->forId == $id){
                $read = Notificationread::where('notificationId',$an->id)->where('userId',$id)->first();
                if(!$read)
                {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function LoginWithPassword(Request $request)
    {
        $user = User::where('phone',$request->phone)->first();
        
        $notiCount = $this->NotificationCount($user->id);
        $hasAd = Ad::where('userId',$user->id)->orderBy('created_at','desc')->first();
        $birthDay = [];
        $anneversary = [];
        $allUser = User::where('status','member')->get();

        foreach($allUser as $usr)
        {
            if($usr->dob != null && $usr->dob != "N/A"){
                $splitDate = explode('-',$usr->dob)[2];
                $splitMonth = explode('-',$usr->dob)[1];

                $dt = date('Y-m-d');
                $splitDateToday = explode('-',$dt)[2];
                $splitMonthToday = explode('-',$dt)[1];

                if($splitDate == $splitDateToday && $splitMonth == $splitMonthToday)
                {
                    array_push($birthDay,$usr);
                }
            }
            

            if($usr->aniversery != null && $usr->aniversery != "N/A" && $usr->aniversery != "N-A")
            {
                try
                {
                    $splitDate = explode('-',$usr->aniversery)[2];
                    $splitMonth = explode('-',$usr->aniversery)[1];

                    $dt = date('Y-m-d');
                    $splitDateToday = explode('-',$dt)[2];
                    $splitMonthToday = explode('-',$dt)[1];

                    if($splitDate == $splitDateToday && $splitMonth == $splitMonthToday)
                    {
                        array_push($anneversary,$usr);
                    }
                }
                catch(Exception $e)
                {
                    //die($usr->aniversery);
                    continue;
                }
                
            }

            
        }


        if($user)
        {
            if($user->status == "deactivated")
            {
                return response([
                    "response_code"=>"203",
                    "response_msg"=>"Logged in failed",
                    "response_data"=>null
                    ]);
            }

            if(Hash::check($request->password,$user->password))
            {
                $user["notificationCount"] = $notiCount;
                if($hasAd)
                $user["ads"] = $hasAd;
                else
                $user["ads"] = null;

                $user["birthday"] = $birthDay;
                $user["anneversary"] = $anneversary;

                return response([
                "response_code"=>"200",
                "response_msg"=>"Logged in successfully",
                "response_data"=>$user
                ]);
            }
            
        }

        return response([
                "response_code"=>"203",
                "response_msg"=>"Logged in failed",
                "response_data"=>null
                ]);
    }

    public function Register(Request $request)
    {
        $user = User::where('phone',$request->phone)->first();

        if($user)
        {
            return response([
                "response_code"=>"203",
                "response_msg"=>"Phone number has been taken already!",
                "response_data"=>null
                ]);
        }

        $create = User::insert(["phone"=>$request->phone,"name"=>$request->name,"password"=>Hash::make($request->password),"token"=>$this->generateRandomString(30)]);

        if($create)
        {
            $user = User::where('phone',$request->phone)->first();
            return response([
                "response_code"=>"200",
                "response_msg"=>"Account created successfully!",
                "response_data"=>$user
                ]);
        }

        return response([
            "response_code"=>"203",
            "response_msg"=>"Something went wrong!",
            "response_data"=>null
            ]);
    }

    function RequestLion(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        
        if($user)
        {
            Lionrequest::insert(["userId"=>$request->id]);
            //Member::insert(["userId"=>$request->id]);
            User::where('id',$request->id)->update(["requested"=>"yes"]);
            $this->LionRequestApproved($request);
            return response("submitted",200);

        }

        return response("not submitted",200);
    }

    public function SetMembership(Request $request)
    {
        User::where('id',$request->id)->update(["status"=>"member","membership"=>date('Y-m-d')]);
    }

    function GetEvents(Request $request)
    {
        if($request->type == "past")
        {
            $allEvent = Event::where('endDate','<',Carbon::now())->where('status','active')->get();
        }
        else if($request->type == "upcoming")
        {
            $allEvent = Event::where('endDate','>=',Carbon::now())->where('status','active')->get();
        }
        else
        {
            $totalCount = 3;
            $allEvent = Event::where('endDate','>=',Carbon::now())->where('status','active')->limit($totalCount)->get();
            
            if(count($allEvent) < 3)
            {
                $totalDatas = [];
                foreach($allEvent as $ai)
                {
                    array_push($totalDatas,$ai);
                }
                
                $totalCount -= count($allEvent);
                $pasts = Event::where('endDate','<',Carbon::now())->where('status','active')->orderBy('startDate','desc')->limit($totalCount)->get();
                foreach($pasts as $ai)
                {
                    array_push($totalDatas,$ai);
                }
                $allEvent = $totalDatas;

            }

        }

        return response([
            "response_code"=>"200",
            "response_msg"=>"events fetched",
            "response_data"=>$allEvent
        ]);
    }

    function GetEventFilter(Request $request)
    {
        if(!empty($request->mm)&&!empty($request->yyyy)&!empty($request->type))
        {
            $allEvents = Event::where('month',$request->mm)->where('year',$request->yyyy)->where('type',$request->type)->get();
        }
        else if(!empty($request->mm)&&!empty($request->yyyy))
        {
            $allEvents = Event::where('month',$request->mm)->where('year',$request->yyyy)->get();
        }
        else if(!empty($request->type))
        {
            $allEvents = Event::where('type',$request->type)->get();
        }

        if($allEvents)
        {
            return response([
                "response_code"=>"200",
                "response_msg"=>"events fetched",
                "response_data"=>$allEvents
            ]);
        }

        return response([
            "response_code"=>"203",
            "response_msg"=>"events not found",
            "response_data"=>null
        ]);
    }

    public function LionRequestApproved(Request $request)
    {
        User::where('id',$request->id)->update(["requested"=>"yes","status"=>"normal","city"=>$request->city,"zip"=>$request->zip,"profession"=>$request->profession,"reason"=>$request->reason]);
    }

    function GetMembers(Request $request)
    {
        $allMembers = User::where("status","member")->get();

        $allUsersAsMember = [];
        $onlySearched = [];
        

        if($request->search == "all"){
        foreach($allMembers as $am)
        {
            //$usr = User::where('id',$am->userId)->first();
            //$allUsersAsMember[$key] = $usr;
            $hasAd = Ad::where('userId',$am->id)->orderBy('created_at','desc')->first();
                if($hasAd)
                {
                    $am["ads"]=$hasAd;
                }
                else{
                    $am["ads"]=null;
                }

            array_push($allUsersAsMember,$am);
        }
    }
    else{
        
        foreach($allMembers as $am)
        {
            //$usr = User::where('id',$am->userId)->first();
            if(str_contains(strtolower($am->name),strtolower($request->search)) || str_contains(strtolower($am->profession),strtolower($request->search)) || str_contains(strtolower($am->city),strtolower($request->search)) || str_contains(strtolower($am->bloodGroup),strtolower($request->search)) || str_contains(strtolower($am->spouse),strtolower($request->search)) || str_contains(strtolower($am->phone),strtolower($request->search)) || str_contains(strtolower($am->professionDetails),strtolower($request->search)))
            {
                $hasAd = Ad::where('userId',$am->id)->orderBy('created_at','desc')->first();
                if($hasAd)
                {
                    $am["ads"]=$hasAd;
                }
                else{
                    $am["ads"]=null;
                }
                array_push($onlySearched,$am);
            }
            
        }

        
        
    }
    if(count($onlySearched) == 0){
        return response([
            "response_code"=>"200",
            "response_msg"=>"Members fetched",
            "response_data"=>$allUsersAsMember
        ]);
    }
    else
    {
        return response([
            "response_code"=>"200",
            "response_msg"=>"Members fetched",
            "response_data"=>$onlySearched
        ]);
    }
    
        
    }

    public function GetSpecificUser(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        if($user)
        {
            return response([
                "response_code"=>"200",
                "response_msg"=>"Members fetched",
                "response_data"=>$user
            ],200);
        }

        return response([
            "response_code"=>"500",
            "response_msg"=>"Member not fetched",
            "response_data"=>null
        ],500);
        
    }

    function GetProfessions()
    {
        $allProfession = Profession::select("*")->orderBy('name','asc')->get();

        return response(["all"=>$allProfession],200);
        
    }

    function UpdateProfilePicture(Request $request)
    {
        $setProfilePicture = false;

        if(!empty($request->forSpouse)){
            $setProfilePicture = $this->getProfImage($request,true);
        }
        else
        {
            $setProfilePicture = $this->getProfImage($request);
        }

        if($setProfilePicture)
        {
            if(!empty($request->forSpouse))
            {
                User::where('token',$request->token)->update(["spouseProfile"=>'images/'.$request->token.'Spouse.png?time='.time()]);
                return response('images/'.$request->token.'Spouse.png',200);
            }
            else{
                User::where('token',$request->token)->update(["profilePicture"=>'images/'.$request->token.'.png?time='.time()]);
                return response('images/'.$request->token.'.png',200);
            }
            
            
        }

        return response("Not updated",200);
    }

    public function DeleteAccount(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        if($user)
        {
            User::where('id',$request->id)->update(['status'=>'deactivated']);
            return response("success",200);
        }

        return response("Not success",200);
    }

    function getProfImage(Request $request,$forSpouse = false)
    {
        $base64Encoded = $request->imageencoded;
        if(!empty($base64Encoded))
            {
                $usrName = $request->token;
                if($forSpouse)
                {
                    $usrName .= "Spouse";
                }
              $poc =  \Image::make($base64Encoded)->resize(512,512)->save(public_path('images/'.$usrName.'.png'));
              if($poc)
              {
               return true;
               }
               return false;
            }
            
            return false;
    }

    

    function SetProfessions(Request $request)
    {
        $allProf = explode(',',$request->profession);

        foreach($allProf as $prf)
        {
            Profession::insert(["name"=>$prf]);
        }
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
