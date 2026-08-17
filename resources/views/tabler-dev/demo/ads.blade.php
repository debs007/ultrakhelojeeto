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
    <title>Advertisement</title>
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
      use App\Models\Ad;
      use App\Models\User;
      use Carbon\Carbon;
      $allUsers = Ad::select('*')->orderBy('orderId','asc')->get();
      $user = User::where('status','member')->get();
      
      $formCount = 0;
      @endphp
      @include('tabler-dev.demo.SidePanel')
      @include('tabler-dev.demo.adsmodal')
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Advertisements
                </h2>
                <div class="text-secondary mt-1">Ads {{count($allUsers)}}</div>
              </div>
              
              <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                  <!-- <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…"/> -->
                  <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-ads">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Create new ad
                  </a>
                </div>
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
              @foreach($allUsers as $au)
              
              @php
                $ev = User::where('id',$au->userId)->first();
                
                @endphp
                <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                  <a href="#" class="d-block"><img src="{{$au->imageUri}}" class="card-img-top" style="height: 211px;"></a>
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <span class="avatar me-3 rounded" style="background-image: url('{{$ev->profilePicture}}')"></span>
                      <div>
                        <div>{{$ev->name}}</div>
                        <div class="text-secondary">Created at : {{explode(' ',$au->created_at)[0]}}</div>
                        <div class="text-secondary">Link : {{$au->link}}</div><div class="text-secondary">Phone : {{$au->phone}}</div>
                        <div class="text-secondary">Email : {{$au->email}}</div>
                        <div class="text-secondary">
                        
                        <form action="{{route('webconnect.sortAd')}}" method="post" id="form{{++$formCount}}">
                          {{csrf_field()}}
                          <input type="hidden" name="id" value="{{$au->id}}" />
                          Sort order : 
                        <select name="order" onchange="submitForm('form{{$formCount}}')">    
                        @foreach($allUsers as $ai)
                            
                                @if($ai->orderId == $au->orderId)
                                <option value="{{$ai->orderId}}" selected>{{$ai->orderId}}</option>
                                @else
                                <option value="{{$ai->orderId}}">{{$ai->orderId}}</option>
                                @endif
                            
                            @endforeach
                            </select>
                            </form>
                        </div>
                      </div>
                      <div class="ms-auto">
                        <a href="removeAd?id={{$au->id}}" class="text-secondary">
                          <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                          <img src="images/dlt.png" style="height: 20px; width:20px;">
                        </a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
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
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
    	var el;
    	window.TomSelect && (new TomSelect(el = document.getElementById('select-people'), {
    		copyClassesToDropdown: false,
    		dropdownParent: 'p',
    		controlInput: '<input disabled>',
        
    		render:{
    			item: function(data,escape) {
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    			option: function(data,escape){
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    		},
    	}));
    });
    // @formatter:on

    function submitForm(data)
    {
      document.getElementById(data).submit();
    }
  </script>
  </body>
</html>