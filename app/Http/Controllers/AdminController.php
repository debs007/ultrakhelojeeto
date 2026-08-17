<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Currentbet;
use App\Models\Moneytransfer;
use App\Models\Transaction;
use App\Models\Backup;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Member;
use App\Models\Lionrequest;
use App\Models\Profession;
use Illuminate\Support\Facades\Hash;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\Gallary;
use App\Models\Gallerypicture;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use ZipArchive;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Version;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Crypt;
use App\Models\Setting;

class AdminController extends Controller
{


    public function ResizeAllImages()
    {
        $allUsers = User::select('*')->get();

        foreach($allUsers as $user)
        {
            if($user->profilePicture != null && $user->profilePicture != "N-A" && $user->profilePicture != "N/A" && $user->profilePicture != "NA" && !str_contains($user->profilePicture,"noimage"))
            {
                $pathToExplore = explode('?',$user->profilePicture)[0];
                //die(public_path($user->profilePicture));
                \Image::make("https://lionsclub.lionsgzb.in/".$pathToExplore)->resize(128,128)->save(public_path($pathToExplore));
            }
        }

        return response("All images resized",200);
    }

    public function DisableEvent(Request $request)
    {
         Event::where('id',$request->id)->update(["status"=>"disabled"]);
         return redirect()->back();
        
    }
    public function ResetCarry(Request $request)
    {
       $bet = Bet::orderBy('created_at','desc')->limit(1)->first();
       $cBet = Currentbet::orderBy('created_at','desc')->limit(1)->first();

       Bet::where('id',$bet->id)->update(["carry"=>0]);
       Currentbet::where('id',$cBet->id)->update(["inAdd"=>0]);

       return redirect()->back();
    }
    public function ChangeTimer(Request $request)
    {
        Setting::where('name','time')->update(["value"=>$request->time]);
        return redirect()->back();
    }
    public function ChangeSpeed(Request $request)
    {
        Setting::where('name','speedF')->update(["value"=>$request->speed_f]);
        return redirect()->back();
    }
    public function ChangeSpeedSecond(Request $request)
    {
        Setting::where('name','speedS')->update(["value"=>$request->speed_s]);
        return redirect()->back();
    }
    public function DisableGallery(Request $request)
    {
         Gallary::where('id',$request->id)->update(["status"=>"disabled"]);
         return redirect()->back();
        
    }
    public function EnableEvent(Request $request)
    {
         Event::where('id',$request->id)->update(["status"=>"active"]);
         return redirect()->back();
    }
    public function EnableGallery(Request $request)
    {
        Gallary::where('id',$request->id)->update(["status"=>"active"]);
         return redirect()->back();
    }

    public function DeleteEvent(Request $request)
    {
        $admin = Admin::select('*')->first();
        if($request->password == $admin->password){
            Event::where('id',$request->token)->delete();
        }
        return redirect()->back();
    }

    public function DeleteGalllery(Request $request)
    {
        $admin = Admin::select('*')->first();
        if($request->password == $admin->password)
        {
            
            $eventId = Gallary::where('id',$request->token)->first();
            
            Gallerypicture::where('eventId',$eventId->eventId)->delete();
            Gallary::where('id',$request->token)->delete();
        }

        return redirect()->back();
    }

    public function TruncateDetails(Request $request)
    {
        $admin = Admin::where('id','2')->first();

        if($request->password == $admin->password)
        {
            if($request->tableName == "user")
            {
                //die("In user");
                User::truncate();
            }
            if($request->tableName == "current")
            {
                Currentbet::truncate();
            }
            if($request->tableName == "bet")
            {
                Bet::truncate();
            }
            if($request->tableName == "transaction")
            {
                Transaction::truncate();
            }

            if($request->tableName == "all")
            {
                User::truncate();
                Currentbet::truncate();
                Bet::truncate();
                Transaction::truncate();
                Moneytransfer::truncate();
                Backup::truncate();

                Bet::insert(["sessionId"=>"default","amount"=>"100","disbursed"=>"100","percent"=>"80","number"=>"2","times"=>"0","status"=>"cleared","carry"=>"0"]);
            }
            
            
        }

        return redirect()->back();
        
    }

