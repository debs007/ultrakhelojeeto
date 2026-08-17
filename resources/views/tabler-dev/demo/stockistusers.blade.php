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
if(!Session::has('stk') && !Session::has('super'))
{
  header('location:stockist');
}
@endphp
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Users list Lion's club</title>
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
  <form method="post" action="{{route('webconnect.addUsersBulk')}}" enctype="multipart/form-data" id="csvform" style="display: none;">
          {{csrf_field()}}
          <input type="file" accept=".csv" id="csv" name="sheet" onchange="submitForm()">
          </form>
    <script src="./dist/js/demo-theme.min.js?1685973381"></script>
    <div class="page">
      <!-- Navbar -->
      
      @include('tabler-dev.demo.sidepanelstockist')
      @include('tabler-dev.demo.useraddmodal')
      @include('tabler-dev.demo.addmoney')

      @php
      use App\Models\User;

      use Illuminate\Support\Collection;
    $totalUsers = new Collection();;
    
      if(isset($_GET["fetch"]))
      {
        $param = $_GET["fetch"];
        $totalUsers = User::where('stockist',$param)->get();
      }
    else if(Session::has("super"))
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
        $name = Session::get("stk");
        $stock = Session::get('stk');
        $totalUsers = User::where('stockist',$stock)->get();
      }
      else
      {
        $totalUsers = User::select('*')->get();
      }

      
      $allUsers = $totalUsers;
      @endphp
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Agents
                </h2>
                <div class="text-secondary mt-1">{{count($allUsers)}} Agents</div>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-user">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Create New Agent
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-user" aria-label="Add user">
				  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
				  </a>
                </div>
              </div>
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

            <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr><th colspan="6">{{date('d-m-Y')}}</th>
                        <th colspan="7">Today's Summary</th></tr>
                        <tr>
                          <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                          <th class="w-1">Id. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                          </th>

                          <th>Agent Name</th>
                          <th>Wallet Balance</th>
                          <th>Stockist</th>
                          <th>Commision</th>
                          <th>Created At</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($allUsers as $bet)
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">{{$bet->id}}</span></td>
                          <td><a href="report?fetch={{$bet->name}}">{{$bet->name}}</a></td>
                          <td>
                          ₹ {{$bet->balance}}
                          </td>
                          <td>
                          {{$bet->stockist}}
                          </td>
                          <td>
                          {{$bet->percent}} %
                          </td>
                          <td>
                          {{$bet->created_at}}
                          </td>
                          <td>
                          @if($bet->status == "blocked")
                            <span class="badge bg-warning me-1"></span> Blocked
                            @else
                            <span class="badge bg-success me-1"></span> Active
                            @endif
                          </td>
                          
                          
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-add" onclick="OpenAddMoneyPanel('{{$bet->id}}')">
                                  Add Fund
                                </a>
                                
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-withdraw" onclick="OpenAddMoneyPanel('{{$bet->id}}')">
                                  Withdraw Fund
                                </a>
                                
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-reset" onclick="OpenAddMoneyPanel('{{$bet->id}}')">
                                  Reset Password
                                </a>
                                @if($bet->status == "normal")
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-block" onclick="OpenBlockPanel('{{$bet->id}}')">
                                  Block User
                                </a>
                                @else
                                <a class="dropdown-item" href="unblock?id={{$bet->id}}">
                                  Unblock User
                                </a>
                                @endif
                                <a class="dropdown-item" href="forceLogout?id={{$bet->id}}">
                                  Force Logout
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

      function OpenAddMoneyPanel(token)
      {
        document.getElementById("moneyid").value = token;
        document.getElementById("password_n").value = token;
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