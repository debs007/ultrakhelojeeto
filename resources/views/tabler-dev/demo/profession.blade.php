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
    redirect('session');
}
if(!Session::has('hyper'))
{
  return redirect('session');
}
@endphp
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Current Bets</title>
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
    <style>
        .ts-dropdown
        {
            position: relative;
        }
    </style>
    
  </head>
  <body >
    <script src="./dist/js/demo-theme.min.js?1685973381"></script>
    <div class="page">
      <!-- Navbar -->
      
      

      @php
      
      use App\Models\Bet;
      $bets = Bet::select('*')->orderBy('created_at','desc')->limit(100)->get();
      $card = ["J ❤","J ♠","J ♦","J ♣","K ❤","K ♠","K ♦","K ♣","Q ❤","Q ♠","Q ♦","Q ♣"];
      @endphp
      @include('tabler-dev.demo.SidePanel')
      
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Current Bet
                </h2>
                <div class="text-secondary mt-1">List of current running bets with session ID</div>
                <p style="display:none;" id="sessionId"></p>
                <p id="sessionNumber"></p>
                Time : <span style="color:#808080;" id="maintimer"></span>
              </div>
              <div class="col" style="justify-content:right;">
                            <p id="totalAmount" style="line-height:0.2em; text-align:right;">Total : 0</p>
                            <p id="disbursedAmount" style="line-height:0.2em; text-align:right;">Given : 0</p>
                            <p id="carryAmount" style="line-height:0.2em; text-align:right;">Carry : 0</p>
                            <p style="line-height:0.2em; text-align:right;">-----------</p>
                            <p id="profitAmount" style="line-height:0.2em; text-align:right;">Profit : 0</p>
                          </div>
              
              
              <!-- Page title actions -->
              <!-- <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                  <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…"/>
                  <a href="#" class="btn btn-primary">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    New user
                  </a>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
            <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="mb-3" style="justify-content: center;">
                            <div class="form-label">Apply X</div>
                            <div>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="0" onchange="OnXSelected(this)" id="zeroX" checked>
                                <span class="form-check-label">0x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="2" onchange="OnXSelected(this)">
                                <span class="form-check-label">2x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="3" onchange="OnXSelected(this)">
                                <span class="form-check-label">3x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="4" onchange="OnXSelected(this)">
                                <span class="form-check-label">4x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="5" onchange="OnXSelected(this)">
                                <span class="form-check-label">5x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="6" onchange="OnXSelected(this)">
                                <span class="form-check-label">6x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="7" onchange="OnXSelected(this)">
                                <span class="form-check-label">7x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="8" onchange="OnXSelected(this)">
                                <span class="form-check-label">8x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="9" onchange="OnXSelected(this)">
                                <span class="form-check-label">9x</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
	       name="radios-inline" value="10" onchange="OnXSelected(this)">
                                <span class="form-check-label">10x</span>
                              </label>
                            </div>
                          </div>
                        <div class="badges-list" style="justify-content: center;">
                          
                          <span class="badge bg-blue" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(0)" id="zero_0">J ❤<div id="zeroVal" style="font-size:12px;padding:5px;">₹ 0</div></span>
                          <span class="badge bg-azure" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(1)" id="zero_1">J ♠<div style="font-size:12px;padding:5px;" id="oneVal">₹ 0</div></span>
                          <span class="badge bg-indigo" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(2)" id="zero_2">J ♦<div style="font-size:12px;padding:5px;" id="twoVal">₹ 0</div></span>
                          <span class="badge bg-purple" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(3)" id="zero_3">J ♣<div style="font-size:12px;padding:5px;" id="threeVal">₹ 0</div></span>
                          <span class="badge bg-pink" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(4)" id="zero_4">K ❤<div style="font-size:12px;padding:5px;" id="fourVal">₹ 0</div></span>
                          <span class="badge bg-red" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(5)" id="zero_5">K ♠<div style="font-size:12px;padding:5px;" id="fiveVal">₹ 0</div></span>
                          <span class="badge bg-orange" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(6)" id="zero_6">K ♦<div style="font-size:12px;padding:5px;" id="sixVal">₹ 0</div>Orange</span>
                          <span class="badge bg-yellow" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(7)" id="zero_7">K ♣<div style="font-size:12px;padding:5px;" id="sevenVal">₹ 0</div>Yellow</span>
                          <span class="badge bg-lime" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(8)" id="zero_8">Q ❤<div style="font-size:12px;padding:5px;" id="eightVal">₹ 0</div>Lime</span>
                          <span class="badge bg-green" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(9)" id="zero_9">Q ♠<div style="font-size:12px;padding:5px;" id="nineVal">₹ 0</div>Green</span>
                          <span class="badge bg-green" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(10)" id="zero_10">Q ♦<div style="font-size:12px;padding:5px;" id="tenVal">₹ 0</div>Green</span>
                          <span class="badge bg-green" style="width:80px;height:50px;font-size:20px;" onclick="NumSelected(11)" id="zero_11">Q ♣<div style="font-size:12px;padding:5px;" id="elevenVal">₹ 0</div>Green</span>
                          
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                          <th class="w-1">Session. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                          </th>
                          <th>Bet Amount</th>
                          <th>Disbursed Amount</th>
                          <th>Won Card</th>
                          <th>On Percent</th>
                          <th>Created At</th>
                          <th>Status</th>
                          <th>Amount Carry</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($bets as $bet)
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">{{$bet->sessionId}}</span></td>
                          <td>{{$bet->amount}}</td>
                          <td>
                          {{$bet->disbursed}}
                          </td>
                          <td>
                          {{$card[$bet->number]}}
                          @if($bet->times == 0)
                          &nbsp; (N)
                          @else
                          &nbsp; ({{$bet->times}}x)
                          @endif
                          </td>
                          <td>
                          {{$bet->percent}}
                          </td>
                          <td>
                          {{$bet->created_at}}
                          </td>
                          <td>
                            @if($bet->status == "pending")
                            <span class="badge bg-warning me-1"></span> Pending
                            @else
                            <span class="badge bg-success me-1"></span> Cleared
                            @endif
                          </td>
                          <td>₹ {{$bet->carry}}</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="remove?session={{$bet->sessionId}}">
                                  Remove Bet
                                </a>
                                <a class="dropdown-item" href="clear?session={{$bet->sessionId}}">
                                  Mark as Clear
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        @endforeach
                        
                        
                      </tbody>
                    </table>
                  </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <!-- Libs JS -->
    <script src="./dist/libs/nouislider/dist/nouislider.min.js?1685973381" defer></script>
  <script src="./dist/libs/litepicker/dist/litepicker.js?1685973381" defer></script>
  <script src="./dist/libs/tom-select/dist/js/tom-select.base.min.js?1685973381" defer></script>
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1685973381" defer></script>
    <script src="./dist/js/demo.min.js?1685973381" defer></script>
    <script>
