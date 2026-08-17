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
if(!Session::has('admin') && !Session::has('stk') && !Session::has('super'))
{
  header('location:session');
}
@endphp
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Turn over report</title>
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
      //$totalUsers = User::select('*')->get();

      @endphp

      
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Turnover Reports
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
                    <select name="duration" id="duration" class="form-control" onchange="CheckIfCustom(this)">
                        <option value="day">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="week">Current Week</option>
                        <option value="lastweek">Last Week</option>
                        <option value="month">Current Month</option>
                        <option value="custom">Custom</option>
                    </select>
    </div>
    <div class="col-sm-4">
                    <select name="users" id="users" class="form-control">
                        
        @if(Session::has('super'))
        <option value="allstock">All Stockist</option>
                        <option value="allagent">All Agents</option>
                        @elseif(Session::has('stk'))
                        <option value="allagent">All Agents</option>
                        @else
                        <option value="allsuper">All Super Stockist</option>
                        <option value="allstock">All Stockist</option>
                        <option value="allagent">All Agents</option>
                        @endif
                    </select>

                    
    </div>
    
    <div class="col-sm-4">
                    <button class="btn btn-primary" onclick="GetReport()">Search</button>
                </div>
            </div><br/>
            <div class="row" id="datewise" style="display: none;">
              <div class="col-sm-4">
              
        <label class="form-label">Start Date</label>
      <input type="date" name="startDate" id="startDate" class="form-control">
      
              </div>
              <div class="col-sm-4" >
     
    
    <label class="form-label">End Date</label>
      <input type="date" name="endDate" id="endDate" class="form-control">
    
    </div>
            </div>
