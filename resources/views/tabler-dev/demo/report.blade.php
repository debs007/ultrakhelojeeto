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

@endphp
<html lang="en">
  <head>
      @if(!Session::has('admin') && !Session::has('stk') && !Session::has('super'))
    <script>
        alert("Session Expired");
        window.location.href = "{{ url('session') }}";
    </script>
@endif
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Game Reports</title>
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

    </script>
  </head>
  <body >
  @if(Session::has('stk') || Session::has('super'))
      @include('tabler-dev.demo.sidepanelstockist')
    @else
      @include('tabler-dev.demo.SidePanel')
      @endif
  <form method="post" action="{{route('webconnect.addUsersBulk')}}" enctype="multipart/form-data" id="csvform" style="display: none;">
          {{csrf_field()}}
          <input type="file" accept=".csv" id="csv" name="sheet" onchange="submitForm()">
          </form>
    <script src="./dist/js/demo-theme.min.js?1685973381"></script>
    <div class="page">
      <!-- Navbar -->
      @php
      use App\Models\User;
      use Illuminate\Support\Collection;
      $totalUsers = new Collection();
      
      if(Session::has("super"))
      {
        $stock = Session::get('super');
        $name = Session::get("super");
        $allStockists = User::where('stockist',$stock)->get();
       // dd($allStockists);
        foreach($allStockists as $as)
        {
          $ts = User::where('stockist',$as->name)->get();
          //array_push($totalUsers,$ts);
          //dd($ts);
          if(count($ts) > 0)
          {
            if(count($totalUsers) > 0)
            {
              $totalUsers = $totalUsers->merge($ts);
            }
            else
            {
              $totalUsers = $ts;
            }
          }
          
        }
        
        

        //dd($totalUsers);
        
      }
      else if(Session::has("stk"))
      {
        $stock = Session::get('stk');
        $totalUsers = User::where('stockist',$stock)->get();
      }
      else
      {
        $totalUsers = User::select('*')->get();
      }

      

      @endphp

      
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Game Reports
                </h2>
                <div class="text-secondary mt-1"></div>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
        
          <div class="container-xl">
            
            <div class="row">
                <div class="col-sm-4">
                    <select name="duration" id="duration" class="form-control">
                        <option value="day">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="week">Current Week</option>
                        <option value="lastweek">Last Week</option>
                        <option value="month">Monthly</option>
                    </select>
    </div>
    <div class="col-sm-4">
                    <select name="users" id="users" class="form-control">
                        <option value="none">None</option>
                        @foreach($totalUsers as $usr)
                        @if($usr->type == "agent")
                        <option value="{{$usr->name}}">{{$usr->name}}</option>
                        @endif
                        @endforeach
                    </select>
    </div>
    <div class="col-sm-4">
                    <button class="btn btn-primary" onclick="GetReport()" id="search">Search</button>
                </div>
            </div>
<br/><br/>
            <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          
                          <th>Player</th>
                          <th>Session (Game Id)</th>
                          <th>Bets on</th>
                          <th>Amount</th>
                          <th>Won Card</th>
                          <th>Win Amount</th>
                          <th>Date</th>
                          
                        </tr>
                      </thead>
                      <tbody id="report">
                        
                        
                        
                      </tbody>
                    </table>
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
      function EditSet(val)
      {
        var all = val.split('|');
        document.getElementById("editName").value = all[0];
        document.getElementById("editPercent").value = all[1];
      }

      function OpenAddMoneyPanel(token)
      {
        document.getElementById("moneyid").value = token;
        document.getElementById("moneyid_n").value = token;
      }
      function OpenBlockPanel(token)
      {
        document.getElementById("blockId").value = token;
      }

      function submitForm()
      {
        document.getElementById('csvform').submit();
      }
    //   const textInput = document.getElementById('searchInput');
    //   var currentData = document.getElementById("allUsers").innerHTML;
    // textInput.addEventListener('keydown', (event) => {
    //   if (event.key === 'Enter') {
    //     // console.log('Enter key pressed!');
    //     // var data = document.getElementById('searchInput').value;


    //     // if(data.trim() == "")
    //     // {
    //     //   console.log("No Search");
    //     //   document.getElementById("allUsers").innerHTML = currentData;
    //     //   return;
    //     // }

        
    //     // Perform desired actions here
    //   }
    // });


    function GetReport()
    {
        const xhttp = new XMLHttpRequest();

// Define a callback function
xhttp.onreadystatechange  = function() {
  if (this.readyState == 4 && this.status == 200){
    const responses = JSON.parse(this.responseText);
    document.getElementById("report").innerHTML = "";
    var card = ["J ❤","J ♠","J ♦","J ♣","K ❤","K ♠","K ♦","K ♣","Q ❤","Q ♠","Q ♦","Q ♣"];
    responses.allBets.forEach(element => {

      console.log("Preparing for "+element.name);
      var allBets = element.bets.split("|");
      document.getElementById("report").innerHTML += "<tr><td>"+responses.playerName+"</td><td>"+element.session+"</td><td><div class='badges-list' style='justify-content: left;'><span class='badge bg-blue' style='width:30px;height:30px;font-size:10px;'>J ❤<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[0]+"</div></span><span class='badge bg-azure' style='width:30px;height:30px;font-size:10px;'>J ♠<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[1]+"</div></span><span class='badge bg-indigo' style='width:30px;height:30px;font-size:10px;'>J ♦<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[2]+"</div></span><span class='badge bg-purple' style='width:30px;height:30px;font-size:10px;'>J ♣<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[3]+"</div></span><span class='badge bg-pink' style='width:30px;height:30px;font-size:10px;'>K ❤<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[4]+"</div></span><span class='badge bg-red' style='width:30px;height:30px;font-size:10px;'>K ♠<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[5]+"</div></span><span class='badge bg-orange' style='width:30px;height:30px;font-size:10px;'>K ♦<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[6]+"</div></span><span class='badge bg-yellow' style='width:30px;height:30px;font-size:10px;'>K ♣<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[7]+"</div></span><span class='badge bg-lime' style='width:30px;height:30px;font-size:10px;'>Q ❤<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[8]+"</div></span><span class='badge bg-green' style='width:30px;height:30px;font-size:10px;'>Q ♠<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[9]+"</div></span><span class='badge bg-green' style='width:30px;height:30px;font-size:10px;'>Q ♦<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[10]+"</div></span><span class='badge bg-green' style='width:30px;height:30px;font-size:10px;'>Q ♣<div id='zeroVal' style='font-size:10px;padding-top:3px;'>₹"+allBets[11]+"</div></span></td><td>"+element.amount+"</td><td>"+card[element.won]+"</td><td>"+element.win+"</td><td>"+element.time+"</td></tr>";
                  
      
              
    });
  }
  
  
}



// Send a request
document.getElementById("report").innerHTML = "Searching member......";
var duration = document.getElementById("duration").value;
var usr = document.getElementById("users").value;
xhttp.open("GET",  "getMyReports?range="+duration+"&user="+usr);
xhttp.send();
    }

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

document.addEventListener("DOMContentLoaded",function(){
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const product = urlParams.get("fetch");

  if(product != "")
  {
    document.getElementById("users").value =product;
    document.getElementById("search").click();
  }

});

    </script>
  </body>
</html>