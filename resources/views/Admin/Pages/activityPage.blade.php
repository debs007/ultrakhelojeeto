<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<?php
session_start();
?>
<?php
if(!isset($_SESSION['login']))
{
    header("Location:admin");
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{URL::asset('apple-icon.png');}}">
  <link rel="icon" type="image/png" href="{{URL::asset('img/favicon.png');}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Activity
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{URL::asset('css/material-dashboard.css?v=2.1.2');}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{URL::asset('css/demo.css');}}" rel="stylesheet" />

    <script>
        var count = 0;
        function Spawn() {
            var from = document.getElementById("BotForm");
            from.style.display = "block";
            
            from.innerHTML += "<div align='middle' id='" + count+"'> <input type='text' class='form-control validate' placeholder='Enter bot name' name = '" + ++count + "name' required /> <input class='btn btn-info' type='file' name='" + count + "picture' accept='image/png, image/gif, image/jpeg' required /></div></br></br > ";
        }

        function ShowBotTable() {
            var botTab = document.getElementById("botTable");
            if (botTab.style.display == "block") {
                botTab.style.display = "none";
            }
            else {
                botTab.style.display = "block";
            }
        }
    </script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{URL::asset('img/sidebar-1.jpg');}}">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="#" class="simple-text logo-normal">
          Star Casino
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users">
              <i class="material-icons">person</i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transaction">
              <i class="material-icons">library_books</i>
              <p>Transactions</p>
            </a>
          </li>
            <li class="nav-item active">
            <a class="nav-link" href="#">
              <i class="material-icons">bubble_chart</i>
              <p>Activity</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="match">
              <i class="material-icons">content_paste</i>
              <p>Matches</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Activity panel</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="dashboard">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Welcome to ludo admin panel</a>
                  <a class="dropdown-item" href="#">You have only two route available</a>
                  <a class="dropdown-item" href="#">Click on profile button to get few more options</a>
                  <a class="dropdown-item" href="#">You only have logout option available</a>
                  <a class="dropdown-item" href="#">Thats it! thanks from M.S Work consultancy</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Token management</h4>
                  <p class="card-category"> Manage tokens from here </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>
                          SN
                        </th>
                        <th>
                          Value
                        </th>
                        <th>
                          Name
                        </th>                      
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        <?php
                              use App\Models\Token;
                              use App\Models\User;
                              use App\Models\Upiset;
                              use App\Models\Version;
                              use App\Models\Number;

                              $data = Token::select("*")->get();
                              $upi = Upiset::where('id',1)->first();
                              $version = Version::where('SN',1)->first();
                              $last = Number::select("*")->orderBy("created_at","desc")->first();
                              foreach($data as $token)
                              {
                                  if($token->status == 0)
                                  {
                                      echo("<tr><td>".$token->SN."</td><td>".$token->value."</td><td>".$token->name."</td><td>
  <a href='activate?id=".$token->SN."' class='btn btn-danger btn-rounded mb-4'>Disable</a>
</td></tr>");
                                  }
                                  else
                                  {
                                  echo("<tr><td>".$token->SN."</td><td>".$token->value."</td><td>".$token->name."</td><td>
  <a href='activate?id=".$token->SN."' class='btn btn-warning btn-rounded mb-4'>Enable</a>
</td></tr>");
                                  }
                              }

                              ?>
                      </tbody>
                    </table>
                  </div>
                  <div>
                    <p>Current running UPI Address : @if($upi) {{$upi->upi}} @endif</p>
                    <form method="post" action="updateUpi">
                    {{ csrf_field() }}
                    <input type="text" name="upi" class="form-control validate" placeholder="Enter new upi address" />
                    <button type="submit" class="btn btn-success">Update UPI</button>
                    </form>
                  </div>
                  <div>
                    <p>Current running version : {{$version->currentVersion}}</p>
                    <form method="post" action="updateVersion">
                    {{ csrf_field() }}
                    <input type="text" name="version" class="form-control validate" placeholder="Enter new version address" />
                    <button type="submit" class="btn btn-success">Update Version</button>
                    </form>
                  </div>
                    <br /><br />
                    
                    <div>
                    <a href="updateWithdraw" class="btn btn-success">Update Withdraw (Latest Ludo 1M)</a>
                    </div>
                    <br /><br />
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Number management</h4>
                        <p class="card-category"> Current running number : {{$last->number}} </p>
                    </div>
                    <br />
                    <form method="post" action="setLast">
                    {{ csrf_field() }}
                    <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Set a winning number from 0 to 9</label>
          <input type="number" name="number" id="orangeForm-name" class="form-control validate" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="1" value="" required>
          
        </div>  

        <div allign="center">
                            <input type="submit" class="btn btn-success" value="Set Win Number" />
                        </div>

                    </form>
                    <br/><br/>
                    <!--Goes here-->
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Spin management</h4>
                        <p class="card-category"> Set spin values from here from here </p>
                    </div>
                    <br /><br/>
                      <div class="table-responsive">
                    <form method="post" action="updateSpin">
            {{ csrf_field() }}

                         <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Set spin 1</label>
          <input type="number" name="one" id="orangeForm-name" class="form-control validate" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="" required>
          
        </div>
                        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Set spin 2</label>
          <input type="number" name="two" id="orangeForm-name" class="form-control validate" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength=2 value="" required>
          
        </div>
                        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Set spin 3</label>
          <input type="number" name="three" id="orangeForm-name" class="form-control validate" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="" required>
          
        </div>
                        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Set spin 4</label>
          <input type="number" name="four" id="orangeForm-name" class="form-control validate" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="" required>
          
        </div>
                        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Set spin 5</label>
          <input type="number" name="five" id="orangeForm-name" class="form-control validate" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="" required>
          
        </div>
                        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Set spin 6</label>
          <input type="number" name="six" id="orangeForm-name" class="form-control validate" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="" required>
          
        </div>
                        <div allign="center">
                            <input type="submit" class="btn btn-success" value="Save" />
                        </div>
                        </form>
                  </div>
                </div>
                  </br></br>
                  <div align="right"><button class="btn btn-info" onclick="Spawn()">+ ADD BOT</button></div>
                  <form style="display:none;" enctype="multipart/form-data" id="BotForm" method="post" action="addbots">
                      {{csrf_field()}}
                      <div align="right"><input type="submit" class="btn btn-success" value="SAVE BOTS" /></div>
                  </form>
                  <!--Bots-->
                  <div class="card card-plain">
                  <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Bot management</h4>
                      
                  <p class="card-category"> Manage bots from here </p>
                </div>
                      <div align="right" style="display:inline-block;"><button class="btn btn-info" onclick="ShowBotTable()">Show/Hide</button></div>
                  <div class="card-body">
                  <div class="table-responsive" id="botTable" style="display:none;">
                    <table class="table table-hover">
                      <thead class="">
                        <th>
                          ID
                        </th>
                        <th>
                          User name
                        </th>
                        <th>
                          Profile path
                        </th>                      
                        <th>
                          Status
                        </th>
                        
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        <?php
                              
                              use App\Models\Bot;

                              $allRequests = Bot::select('*')->orderBy('id','desc')->get();
                              
                              foreach($allRequests as $pay)
                              {
                                  if($pay->status == 0){
                                      echo("<tr><td>".$pay->id."</td><td>".$pay->userName."</td><td>".$pay->profilePic."</td><td>Active</td><td><a href='#?id=".$pay->id."' class='btn btn-info btn-rounded mb-4'>Change</a>
</td></tr>");
                                  }
                                  else
                                  {
                                       echo("<tr><td>".$pay->id."</td><td>".$pay->userName."</td><td>".$pay->profilePic."</td><td>Deactivated</td><td><a href='#?id=".$pay->id."' class='btn btn-info btn-rounded mb-4'>Change</a>
</td></tr>");
                                  }
                                  
                                  
                              }

                              ?>
                      </tbody>
                    </table>
                      </div></div>
                </div>
                  
                  <!--EndBots-->
                      
                  </br></br>
              </div>
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Payment requests</h4>
                  <p class="card-category"> All withdraw requests are shown</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>
                          SN
                        </th>
                        <th>
                          User name
                        </th>
                        <th>
                          Name
                        </th> 
                        <th>
                          Phone
                        </th>                      
                        <th>
                          Amount
                        </th>
                        
                        <th>
                          Date
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        <?php
                              use App\Models\Paymentrequest;
                              use App\Models\Bankdetail;
                              use App\Models\Vpa;

                              $allRequests = Paymentrequest::select('*')->orderBy('date','desc')->get();
                              
                              foreach($allRequests as $pay)
                              {
                                  $usr = User::where('id',$pay->userId)->first();
                                  
                                  $bankDetails = Bankdetail::where('userId',$pay->userId)->first();
                                  $upi = Vpa::where('userId',$pay->userId)->first();
                                  
                                  if($usr)
                                  {
                                    if($pay->status == 0){



                                      echo("<tr><td>".$pay->SN."</td><td>".$usr->userName."</td><td>".$usr->name."</td><td>".$usr->phone."</td><td>".$pay->amount."</td><td>".$pay->date."</td><td><a href='acceptPayment?id=".$pay->SN."' class='btn btn-success btn-rounded mb-4'>Approve</a><a href='rejectPayment?id=".$pay->SN."' class='btn btn-danger btn-rounded mb-4'>Decline</a></td></tr>");
                                      }
                                      else if($pay->status == 1)
                                      {
                                          echo("<tr><td>".$pay->SN."</td><td>".$usr->userName."</td><td>".$usr->name."</td><td>".$usr->phone."</td><td>".$pay->amount."</td><td>".$pay->date."</td><td>Approved</td><td><a href='rejectPayment?id=".$pay->SN."' class='btn btn-info btn-rounded mb-4'>Revert Amount</a></td></tr>");
                                      }
                                      else
                                      {
                                          echo("<tr><td>".$pay->SN."</td><td>".$usr->userName."</td><td>".$usr->name."</td><td>".$usr->phone."</td><td>".$pay->amount."</td><td>".$pay->date."</td><td>Declined</td></tr>");
                                      }
                                  }
                                  
                                

                                
                              }

                              ?>
                      </tbody>
                    </table>
                      </div></div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="#">
                  M.s Work Consultancy
                </a>
              </li>
              <li>
                <a href="#">
                  About Us
                </a>
              </li>
              <li>
                <a href="#">
                  Blog
                </a>
              </li>
              <li>
                <a href="#">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="#" target="_blank">M.s work consultancy</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Filters</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger active-color">
            <div class="badge-colors ml-auto mr-auto">
              <span class="badge filter badge-purple" data-color="purple"></span>
              <span class="badge filter badge-azure" data-color="azure"></span>
              <span class="badge filter badge-green" data-color="green"></span>
              <span class="badge filter badge-warning" data-color="orange"></span>
              <span class="badge filter badge-danger" data-color="danger"></span>
              <span class="badge filter badge-rose active" data-color="rose"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="header-title">Images</li>
        <li class="active">
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="{{URL::asset('img/sidebar-1.jpg')}}" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="{{URL::asset('img/sidebar-2.jpg')}}" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="{{URL::asset('img/sidebar-3.jpg')}}" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="{{URL::asset('img/sidebar-4.jpg')}}" alt="">
          </a>
        </li>
        <li class="button-container">
          <a href="#" target="_blank" class="btn btn-primary btn-block">Image panel</a>
        </li>
        <!-- <li class="header-title">Want more components?</li>
            <li class="button-container">
                <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">
                  Get the pro version
                </a>
            </li> -->
        <li class="button-container">
          <a href="#" target="_blank" class="btn btn-default btn-block">
            View Documentation
          </a>
        </li>
        
        <li class="header-title">Thank you for choosing us</li>
        <li class="button-container text-center">
          <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
          <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
          <br>
          <br>
        </li>
      </ul>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{URL::asset('js/jquery.min.js')}}"></script>
  <script src="{{URL::asset('js/popper.min.js')}}"></script>
  <script src="{{URL::asset('js/bootstrap-material-design.min.js')}}"></script>
  <script src="{{URL::asset('js/perfect-scrollbar.jquery.min.js')}}"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{URL::asset('js/moment.min.js')}}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{URL::asset('js/sweetalert2.js')}}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{URL::asset('js/jquery.validate.min.js')}}"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{URL::asset('js/jquery.bootstrap-wizard.js')}}"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{URL::asset('js/bootstrap-selectpicker.js')}}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{URL::asset('js/bootstrap-datetimepicker.min.js')}}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{URL::asset('js/jquery.dataTables.min.js')}}"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{URL::asset('js/bootstrap-tagsinput.js')}}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{URL::asset('js/jasny-bootstrap.min.js')}}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{URL::asset('js/fullcalendar.min.js')}}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{URL::asset('js/jquery-jvectormap.js')}}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{URL::asset('js/nouislider.min.js')}}"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{URL::asset('js/arrive.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="{{URL::asset('js/chartist.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{URL::asset('js/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{URL::asset('js/material-dashboard.js?v=2.1.2')}}" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{URL::asset('js/demo.js')}}"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
</body>

</html>