    public function DeleteAUser(Request $request)
    {
        $admin = Admin::where('id',2)->first();

        if($request->password == $admin->password)
        {
            User::where('id',$request->token)->delete();
        }
        return redirect()->back();
    }
    public function GetVersion()
    {
        $version = Version::select('*')->orderBy('created_at','desc')->first();
        return response($version->version,200);
    }
    public function LoginAdmin(Request $request)
    {
        Session::remove('stk');
        Session::remove('super');
        Session::remove('admin');
        $admin = Admin::where('email',$request->email)->where('password',$request->password)->first();

        if($admin)
        {
            Session::put("admin","assd");
            
            return redirect('home');
        }
        else
        {
            return redirect('admin');
        }
    } 

    public function Logout(Request $request)
    {
        $gotype = "";
        if(Session::has('super'))
        {
            $gotype = "super";
        }
        if(Session::has('stk'))
        {
            $gotype = "stk";
        }
        if(Session::has('admin'))
        {
            $gotype = "admin";
        }

        Session::remove('stk');
        Session::remove('super');
        Session::remove('admin');

        if($gotype == 'super')
        {
            //dd("going to super");
            return redirect('superstockist');
        }
        else if($gotype == 'admin')
        {
            //dd("going to admin");
            return redirect('admin');
        }
        else if($gotype == 'stk')
        {
            //dd("going to stock");
            return redirect('stockist');
        }
    }

    public function ChangeMultiplier(Request $request)
    {
        Setting::where('id',$request->id)->update(['value'=>$request->value]);
        return redirect()->back();
    }

    public function LoginStockist(Request $request)
    {
        Session::remove('stk');
        Session::remove('super');
        Session::remove('admin');
        $user = User::where('name',$request->email)->where('password',$request->password)->where('type','stockist')->first();
        if($user)
        {
            if($user->status != "normal")
            {
                return redirect('stockist');
            }

            Session::put("stk",$user->name);
            
            return redirect('stockistHome');
        }
        else
        {
            return redirect('stockist');
        }
    
    }
    public function LoginSuperStockist(Request $request)
    {

        Session::remove('stk');
        Session::remove('super');
        Session::remove('admin');

        $user = User::where('name',$request->email)->where('password',$request->password)->where('type','super')->first();
        if($user)
        {
            if($user->status != "normal")
            {
                return redirect('superstockist');
            }
            Session::put("super",$user->name);
            
            return redirect('stockistHome');
        }
        else
        {
            return redirect('superstockist');
        }
    
    }
    

    public function Revoke(Request $request)
    {
        $user = User::where('token',$request->token)->first();
        if($user)
        {
            User::where('token',$request->token)->update(["status"=>"pending"]);
        }

        return redirect('users');
    }
    public function Renew(Request $request)
    {
        $user = User::where('token',$request->token)->first();
        if($user)
        {
            User::where('token',$request->token)->update(["status"=>"member","membership"=>date('Y-m-d')]);
        }

        return redirect('users');
    }

    public function SentNotification(Request $request)
    {
        if(!empty($request->whatsapp))
        {
            if($request->id != "all")
            {
                $usr = User::where('id',$request->id)->first();
                $this->SendWhatsappNotification($usr->phone,$request->notification);
            }
            else
            {
                $this->SendWhatsappNotification(null,$request->notification);
            }
        }

        if(!empty($request->inapp))
        {
            if($request->id != "all")
            {
                $usr = User::where('id',$request->id)->first();
                $this->RegisterNotification($request->title,$request->notification,$usr->id);
            }
            else
            {
                $this->RegisterNotification($request->title,$request->notification);
            }
        }

        return redirect('home?notification=yes');
    }

