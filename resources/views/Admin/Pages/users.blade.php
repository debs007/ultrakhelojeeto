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
    User track
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <!-- CSS Files -->
  <link href="{{URL::asset('css/material-dashboard.css?v=2.1.2');}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{URL::asset('css/demo.css');}}" rel="stylesheet" />

    <script>
        var tableData;

        function getTabledataOnload() {
            tableData = document.getElementById('userTable').innerHTML;
        }
        function blockUser(id) {
            //window.location('block?id=' + id);
            document.getElementById('orangeForm-name').value = id;
            document.getElementById('userIdAdd').value = id;
        }

        function unblockUser(id) {
            //console.log('data is' + id);
            //window.location ='https://gamersgram.worksamples.info/unblock?id' + id;
        }

        function checkEmpty() {
            var val = document.getElementById('search').value;
            if (val == "") {
                searchUser();
            }
        }

        function searchUser() {

            var val = document.getElementById('search').value;
            var check = document.getElementById(val);
            var table = document.getElementById('userTable');

            console.log("Searching for "+val);
            // if (check == null) {
            //     console.log("Should reset table");

            //     table.innerHTML = tableData;
            //     return;
            // }


            const xhttpr = new XMLHttpRequest(); 
xhttpr.open('GET', 'searchUser?ph='+val, true); 
  
xhttpr.send(); 
  
xhttpr.onload = ()=> { 
  if (xhttpr.status === 200) { 
      //const response = JSON.parse(xhttpr.response); 
      // Process the response data here 
      
            var row = xhttpr.response;
            console.log("Should search");
            table.innerHTML = "";
            
            table.innerHTML = "<tr>" + row+"</tr>";

  } else { 
      // Handle error 
  } 
}; 


           


        }
    </script>
</head>

<body class="" onload="getTabledataOnload()">
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Block panel</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="post" action="block">
            {{ csrf_field() }}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          
          <input type="text" name="id" id="orangeForm-name" class="form-control validate" value="" readonly>
          <label data-error="wrong" data-success="right" for="orangeForm-name">User id</label>
        </div>
        <div class="md-form mb-5">
          
          <!--input type="text" name="activity" id="orangeForm-email" class="form-control validate"-->
            <select class="form-select" aria-label="Default select example" name="activity">
  <option value="Suspicious" selected>Suspicious</option>
  <option value="Ransom">Double crossing</option>
  <option value="Treachery">Cheating</option>
  <option value="Hacking">Hacking</option>
</select>
          <label data-error="wrong" data-success="right" for="orangeForm-email">Activities</label>
        </div>

        <div class="md-form mb-4">
          
          <input type="text" name="reason" value="No reason" id="orangeForm-pass" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Reason</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
       <input type="submit" class="btn btn-deep-orange" value="Block" />
      </div>
            </form>
    </div>
  </div>
</div>
@include('Admin.Pages.addmoney');
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
          <li class="nav-item active ">
            <a class="nav-link" href="#">
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

            <li class="nav-item">
            <a class="nav-link" href="activity">
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
            <a class="navbar-brand" href="javascript:;">User records</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            
              <div class="input-group no-border">
                <input type="text" onkeyup="checkEmpty()" id="search" value="" class="form-control" placeholder="Search...">
                <button onclick="searchUser()" class="btn btn-round btn-white btn-just-icon" style="border-radius:50%;">
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
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">User records</h4>
                  <p class="card-category"> User data from users table</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                      <table class="table">
                          <thead class=" text-primary">
                          <th>
                              ID
                          </th>
                          <th>
                              Name
                          </th>
                          <th>
                              User name
                          </th>
                          <th>
                              Email
                          </th>
                          <th>
                              Phone
                          </th>
                          <th>
                              Created at
                          </th>
                          <th>
                              Last login
                          </th>
                          <th>
                              Wallet
                          </th>
                          <th>
                              Refferal
                          </th>
                          <th>
                              Online
                          </th>
                          <th>
                              Matches
                          </th>
                          <th>
                             Wins
                          </th>
                          <th>
                             Influenced
                          </th>
                          <th>
                             Total Invested
                          </th>
                          <th>
                             Winnings
                          </th>
                          <th>
                             Total Withdrawn
                          </th>
                          <th>
                              Action
                          </th>
                          </thead>
                          <tbody id="userTable">
                              
                              <?php
                              use App\Models\User;
                              use App\Models\Payment;
                              use App\Models\Paymentrequest;
        
                              $data = User::select("*")->orderBy('createdAt','desc')->limit(800)->get();

                              foreach($data as $user)
                              {

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

                                  if($user->isBlocked == 0){
                                  echo("<tr id='".$user->phone."'><td>".$user->id."</td><td>".$user->name."</td><td>".$user->userName."</td><td>".$user->email."</td><td>".$user->phone."</td><td>".$user->createdAt."</td><td>".$user->lastLogin."</td><td>".$user->bounty."</td><td>".$user->referal."</td><td>".$online."</td><td>".$user->totalMatch."</td><td>".$user->totalWon."</td><td>".$user->refferd."</td><td>".$allPayments."</td><td>".$user->winBounty."</td><td>".$allWithdrawn."</td><td><div class='text-center'>
  <a href='' class='btn btn-warning btn-rounded mb-4' data-toggle='modal' data-target='#modalRegisterForm' onclick='blockUser(".$user->id.")'>Block</a> <a href='' class='btn btn-success btn-rounded mb-4' data-toggle='modal' data-target='#modalAddmoney' onclick='blockUser(".$user->id.")'>Add Money</a>  <a href='' class='btn btn-success btn-rounded mb-4' data-toggle='modal' data-target='#modalAddmoneyWithdraw' onclick='blockUser(".$user->id.")'>Add Money Winnings</a>
</div>");
                                  
                                  }
                                  else
                                  {
                                      echo("<tr id='".$user->phone."'><td>".$user->id."</td><td>".$user->name."</td><td>".$user->userName."</td><td>".$user->email."</td><td>".$user->phone."</td><td>".$user->createdAt."</td><td>".$user->lastLogin."</td><td>".$user->bounty."</td><td>".$user->referal."</td><td>".$online."</td><td>".$user->totalMatch."</td><td>".$user->totalWon."</td><td>".$user->refferd."</td><td>".$allPayments."</td><td>".$user->winBounty."</td><td>".$allWithdrawn."</td><td><div class='text-center'>
  <a href='unblock?id=".$user->id."' class='btn btn-danger btn-rounded mb-4'>Unblock</a>
</div>");
                                  }

                                  if($user->isInfluencer == 0)
                                  {
                                      echo("<div class='text-center'>
  <a href='promote?id=".$user->id."' class='btn btn-info btn-rounded mb-4'>Promote</a>
</div></td></tr>");
                                  }
                                  else
                                  {
                                      echo("<div class='text-center'>
  <a href='demote?id=".$user->id."' class='btn btn-danger btn-rounded mb-4'>Demote</a>
</div></td></tr>");
                                  }
                              }

                              ?>
                          </tbody>
                      </table>
                  </div>
                </div>
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