var totalAmount = 0;
window.setInterval(function(){

  const xhttp = new XMLHttpRequest();

// Define a callback function
xhttp.onreadystatechange  = function() {
  if (this.readyState == 4 && this.status == 200){
    const responses = JSON.parse(this.responseText);
    
    
 totalAmount = responses.response_data.zero + responses.response_data.one + responses.response_data.two + responses.response_data.three + responses.response_data.four + responses.response_data.five + responses.response_data.six + responses.response_data.seven + responses.response_data.eight + responses.response_data.nine + responses.response_data.ten + responses.response_data.eleven;
      
      document.getElementById("zeroVal").innerHTML ="₹ "+ responses.response_data.zero;
      document.getElementById("oneVal").innerHTML = "₹ "+responses.response_data.one;
      document.getElementById("twoVal").innerHTML = "₹ "+responses.response_data.two;
      document.getElementById("threeVal").innerHTML = "₹ "+responses.response_data.three;
      document.getElementById("fourVal").innerHTML = "₹ "+responses.response_data.four;
      document.getElementById("fiveVal").innerHTML = "₹ "+responses.response_data.five;
      document.getElementById("sixVal").innerHTML = "₹ "+responses.response_data.six;
      document.getElementById("sevenVal").innerHTML = "₹ "+responses.response_data.seven;
      document.getElementById("eightVal").innerHTML = "₹ "+responses.response_data.eight;
      document.getElementById("nineVal").innerHTML = "₹ "+responses.response_data.nine;
      document.getElementById("tenVal").innerHTML = "₹ "+responses.response_data.ten;
      document.getElementById("elevenVal").innerHTML = "₹ "+responses.response_data.eleven;
       
      if(document.getElementById("sessionId").innerHTML != responses.response_data.session)
      {
        ResetAllButtons();
        Starttime(responses.response_data.diff);
      }
      document.getElementById("sessionId").innerHTML = responses.response_data.session;

      document.getElementById("totalAmount").innerHTML = "Total : "+totalAmount;

      document.getElementById("sessionNumber").innerHTML ="Session : "+ responses.response_data.sessionNum;
                
              
    
  }
}

xhttp.open("GET",  "getBetStat" );
xhttp.send();

},500);

