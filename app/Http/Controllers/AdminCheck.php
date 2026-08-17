<?php

namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use App\Models\Admindetail;

class AdminCheck extends Controller
{
    function CheckAdmin(Request $request)
    {
        $data = Admindetail::where("username",$request->username)->first();

        if($data)
        {
            if($request->password == $data->password)
            {
                if($request->username == "special" || true){
                $_SESSION["login"] = $request->username;
                header("Location:dashboard");
                }
                else
                {
                    header("Location:servicedown");
                }
            }
            else
            {
                header("Location:admin?type=Invalid%20password");
            }
        }
        else
        {
            header("Location:admin?type=Invalid%20user%20name");
        }
    }
}
