<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    

    <!-- Title Page-->
    <title>Todapple register</title>

    <!-- Icons font CSS-->
    <link href="{{URL::asset('vendor/mdi-font/css/material-design-iconic-font.min.css');}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('vendor/font-awesome-4.7/css/font-awesome.min.css');}}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{URL::asset('vendor/select2/select2.min.css');}}" rel="stylesheet" media="all">
    <link href="{{URL::asset('vendor/datepicker/daterangepicker.css');}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{URL::asset('css/main.css');}}" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

    <script src=
"https://code.jquery.com/jquery-3.5.0.js">
    </script>
    <script>
        var Otpverified = false;
    // When DOM is loaded this 
    // function will get executed
    $(() => {
        // function will get executed 
        // on click of submit button
        $("#submitButton").click(function (ev) {
            $("#success").css("display", "none");
            $("#failed").css("display", "none");
            $("#submitButton").prop("disabled", true);
            $("#submitButton").html("Processing...");
             
            var form = $("#formId");
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                      
                    // Ajax call completed successfully
                    //alert(data.responseJSON.response_msg);

                   
                    $("#success").css("display", "block");
                    $("#success").html("Account created successfully! click download below to download the application <br/><br/><a class='btn btn-primary' href='https://www.gamersgram.com'>Download</a>");
                    $("#submitButton").prop("disabled", false);
                    $("#submitButton").html("Submit");
                    Otpverified = false;
                    console.log(data);
                },
                error: function(data) {
                      
                    // Some error in ajax call
                    //alert(data.responseJSON.response_msg);
                    $("#failed").css("display", "block");
                    $("#failed").html(data.responseJSON.response_msg);
                    $("#submitButton").prop("disabled", false);
                    $("#submitButton").html("Submit");
                    Otpverified = false;
                    console.log(data);
                }
            });
        });
    });

        function sentOtp() {
            var phone = document.getElementById("phone").value;
            console.log("callin otp");
            var url = "https://www.fast2sms.com/dev/bulkV2?authorization=OH9nQ1jhrWXJpug6k0fmRLFdIUeP8Azx2iDNc5BMY4GtCqvaywCxwEDZB03jFRXWQyMmdToHkUzeVu6f&variables_values=your%20otp%20is%205998&route=otp&numbers=8420489525";
            var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     //document.getElementById("demo").innerHTML = this.responseText;
        console.log("opeing modal");
        OpenModal();
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
        }
        var modal = document.getElementById("myModal");
        var span = document.getElementById("close");
        span.onclick = function() {
  modal.style.display = "none";
        }

        window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
        function OpenModal() {
            // Get the modal
            console.log("modal opened");


// Get the button that opens the modal


// Get the <span> element that closes the modal


// When the user clicks the button, open the modal 

  modal.style.display = "block";


// When the user clicks on <span> (x), close the modal


// When the user clicks anywhere outside of the modal, close it

        }
    </script>

</head>

<body>
    <!--modal-->
    <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="close">&times;</span>
    <input type="text" class="input--style-4" placeholder="Enter otp" />
  </div>

</div>
    <!--modal end-->

    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <div class="row row-space">
                        <div class="col-6">
                            <br/><br/>
                            <h2 class="title">Sign up</h2>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <img src="{{URL::asset('img/gglogo.png');}}" height="100" width="120" />
                        </div>
                    </div>
                    <br/>
                    <form method="POST" action="registerWeb" id="formId">
                        {{ csrf_field() }}
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">Full name</label>
                                    <input class="input--style-4" type="text" name="name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="text" name="email" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">User name</label>
                                    <input class="input--style-4" type="text" name="username" required>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" id="phone" type="number" name="phone" maxlength="10" required>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                             <div class="col-sm-12">
                                <div class="input-group">
                                    <label class="label">Reffered By</label>
                                    <input class="input--style-4" value="{{$refer}}" type="email" name="refferd" readonly required>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" value="yes" name="hiddenVal"/>
                        
                        <div class="p-t-15">
                            <button class="btn btn-primary" type="button" id="submitButton">Submit</button>
                        </div>
                    </form>
                    <br/>
                    <div class="alert alert-success" role="alert" id="success" style="display:none;">
  
</div>
<div class="alert alert-danger" role="alert" id="failed" style="display:none;">
  
</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{URL::asset('vendor/jquery/jquery.min.js');}}"></script>
    <!-- Vendor JS-->
    <script src="{{URL::asset('vendor/select2/select2.min.js');}}"></script>
    <script src="{{URL::asset('vendor/datepicker/moment.min.js');}}"></script>
    <script src="{{URL::asset('vendor/datepicker/daterangepicker.js');}}"></script>

    <!-- Main JS-->
    <script src="{{URL::asset('js/global.js');}}"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