<br/><br/>
            <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          
                          <th>NAME</th>
                          
                          <th>CREDIT</th>
                          <th>PLAY POINTS</th>
                          <th>WIN POINTS</th>
                          <th>END POINTS</th>
                          <th id="com1">COMMISION</th>
                          <th id="com2">COMMISION</th>                         
                          <th>PROFIT</th>
                          <th>PROFIT %</th>
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
      function CheckIfCustom(val)
      {
        var customDate =document.getElementById("datewise");
          if(val.value == "custom")
          {
            customDate.style.display = "flex";
          }
          else
          {
            customDate.style.display = "none";
          }
        
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
    


    function GetReport()
    {
        const xhttp = new XMLHttpRequest();

// Define a callback function
xhttp.onreadystatechange  = function() {
  if (this.readyState == 4 && this.status == 200){
    const responses = JSON.parse(this.responseText);
    document.getElementById("report").innerHTML = "";
    var firstCol = document.getElementById("com1");
    var secondCol = document.getElementById("com2");
    if(usr == "allstock")
    {
      firstCol.innerHTML = "STOCKIST COMMISION";
      secondCol.innerHTML = "AGENTS COMMISION";
      secondCol.style = "display:block";
    }
    else if(usr == "allsuper")
    {
      firstCol.innerHTML = "SUPER STOCKIST COMMISION";
      secondCol.innerHTML = "STOCKIST COMMISION";
      secondCol.style = "display:block";
    }
    else if(usr == "allagent")
    {
      firstCol.innerHTML = "AGENT COMMISIOM";
      secondCol.style = "display:none";
    }

    var stockistName = "";
    var totalPlay = 0, totalWin = 0, totalProfit = 0,totalCommision = 0,totalCommision1 = 0, endPoints = 0 , totalprofitPercent = 0;

    responses.data.forEach(element => {

      console.log("Preparing for "+element.name);
      var profitPercent = 0;
      if(element.playPoints > 0)
        profitPercent = (element.profit * 100) /  element.playPoints;
      
        if(usr == "allagent")
        {

          if(stockistName != element.stockistName)
          {
            if(stockistName != ""){
              totalprofitPercent = totalProfit * 100 / totalPlay;
              if(isNaN(totalprofitPercent))
            {
              totalprofitPercent = 0;
            }
              document.getElementById("report").innerHTML += "<tr style='background-color:#315c22; color:#fff;'><th colspan='2' style='text-align:right; background:none;'>Total</th><th style='background:none;'>"+totalPlay+"</th><th style='background:none;'>"+totalWin+"</th><th style='background:none;'>"+endPoints+"</th><th style='background:none;'>"+totalCommision+"</th><th style='background:none;'>"+totalProfit+"</th><th style='background:none;'>"+totalprofitPercent.toFixed(2)+"%</th>";
            
            }
            document.getElementById("report").innerHTML += "<tr style='background-color:#5c2c22; color:#fff;'><th colspan='8' style='text-align:center; background:none;'>"+element.stockistName+"</th></tr>";
            stockistName =element.stockistName;

            totalPlay = 0;totalCommision =0; totalCommision1=0;totalWin=0; totalProfit=0,endPoints = 0;
          }

          document.getElementById("report").innerHTML += "<tr><td>"+element.name+"</td><td>"+element.balance+"</td><td>"+element.playPoints+"</td><td>"+element.winPoints+"</td><td>"+element.endPoints+"</td><td>"+element.commision+"</td><td>"+element.profit+"</td><td>"+profitPercent.toFixed(2)+"%</td></tr>";

          totalPlay += element.playPoints;
          totalWin += element.winPoints;
          totalProfit += element.profit;
          totalCommision += element.commision;
          endPoints += element.endPoints;

        }
        else{
          document.getElementById("report").innerHTML += "<tr><td>"+element.name+"</td><td>"+element.balance+"</td><td>"+element.playPoints+"</td><td>"+element.winPoints+"</td><td>"+element.endPoints+"</td><td>"+element.commision+"</td><td>"+element.agentCommision+"</td><td>"+element.profit+"</td><td>"+profitPercent.toFixed(2)+"%</td></tr>";
          totalPlay += element.playPoints;
          totalWin += element.winPoints;
          totalProfit += element.profit;
          totalCommision += element.commision;
          totalCommision1 +=element.agentCommision;
          endPoints += element.endPoints;
        }
        
            
    });

    totalprofitPercent = totalProfit * 100 / totalPlay;
    if(isNaN(totalprofitPercent))
    {
      totalprofitPercent = 0;
    }

    if(usr != "allagent")
    {
      document.getElementById("report").innerHTML += "<tr style='background-color:#315c22; color:#fff;'><th colspan='2' style='text-align:right; background:none;'>Total</th><th style='background:none;'>"+totalPlay+"</th><th style='background:none;'>"+totalWin+"</th><th style='background:none;'>"+endPoints+"</th><th style='background:none;'>"+totalCommision+"</th><th style='background:none;'>"+totalCommision1+"</th><th style='background:none;'>"+totalProfit+"</th><th style='background:none;'>"+totalprofitPercent.toFixed(2)+"%</th>";
    }
    else
    {
      document.getElementById("report").innerHTML += "<tr style='background-color:#315c22; color:#fff;'><th colspan='2' style='text-align:right; background:none;'>Total</th><th style='background:none;'>"+totalPlay+"</th><th style='background:none;'>"+totalWin+"</th><th style='background:none;'>"+endPoints+"</th><th style='background:none;'>"+totalCommision+"</th><th style='background:none;'>"+totalProfit+"</th><th style='background:none;'>"+totalprofitPercent.toFixed(2)+"%</th>";
    }
  }
  
  
}



// Send a request
document.getElementById("report").innerHTML = "Searching member......";
var duration = document.getElementById("duration").value;
var usr = document.getElementById("users").value;
var startDate = document.getElementById("startDate").value;
var endDate   = document.getElementById("endDate").value;
var urlStr = "";
urlStr = "getTurnoverReports?range="+duration+"&user="+usr;
if(duration == "custom")
{
  urlStr = "getTurnoverReports?range="+duration+"&user="+usr+"&startDate="+startDate+"&endDate="+endDate;
}
console.log(urlStr);
xhttp.open("GET", urlStr);
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

    </script>
  </body>
</html>