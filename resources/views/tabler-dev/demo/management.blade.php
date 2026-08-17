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
    <title>Database Manage</title>
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
      use App\Models\User;
      use App\Models\Gallary;
      use App\Models\Event;
      $users = User::select('*')->get();
      $events = Event::select('*')->get();
      $gallery = Gallary::select('*')->get();
      @endphp
      @include('tabler-dev.demo.SidePanel')
      
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Database Management
                </h2>
                <div class="text-secondary mt-1">Execute command directly</div>
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
          <div class="text-secondary mt-1">Delete any user directly (be cautious because once an user is deleted can not be restored)</div>
            <br>
            <form class="form-control" method="post" action="deleteUser">
                {{csrf_field()}}
                <div class="row">
                
                    <div class="col-lg-6">
                        <div class="mb-3">
                    <label class="form-label">Select user</label>
                <select name="token" class="form-control">
                    <option value="none">None</option>
                    @foreach($users as $usr)
                    <option value="{{$usr->id}}">Name: <strong>{{$usr->name}}</strong>  Type: <strong>{{$usr->type}}</strong></option>
                    @endforeach
                </select>
                </div>
                </div>
                <br>
                <div class="col-lg-6">
                <div class="mb-3">
                <label class="form-label">Transaction password</label>
                <input type="password" name="password" class="form-control" required >
                </div>
                </div>
                <br>
                <div class="col-lg-3">
                <div class="mb-3">
                <input type="submit" class="btn btn-info" value="Execute" >
                </div>
                </div>
                
                </div>
            </form>

            
            
            <div class="text-secondary mt-1">Delete table directly (be cautious because once a table is deleted can not be restored)</div>
            <br>
            <form class="form-control" method="post" action="deleteTable">
                {{csrf_field()}}
                <div class="row">
                
                    <div class="col-lg-6">
                        <div class="mb-3">
                    <label class="form-label">Table name</label>
                <select name="tableName" class="form-control">
                    <option value="none">None</option>
                    <option value="user">User</option>
                    <option value="transaction">Transaction</option>
                    <option value="bet">Bet Details</option>
                    <option value="current">Current Bet</option>
                    
                    <option value="all">All</option>
                </select>
                </div>
                </div>
                <br>
                <div class="col-lg-6">
                <div class="mb-3">
                <label class="form-label">Transaction password</label>
                <input type="password" name="password" class="form-control" required >
                </div>
                </div>
                <br>
                <div class="col-lg-3">
                <div class="mb-3">
                <input type="submit" class="btn btn-info" value="Execute" >
                </div>
                </div>
                
                </div>
            </form>
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
    
  </body>
</html>