<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
@php
use Illuminate\Support\Facades\Session; 
if(!Session::has('admin'))
{
  header('location:session');
}
@endphp
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Settings</title>
    <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="/stats/js/script.js"></script>
    <meta name="msapplication-TileColor" content=""/>
    <meta name="theme-color" content=""/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <meta name="description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!"/>
    <meta name="canonical" content="https://preview.tabler.io/users.html">
    <meta name="twitter:image:src" content="https://preview.tabler.io/static/og.png">
    <meta name="twitter:site" content="@tabler_ui">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta name="twitter:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <meta property="og:image" content="https://preview.tabler.io/static/og.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Tabler">
    <meta property="og:type" content="object">
    <meta property="og:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta property="og:url" content="https://preview.tabler.io/static/og.png">
    <meta property="og:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1685973381" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1685973381" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1685973381" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1685973381" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css?1685973381" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
    <script>
      function SetTimer()
{
  var time = document.getElementById('timeVal').innerHTML;
  var SpeedF = document.getElementById('SpeedF').innerHTML;
  var SpeedS = document.getElementById('SpeedS').innerHTML;
 var allChild  = document.getElementById('timer').childNodes;
 var allChildspeedF  = document.getElementById('speed').childNodes;
 var allChildspeedS  = document.getElementById('speedSecond').childNodes;
 allChild.forEach(element => {
  if(element.value == time)
  {
    element.setAttribute("selected",true);
    
  }
 });
 allChildspeedF.forEach(element => {
  if(element.value == SpeedF)
  {
    element.setAttribute("selected",true);
    
  }
 });
 allChildspeedS.forEach(element => {
  if(element.value == SpeedS)
  {
    element.setAttribute("selected",true);
    
  }
 });
}
    </script>
  </head>
  <body onload="SetTimer()">
  <form method="post" action="{{route('webconnect.addUsersBulk')}}" enctype="multipart/form-data" id="csvform" style="display: none;">
          {{csrf_field()}}
          <input type="file" accept=".csv" id="csv" name="sheet" onchange="submitForm()">
          </form>
    <script src="./dist/js/demo-theme.min.js?1685973381"></script>
    <div class="page">
      <!-- Navbar -->
      @php
      use App\Models\User;

      $allUsers = User::where('type','super')->get();
      @endphp
      @include('tabler-dev.demo.SidePanel')
      @include('tabler-dev.demo.superstockistaddmodal')
      @include('tabler-dev.demo.addmonsystockist')

      
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Settings
                </h2>
                
              </div>
              <!-- Page title actions -->
              
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
        
          <div class="container-xl">
            <!-- <div class="row row-cards" id="allUsers">
              @foreach($allUsers as $au)
              <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('')"></span>
                    <h3 class="m-0 mb-1"><a href="profile?token={{$au->token}}">{{$au->name}}</a></h3>
                    <div class="text-secondary"> Stockist : {{$au->stockist}}</div>
                    
                  </div>
                  
                </div>
              </div>
              @endforeach
              
            </div> -->

            <h3>Khelo Jeeto 12 Cards Game Settings</h3>
            @php
            use App\Models\Setting;
            $setting = Setting::where('id',1)->first();
            $disbursedPercent = Setting::where('id',2)->first();
            $maxTime = Setting::where('name','time')->first()->value;
            $maxSpeedF = Setting::where('name','speedF')->first()->value;
            $maxSpeedS = Setting::where('name','speedS')->first()->value;
            @endphp
            <p style="display:none;" id="timeVal">{{$maxTime}}</p>
            <p style="display:none;" id="SpeedF">{{$maxSpeedF}}</p>
            <p style="display:none;" id="SpeedS">{{$maxSpeedS}}</p>
            <div class="mb-3">
            
                            <label class="form-check form-switch">
                                @if($setting->value == "on")
                              <input class="form-check-input" type="checkbox" onChange="SetValue(this)" checked>
                              @else
                              <input class="form-check-input" type="checkbox" onChange="SetValue(this)">
                              @endif
                              <span class="form-check-label">Multiplier On/Off</span>
                            </label>
            </div>
            <div class="row">
            
                            <div class="col-sm-3">
                            <form action="{{route('webconnect.setDisburse')}}" method="post">

                            {{csrf_field()}}
                            <span class="form-check-label">Disbursed Percentage</span>
                            <input type="text" class="form-control" name="value" value="{{$disbursedPercent->value}}"/>
                            <br>
                            <input type="submit" class="btn btn-success" value="Set Disburse" />
                            <form>
                            </div>
                            <div class="col-sm-3">
                              <form action="{{route('webconnect.changeTimer')}}" method="post">
                              {{csrf_field()}}
                              <span class="form-check-label">Set Clock Time</span>
                              <select class="form-control" name="time" id="timer">
                              <option value="30">30 sec</option>
                              <option value="60">60 sec</option>
                              <option value="90">1 min 30 sec</option>
                              <option value="120">2 mins</option>
                              <option value="150">2 mins 30 sec</option>
                              <option value="180">3 mins</option>
                              </select>
                              <br>
                              <input type="submit" class="btn btn-success" value="Set Time" />
                              </form>
                              </div>
                              <div class="col-sm-3">
                              <form action="{{route('webconnect.changeSpeed')}}" method="post">
                              {{csrf_field()}}
                              <span class="form-check-label">Set First Wheel Speed</span>
                              <select class="form-control" name="speed_f" id="speed">
                              <option value="100">100</option>
                              <option value="130">130</option>
                              <option value="150">150</option>
                              <option value="200">200</option>
                              <option value="230">230</option>
                              <option value="300">300</option>
                              </select>
                              <br>
                              <input type="submit" class="btn btn-success" value="Set Speed" />
                              </form>
                              </div>
                              <div class="col-sm-3">
                              <form action="{{route('webconnect.changeSpeedSecond')}}" method="post">
                              {{csrf_field()}}
                              <span class="form-check-label">Set Second Wheel Speed</span>
                              <select class="form-control" name="speed_s" id="speedSecond">
                              <option value="100">100</option>
                              <option value="130">130</option>
                              <option value="150">150</option>
                              <option value="200">200</option>
                              <option value="230">230</option>
                              <option value="300">300</option>
                              </select>
                              <br>
                              <input type="submit" class="btn btn-success" value="Set Speed" />
                              </form>
                              </div>
                              

                              
                            
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1685973381" defer></script>
    <script src="./dist/js/demo.min.js?1685973381" defer></script>
    <script>
      function AfterSelectcsv()
      {
        document.getElementById('csv').click();
      }

      function ExportToCsv()
      {
        
      }

      function SetValue(val)
      {
        if(val.checked)
        {
            window.location.href = "changeMultiplier?id=1&value=on";
        }
        else
        {
            window.location.href = "changeMultiplier?id=1&value=off";
        }
      }

      function OpenAddMoneyPanel(token)
      {
        document.getElementById("moneyid").value = token;
      }
      function OpenBlockPanel(token)
      {
        document.getElementById("blockId").value = token;
      }

      function submitForm()
      {
        document.getElementById('csvform').submit();
      }
      const textInput = document.getElementById('searchInput');
      var currentData = document.getElementById("allUsers").innerHTML;
    textInput.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        console.log('Enter key pressed!');
        var data = document.getElementById('searchInput').value;


        if(data.trim() == "")
        {
          console.log("No Search");
          document.getElementById("allUsers").innerHTML = currentData;
          return;
        }

        const xhttp = new XMLHttpRequest();