function SetPreWinNumber()
{

}
function Starttime(time)
{
  var mins = parseInt(time / 60);
  var sec  = parseInt(time - (mins * 60))

setInterval(function(){
  if(time > 0)
  {
    document.getElementById("maintimer").innerHTML = "0"+mins;
    if(sec < 10)
    {
      document.getElementById("maintimer").innerHTML += ":0"+sec;
    }
    else
    {
      document.getElementById("maintimer").innerHTML += ":"+sec;
    }

    sec--;
    if(sec < 0)
    {
      sec = 59;
      mins--;
    }

    time--;
  }
},1000);

  
}
function ResetAllButtons()
{
  if(prevElement != null)
  {
    console.log("Prev class "+prevClass);
    prevElement.setAttribute("class",prevClass);



  }

  document.getElementById("totalAmount").innerHTML = "Total : 0";
    document.getElementById("disbursedAmount").innerHTML = "Given : 0";
    document.getElementById("carryAmount").innerHTML = "Carry : 0";
    document.getElementById("profitAmount").innerHTML = "Profit : 0";
    document.getElementById("zeroX").checked = true;
}


      
    </script>
    <script>
      document.addEventListener("keypress", function(event) {
        
          if (event.keyCode == 48) {
            NumSelected(0);
          }
          else if (event.keyCode == 49) {
            NumSelected(1);
          }
          else if (event.keyCode == 50) {
            NumSelected(2);
          }
          else if (event.keyCode == 51) {
            NumSelected(3);
          }
          else if (event.keyCode == 52) {
            NumSelected(4);
          }
          else if (event.keyCode == 53) {
            NumSelected(5);
          }
          else if (event.keyCode == 54) {
            NumSelected(6);
          }
          else if (event.keyCode == 55) {
            NumSelected(7);
          }
          else if (event.keyCode == 56) {
            NumSelected(8);
          }
          else if (event.keyCode == 57) {
            NumSelected(9);
          }
        
  
});
var SelectedNumber;
var prevClass;
var prevElement;

function OnXSelected(radio)
{
  if(radio.checked)
  {
    var session = document.getElementById("sessionId").innerHTML;

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200)
      {
        //const responses = JSON.parse(this.responseText);
        const response_data = JSON.parse(this.responseText);
        document.getElementById("totalAmount").innerHTML = "Total : "+response_data.totalValue;
        document.getElementById("disbursedAmount").innerHTML = "Given : "+response_data.disburse;
        document.getElementById("carryAmount").innerHTML = "Carry : "+response_data.carry;
        document.getElementById("profitAmount").innerHTML = "Profit : "+((response_data.totalValue + response_data.carry)  - response_data.disburse)+" ("+response_data.xval+"x)";

        
      }
    }
      xhttp.open("GET",  "setPreWinX?session="+session+"&xval="+radio.value);
      xhttp.send();
  }
}

function NumSelected(val)
{
  console.log("Selected number "+val);

  if(prevElement != null)
  {
    console.log("Prev class "+prevClass);
    prevElement.setAttribute("class",prevClass);
  }

  var selectedelement = document.getElementById("zero_"+val);
  prevElement = selectedelement;
  prevClass = prevElement.getAttribute("class");

  if(SelectedNumber != val)
  selectedelement.setAttribute("class","badge bg-black");

  SelectedNumber = val;
  var session = document.getElementById("sessionId").innerHTML;

const xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function(){
  if (this.readyState == 4 && this.status == 200)
  {
    //const responses = JSON.parse(this.responseText);
    const response_data = JSON.parse(this.responseText);
    document.getElementById("totalAmount").innerHTML = "Total : "+response_data.totalValue;
    document.getElementById("disbursedAmount").innerHTML = "Given : "+response_data.disburse;
    document.getElementById("carryAmount").innerHTML = "Carry : "+response_data.carry;
    document.getElementById("profitAmount").innerHTML = "Profit : "+((response_data.totalValue + response_data.carry)  - response_data.disburse)+" ("+response_data.xval+"x)";

    
  }
}
  xhttp.open("GET",  "setPreWin?session="+session+"&number="+SelectedNumber);
  xhttp.send();
  
}
    </script>
    
  </body>
</html>