    public function SendWhatsappNotification($specific = null,$msgBody)
    {

        if($specific == null)
        {
            $specific = '';
            $users = User::where("status","member")->get();
            foreach($users as $usr)
            {
                $specific .= $usr->phone;
            }
        }

        $params=array(
            'token' => 'orhzlkscrk5qneno',
            'to' => $specific,
            'body' => $msgBody
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.ultramsg.com/instance53574/messages/chat",
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
                "content-type: application/x-www-form-urlencoded"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            // if ($err) {
            //   echo "cURL Error #:" . $err;
            // } else {
            //   echo $response;
            // }
    }

    public function AcceptLion(Request $request)
    {
        $users = new Users();

        $usr = User::where('token',$request->token)->first();
        $request->merge(["id"=>$usr->id]);
        $users->SetMembership($request);
        Lionrequest::where('userId',$usr->id)->delete();

        $this->RegisterNotification("Request accepted"," Hi ".$usr->name.", Welcome to our Lions Club, where compassion shines bright,Together we'll make a difference, spreading love and light,Join our pride, and let your heart roar with pride,As we serve our community, side by side.",$usr->id);
        return redirect('requestLion?success=yes');
    }

    public function RejectLion(Request $request)
    {
        $usr = User::where('token',$request->token)->first();
        Lionrequest::where('userId',$usr->id)->delete();
        return redirect('requestLion?success=yes');
    }

    public function CreateAd(Request $request)
    {
        $link = null;
        if(!empty($request->link))
        {
            $link = $request->link;
        }
        $phone = null;
        if(!empty($request->phone))
        {
            $phone = $request->phone;
        }
        $email = null;
        if(!empty($request->email))
        {
            $email = $request->email;
        }

        $pathName = 'images/'.$this->generateRandomString(15).'banner.png';
            if(empty($request->ad_image))
            {
                $pathName = 'images/noimage.png';
            }
            $fileName = "ad_image";
            
        if(!empty($request->ad_image)){
            
            $path =  \Image::make($request->file($fileName)->getRealPath())->resize(512,512)->save(public_path($pathName));
            $pathName.="?time=".time();
        }
        $allAds = Ad::select('*')->get();
        Ad::insert(["imageUri"=>$pathName,"link"=>$link,"phone"=>$phone,"email"=>$email,"orderId"=>(count($allAds)+1),"userId"=>$request->id]);
         
        header('location:ads?success=done');
    }
    public function UpdateAd(Request $request)
    {
        $ad = Ad::where("id",$request->id)->first();
        if($ad)
        {
            $replace = $ad->orderId;
            $existingOrder = Ad::where('orderId',$request->order)->update(["orderId"=>$replace]);
            Ad::where("id",$request->id)->update(["orderId"=>$request->order]);
        }

        return redirect('ads');
    }

    public function RemoveAd(Request $request)
    {
        $ad = Ad::where("id",$request->id)->first();
        $currentOrder = $ad->orderId;
        $allAds = Ad::select('*')->get();
        foreach($allAds as $ads)
        {
            if($ads->orderId > $currentOrder)
            {
                Ad::where('id',$ads->id)->update(['orderId'=>($ads->orderId - 1)]);
            }
        }
        Ad::where("id",$request->id)->delete();

        return redirect('ads');
    }
    public function SortAd(Request $request)
    {
        
    }

    public function UploadDetailsToGallery(Request $request)
    {

        if(!empty($request->file('photoZip')))
        {
            $zipFile = $request->file('photoZip');
            $zipPath = $zipFile->store('temp');
            
            $event = Event::where('id',$request->event_id)->first();

            if(!$event)
            {
                return redirect()->back()->with("Not event");
            }
            $eventGal = Gallary::where("eventId",$request->event_id)->first();
        

            // Extract the zip file
            $zip = new ZipArchive;
            $zip->open(storage_path('app/' . $zipPath));
            $randPathName = $this->generateRandomString(10);
            
            $extractPath = public_path('extracted/'.$randPathName);
            $zip->extractTo($extractPath);
            $zip->close();

            // Read all files inside the extracted folder
            $files = File::allFiles($extractPath);
            if(!$eventGal){
                Gallary::insert(["eventId"=>$event->id,"eventName"=>$event->name]);
            }
            // Process the files as needed
            foreach ($files as $file) {
                // Read the content of each file
                $content = File::get($file);

                // Save the content in the public path
                $fileName = $file->getRelativePathname();
                $pathToGet = 'extracted/'.$randPathName.'/'.$fileName;
                $pathName = 'thumbnails/'.$this->generateRandomString(10).'.png';
                
                $path =  \Image::make(public_path($pathToGet))->save(public_path($pathName));
                $pathName.="?time=".time();
                Gallerypicture::insert(["eventId"=>$event->id,"link"=>$pathToGet,"thumbNail"=>$pathName]);

            }

            // Clean up temporary files
            Storage::delete($zipPath);
        }
        
       // File::deleteDirectory($extractPath);

       if(!empty($request->file('videoZip')))
       {
            $this->UploadVideos($request);
       }

        return redirect()->back()->with('success', 'Files extracted and saved successfully.');
    }

    public function UploadVideos(Request $request)
    {
            $zipFile = $request->file('videoZip');
            $zipPath = $zipFile->store('temp');
            
            $event = Event::where('id',$request->event_id)->first();

            if(!$event)
            {
                return redirect()->back()->with("Not event");
            }
            $eventGal = Gallary::where("eventId",$request->event_id)->first();
        

            // Extract the zip file
            $zip = new ZipArchive;
            $zip->open(storage_path('app/' . $zipPath));
            $randPathName = $this->generateRandomString(10);
            
            $extractPath = public_path('extracted/'.$randPathName);
            $zip->extractTo($extractPath);
            $zip->close();

            // Read all files inside the extracted folder
            $files = File::allFiles($extractPath);
            if(!$eventGal){
                Gallary::insert(["eventId"=>$event->id,"eventName"=>$event->name]);
            }
            // Process the files as needed
            foreach ($files as $file) {
                // Read the content of each file
                //$content = File::get($file);

                // Save the content in the public path
                $fileName = $file->getRelativePathname();
                $pathToGet = 'extracted/'.$randPathName.'/'.$fileName;
                
                Gallerypicture::insert(["eventId"=>$event->id,"link"=>$pathToGet,"thumbNail"=>"images/defaultVideo.jpg?time=3435466","isVideo"=>"yes"]);

            }

            // Clean up temporary files
            Storage::delete($zipPath);
    }

    public function Create_Event(Request $request)
    {
        
        $pathName = 'images/'.$this->generateRandomString(15).'banner.png';
            if(empty($request->event_banner))
            {
                $pathName = 'images/noimage.png';
            }
            $fileName = "event_banner";
        if(!empty($request->event_banner)){
            
            $path =  \Image::make($request->file($fileName)->getRealPath())->resize(512,512)->save(public_path($pathName));
            $pathName.="?time=".time();
        }
        $date = explode('-',$request->start_date)[2];
        $month = explode('-',$request->start_date)[1];
        $year = explode('-',$request->start_date)[0];
        $reverseDate = $year.'-'.$month.'-'.$date;
        $organiser = "";
        if(!empty($request->host1) && $request->host1 != "None")
        {
            $organiser .= $request->host1;
        }
        if(!empty($request->host2) && $request->host2 != "None")
        {
            $organiser .= ','.$request->host2;
        }
        if(!empty($request->host3) && $request->host3 != "None")
        {
            $organiser .= ','.$request->host3;
        }
        $venue = "Lions Club";
        if(trim($request->event_venue," ") != "")
        {
            $venue = $request->event_venue;
        }
        $eventCreate = Event::insert(["name"=>$request->event_name,"description"=>$request->desc,"startDate"=>$request->start_date,"endDate"=>$request->end_date,"month"=>$month,"date"=>$date,"year"=>$year,"type"=>$request->event_type,"organiser"=>$organiser,"imgeUri"=>$pathName,"venue"=>$venue]);
        if(!empty($request->whatsapp) && $eventCreate)
        {
            $this->SendWhatsappNotification(null,"Hi a new event (".$request->event_name.") has been scheduled on ".$request->start_date." requesting you to be there. You can check this event in the upcoming event section in Lions club application. Thanks for being a part of our Lion's club");

            
        }
        if(!empty($request->inapp) && $eventCreate)
        {
            
            $this->RegisterNotification("New Event ".$request->event_name,"Hi check out our new event ".$request->event_name." on ".$request->start_date.". To know more about this event pls check in up coming section");
        }
        if($eventCreate)
        {
            return redirect('home?success=yes');
        }
        else{
            return redirect('home?success=no');
        }
    }

    public function RegisterNotification($title,$message,$for="all")
    {
        Notification::insert(["title"=>$title,"message"=>$message,"forId"=>$for]);
    }
    public function AddMoney(Request $request)
    {
        if(Session::has('super'))
        {
            $request->request->add(["name"=>Session::get('super')]);
            $this->AddMoneyToStockist($request);
        }
        else if(Session::has('stk'))
        {
            $request->request->add(["name"=>Session::get('stk')]);
            $this->AddMoneyStockist($request);
            //return;
        }
        else
        {
            $usr = User::where('id',$request->token)->first();
            $add = User::where('id',$request->token)->update(["balance"=>($usr->balance+$request->amount)]);
            Moneytransfer::insert(["userName"=>$usr->name,"payerName"=>"admin","amount"=>$request->amount,"type"=>"credit"]);
        }
        
        
        return redirect()->back();
    }
    public function AddMoneyStockist(Request $request)
    {
        $stock = User::where('type','stockist')->where('name',$request->name)->first();
        $usr = User::where('id',$request->token)->first();
       // dd($request);
        if($stock)
        {
            if($stock->balance >= $request->amount)
            {
               
                $add = User::where('id',$request->token)->update(["balance"=>($usr->balance+$request->amount)]);
                User::where('id',$stock->id)->update(['balance'=>($stock->balance - $request->amount)]);
                Moneytransfer::insert(["payerName"=>$stock->name,"userName"=>$usr->name,"amount"=>$request->amount,"type"=>"credit"]);
                

            }
        }
        
        
        return redirect()->back();
    }

    public function AddMoneyToStockist(Request $request)
    {
        $usr = User::where('id',$request->token)->first();
        $super = User::where('type','super')->where('name',$request->name)->first();

        if($usr->type == "agent")
        {
            $request->request->set("name",$usr->stockist);
            $this->AddMoneyStockist($request);
            return;
        }

        if($super->balance >= $request->amount)
        {
            $add = User::where('id',$request->token)->update(["balance"=>($usr->balance+$request->amount)]);
            Moneytransfer::insert(["userName"=>$usr->name,"payerName"=>$request->name,"amount"=>$request->amount,"type"=>"credit"]);
            User::where('type','super')->where('name',$request->name)->update(["balance"=>($super->balance - $request->amount)]);
        }
    }

    public function WithdrawMoneyStockist(Request $request)
    {
        
        
                $usr = User::where('id',$request->token)->first();
                $stock = User::where('name',$usr->stockist)->first();
                if($usr->balance >= $request->amount)
                {
                    $add = User::where('id',$request->token)->update(["balance"=>($usr->balance-$request->amount)]);
                    User::where('name',$stock->name)->update(['balance'=>($stock->balance + $request->amount)]);
                    Moneytransfer::insert(["payerName"=>$stock->name,"userName"=>$usr->name,"amount"=>$request->amount,"type"=>"debit"]);
                }
                

            
        
        
        
        return redirect()->back();
    }
    public function WithdrawMoney(Request $request)
    {
        $usr = User::where('id',$request->token)->first();
        if($usr->balance >= $request->amount)
        {
            $add = User::where('id',$request->token)->update(['balance'=>($usr->balance-$request->amount)]);

            if($usr->stockist != "default")
            {
                $stockist = User::where('name',$usr->stockist)->first();
                $addToStockist = User::where('name',$usr->stockist)->update(["balance"=>($stockist->balance + $request->amount)]);
                Moneytransfer::insert(["payerName"=>$usr->stockist,"userName"=>$usr->name,"amount"=>$request->amount,"type"=>"debit"]);
            }
            
        }

        return redirect()->back();
    }

    public function ResetPassword(Request $request)
    {
        User::where("id",$request->token)->update(["password"=>$request->password]);
        return redirect()->back();
    }

    public function BlockUser(Request $request)
    {
        $usr = User::where('id',$request->token)->first();
        if($usr->status == "normal")
            $add = User::where('id',$request->token)->update(["status"=>"blocked"]);
        else
            $add = User::where('id',$request->token)->update(["status"=>"normal"]);

        if($usr->type == "super")
        {
            $allStock = User::where('stockist',$usr->name)->get();
            $blckAllStock = User::where('stockist',$usr->name)->update(["status"=>"blocked"]);

            foreach($allStock as $as)
            {
                User::where('stockist',$as->name)->update(["status"=>"blocked"]);
            }
        }
        else if($usr->type == "stockist")
        {       
            $blckAllStock = User::where('stockist',$usr->name)->update(["status"=>"blocked"]);
        }

        return redirect()->back();
    }

    public function UnBlockUser(Request $request)
    {
        $usr = User::where('id',$request->id)->first();
        $add = User::where('id',$request->id)->update(["status"=>"normal"]);

        if($usr->type == "super")
        {
            $allStock = User::where('stockist',$usr->name)->get();
            $blckAllStock = User::where('stockist',$usr->name)->update(["status"=>"normal"]);

            foreach($allStock as $as)
            {
                User::where('stockist',$as->name)->update(["status"=>"normal"]);
            }
        }
        else if($usr->type == "stockist")
        {       
            $blckAllStock = User::where('stockist',$usr->name)->update(["status"=>"normal"]);
        }

        return redirect()->back();
    }

    public function createUser(Request $request)
    {


        $exists = User::where("name",$request->name)->first();
        if($exists)
        {
            return redirect()->back();
        }

        User::insert(["name"=>$request->name,"password"=>$request->password,"token"=>$this->generateRandomString(12),"stockist"=>$request->stockist,"type"=>$request->type,"percent"=>$request->percent]);

        return redirect()->back();
    }

    public function EditUser(Request $request)
    {
        $user = User::where("name",$request->name)->first();
        if($user)
        {
            User::where("name",$request->name)->update(["name"=>$request->name,"percent"=>$request->percent]);
        }
        return redirect()->back();
    }

    public function SetDisburse(Request $request)
    {
        Setting::where("id",2)->update(["value"=>($request->value)]);
        return redirect()->back();
    }

    

    public function AddUsersBulk(Request $request)
    {
        

        $validator = Validator::make($request->all(),[
            'sheet' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if(true)
        {
            $dateTime = date('Ymd_His');
            $file = $request->file('sheet');
            $fileName = $dateTime . '-' .$file->getClientOriginalName();
            $savePath = public_path('/uploads/');
            $file->move($savePath,$fileName);
            $rowCount = 0;
            if (($handle = fopen ( $savePath.$fileName, 'r' )) !== FALSE) {
                while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {

                    if($rowCount > 0)
                    {
                        
                    $req = new Request(["member_name"=>$data[0],"member_pass"=>$data[1],"member_phone"=>$data[2],"city"=>$data[3],"zip"=>$data[4],"profession"=>$data[5],"member_type"=>$data[6],"dob"=>$data[7],"blood"=>$data[8],"anni"=>$data[9],"spouse"=>$data[10],"spousePhone"=>$data[11],"spouseDob"=>$data[12],"spouseProfession"=>$data[13],"spouseBlood"=>$data[14],"professionDetails"=>$data[15],"qualification"=>$data[16],"address"=>$data[17],"officeAddress"=>$data[18],"email"=>$data[19],'yoj'=>$data[20],'passion'=>$data[21],'highest'=>$data[22],'spousePassion'=>$data[23],'spouseHighest'=>$data[24],"spouseYoj"=>$data[25],"spouseQualification"=>$data[26]]);
                    $this->createUser($req);
                    }

                    $rowCount++;
                }
                fclose ( $handle );
            }
            //dd("passes");
            return redirect()->back();
        }
        
    }

    public function AddSpouseBulk()
    {
        $users = User::select('*')->get();

        foreach($users as $usr)
        {
            if($usr->spouse != "" && $usr->spouse != null){
                $req = ["name"=>$usr->spouse,"password"=>Hash::make("qwerty"),"phone"=>$usr->spousePhone,"city"=>$usr->city,"zip"=>$usr->zip,"profession"=>$usr->spouseProfession,"designation"=>"member","dob"=>$usr->spouseDob,"bloodGroup"=>$usr->spouseBlood,"aniversery"=>$usr->aniversery,"spouse"=>$usr->name,"spousePhone"=>$usr->phone,"spouseDob"=>$usr->dob,"spouseProfession"=>$usr->profession,"spouseBlood"=>$usr->bloodGroup,"professionDetails"=>$usr->spouseProfession,"qualification"=>$usr->spouseQualification,"address"=>$usr->address,"officeAddress"=>"N-A","email"=>"N-A",'yoj'=>$usr->spouseYoj,'passion'=>$usr->spousePassion,'highest'=>$usr->spouseHighest,'spousePassion'=>$usr->passion,'spouseHighest'=>$usr->highest,"spouseYoj"=>$usr->yoj,"spouseQualification"=>$usr->qualification,"token"=>$this->generateRandomString(15),"profilePicture"=>$usr->spouseProfile,"spouseProfile"=>$usr->profilePicture,"membership"=>date('Y-m-d')];
                
                User::insert($req);
            }
            
        }

        return response("Spouse added all",200);
    }

    public function updateUser(Request $request)
    {

        if($request->member_type != 'member')
        {
            $usr = User::where('designation',$request->member_type)->first();
            if($usr)
            {
                if($usr->token != $request->token)
                User::where('token',$usr->token)->update(["designation"=>"member"]);
            }
        }
        $usr = User::where('token',$request->token)->first();
        $pathName = $usr->profilePicture;
        if(!empty($request->profile_picture))
        {
            $pathName = 'images/'.$this->generateRandomString(15).'banner.png';
            $fileName = "profile_picture";
            if(!empty($request->profile_picture)){
                
                $path =  \Image::make($request->file($fileName)->getRealPath())->resize(128,128)->save(public_path($pathName));
                $pathName.="?time=".time();
            }
        }
        $pathName2 = $usr->spouseProfile;
        if(!empty($request->spouse_profile))
        {
            $pathName2 = 'images/'.$this->generateRandomString(15).'banner.png';
            $fileName = "spouse_profile";
            if(!empty($request->spouse_profile)){
                
                $path =  \Image::make($request->file($fileName)->getRealPath())->resize(128,128)->save(public_path($pathName2));
                $pathName.="?time=".time();
            }
        }
        
        $anni = null;
        if(!empty($request->anni))
        {
            $anni = $request->anni;
        }
        $spouse = null;
        if(!empty($request->spouse))
        {
            $spouse = $request->spouse;
        }
        $professionDetails = null;
        if(!empty($request->professionDetails))
        {
            $professionDetails = $request->professionDetails;
        }
        $spousePhone = null;
        if(!empty($request->spousePhone))
        {
            $spousePhone = $request->spousePhone;
        }
        $spouseProf = null;
        if(!empty($request->spouseProfession))
        {
            $spouseProf = $request->spouseProfession;
        }
        $spouseBlood = null;
        if(!empty($request->spouseBlood))
        {
            $spouseBlood = $request->spouseBlood;
        }
        $spouseDob = null;
        if(!empty($request->spouseDob))
        {
            $spouseDob = $request->spouseDob;
        }

        $prof_details = null;
        if(!empty($request->professionDetails))
        {
            $prof_details = $request->professionDetails;
        }
        $qualification = null;
        if(!empty($request->qualification))
        {
            $qualification = $request->qualification;
        }
        $address = null;
        if(!empty($request->address))
        {
            $address = $request->address;
        }
        $officeAddress = null;
        if(!empty($request->officeAddress))
        {
            $officeAddress = $request->officeAddress;
        }
        $email = null;
        if(!empty($request->email))
        {
            $email = $request->email;
        }
        $yoj = null;
        if(!empty($request->yoj))
        {
            $yoj = $request->yoj;
        }
        $passion = null;
        if(!empty($request->passion))
        {
            $passion = $request->passion;
        }
        $highest = null;
        if(!empty($request->highest))
        {
            $highest = $request->highest;
        }
        $spousePassion = null;
        if(!empty($request->spousePassion))
        {
            $spousePassion = $request->spousePassion;
        }
        $spouseHighest = null;
        if(!empty($request->spouseHighest))
        {
            $spouseHighest = $request->spouseHighest;
        }
        $spouseYoj = null;
        if(!empty($request->spouseYoj))
        {
            $spouseYoj = $request->spouseYoj;
        }
        $spouseQualification = null;
        if(!empty($request->spouseQualification))
        {
            $spouseQualification = $request->spouseQualification;
        }
        $tobeinserted = ['name'=>$request->member_name,'phone'=>$request->member_phone,'city'=>$request->city,'zip'=>$request->zip,'profession'=>$request->profession,'reason'=>'Want to be a Lion club member','designation'=>$request->member_type,'requested'=>'yes','profilePicture'=>$pathName,'dob'=>$request->dob,'bloodGroup'=>$request->blood,'aniversery'=>$anni,'status'=>'member','spouse'=>$spouse,'professionDetails'=>$prof_details,"spousePhone"=>$spousePhone,"spouseProfession"=>$spouseProf,"spouseBlood"=>$spouseBlood,"spouseDob"=>$spouseDob,"qualification"=>$qualification,"address"=>$address,"officeAddress"=>$officeAddress,"email"=>$email,"yoj"=>$yoj,"spouseProfile"=>$pathName2,"passion"=>$passion,"highest"=>$highest,"spousePassion"=>$spousePassion,"spouseHighest"=>$spouseHighest,"spouseYoj"=>$spouseYoj,"spouseQualification"=>$spouseQualification];
        
        User::where('token',$request->token)->update($tobeinserted);

        $hasProf = Profession::where('name',$request->profession)->first();
        if(!$hasProf)
        {
            Profession::insert(["name"=>$request->profession]);
        }

        //header('location:profile?token='.$request->token);
        return redirect('profile?token='.$request->token);
    }

    public function GetUserDetails(Request $request)
    {
        $user = User::where('token',$request->token)->first();

        if($user)
        {
            return view('tabler-dev.demo.profile',$user);
        }
        else{
            return redirect()->back();
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

    public function export(Request $request)
    {
    $products = User::select('*')->get();
    $csvFileName = 'members.csv';
    $headers = [
        'Content-Type' => 'application/csv',
        'Content-Disposition' => 'attachment; filename=' . $csvFileName,
    ];

    $handle = fopen($csvFileName, 'w');
    fputcsv($handle, ['name', 'password','phone','city','zip','Member profession','Member type','DOB','Blood','DOM (YYYY-MM-DD)','spouse','spouse phone no','spouse dob','spouse Profession','spouse Blood','professional keywords','qualification','Residence','Office address','email','Year of joining','passion','highest post in Lionism','spouce passion','Spouce highest position in lionism','YOJ','Spouce Qaulification']); // Add more headers as needed

    foreach ($products as $user) {
        fputcsv($handle, [$user->name, "qwerty",$user->phone,$user->city,$user->zip,$user->profession,$user->designation,$user->dob,$user->bloodGroup,$user->aniversery,$user->spouse,$user->spousePhone,$user->spouseDob,$user->spouseProfession,$user->spouseBlood,$user->professionDetails,$user->qualification,$user->address,$user->officeAddress,$user->email,$user->yoj,$user->passion,$user->highest,$user->spousePassion,$user->spouseHighest,$user->spouseYoj,$user->spouseQualification]); // Add more fields as needed
    }

    fclose($handle);

    return Response::make(file_get_contents($csvFileName), 200, $headers);
    //return response('',200)->withHeaders($headers);
    //return Response::download('',$csvFileName,$headers);
    }

    public function SerachUser(Request $request)
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
}