// Define a callback function
xhttp.onreadystatechange  = function() {
  if (this.readyState == 4 && this.status == 200){
    const responses = JSON.parse(this.responseText);
    document.getElementById("allUsers").innerHTML = "";
    responses.response_data.forEach(element => {

      console.log("Preparing for "+element.name);
      document.getElementById("allUsers").innerHTML += '<div class="col-md-6 col-lg-3">'+'<div class="card">'+'<div class="card-body p-4 text-center">'+'<span class="avatar avatar-xl mb-3 rounded" style="background-image: url('+element.profilePicture+')"></span>'+'<h3 class="m-0 mb-1"><a href="profile?token='+element.token+'">'+element.name+'</a></h3>'+'<div class="text-secondary">'+((element.profession == null)?' Profession : N/A' : 'Profession : '+ element.profession) +'</div>'+'<div class="mt-3">'+'<span class="badge bg-purple-lt">'+((element.designation != "vice president")? element.designation : ' Treasurer </span>')+'</div></div>'+'<div class="d-flex">'+((element.status != "member")?'<a href="renew?token='+element.token+'" class="card-btn"><img src="images/member-card.png" style="height: 20px width:20px;"> &nbsp;Renew</a>':'<a href="#" class="card-btn"><img src="images/ok.png" style="height: 20px; width:20px;"> &nbsp;Active</a>'+'<a href="revoke?token='+element.token+'" class="card-btn"><img src="images/block.png" style="height: 20px; width:20px"> &nbsp;')+'Inactive</a></div></div></div>';
                  
                
              
    });
  }
  
  
}

// Send a request
document.getElementById("allUsers").innerHTML = "Searching member......";
xhttp.open("GET",  "searchUser?search="+encodeURIComponent(data) );
xhttp.send();
        // Perform desired actions here
      }
    });

function CheckProfession()
{
 
  var profVal = document.getElementById("profs");
  var ProfNode = document.getElementById("professionSelect");
  if(profVal.value == "Other")
  {
    console.log("Hitted change");
    document.getElementById("profLable").innerHTML = "Write user's profession"
    ProfNode.removeChild(ProfNode.children[1]);
    var input = document.createElement("input");

    input.setAttribute("type","text");
    input.setAttribute("name","profession");
    input.setAttribute("class","form-control");
    ProfNode.appendChild(input);
  }
}



    </script>
  </body>
</html>