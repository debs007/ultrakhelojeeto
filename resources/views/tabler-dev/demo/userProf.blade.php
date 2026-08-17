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
  
    <script src="./dist/js/demo-theme.min.js?1685973381"></script>
    <div class="page">
      <!-- Navbar -->
      
      @include('tabler-dev.demo.SidePanel')
      @include('tabler-dev.demo.useraddmodal')

      
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Profession Searches
                </h2>
               
              </div>
              <!-- Page title actions -->
              
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
        
          <div class="container-xl">
            <div class="row row-cards" id="allUsers">
              
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
    
// Send a request

   


    document.addEventListener("DOMContentLoaded", function (){
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const profession = urlParams.get('prof');
		

        if(profession.trim() != "")
        {
            const xhttp = new XMLHttpRequest();

// Define a callback function
                xhttp.onreadystatechange  = function() {
                if (this.readyState == 4 && this.status == 200){
                    const responses = JSON.parse(this.responseText);
                    document.getElementById("allUsers").innerHTML = "";
                    responses.response_data.forEach(element => {

                    console.log("Preparing for "+element.name);
                    document.getElementById("allUsers").innerHTML += '<div class="col-md-6 col-lg-3">'+'<div class="card">'+'<div class="card-body p-4 text-center">'+'<span class="avatar avatar-xl mb-3 rounded" style="background-image: url('+element.profilePicture+')"></span>'+'<h3 class="m-0 mb-1"><a href="profile?token='+element.token+'">'+element.name+'</a></h3>'+'<div class="text-secondary">'+((element.profession == null)?' Profession : N/A' : 'Profession : '+ element.profession) +'</div>'+'<div class="mt-3">'+'<span class="badge bg-purple-lt">'+((element.designation != "vice president")? element.designation : ' Treasurer </span>')+'</div></div>'+'<div class="d-flex">'+((element.status != "member")?'<a href="renew?token='+element.token+'" class="card-btn"><img src="images/member-card.png" style="height: 20px width:20px;"> &nbsp;Renew</a>':'<a href="#" class="card-btn"><img src="images/ok.png" style="height: 20px; width:20px;"> &nbsp;Active</a>'+'<a href="revoke?token='+element.token+'" class="card-btn"><img src="images/block.png" style="height: 20px; width:20px"> &nbsp;')+'Inactive</a></div></div></div>';});
                    }
                        // Perform desired actions here
                    }

                    document.getElementById("allUsers").innerHTML = "Searching member......";
                xhttp.open("GET",  "searchUser?search="+encodeURIComponent(profession) );
                xhttp.send();
      
        }
    });



    </script>
  </body>
</html>