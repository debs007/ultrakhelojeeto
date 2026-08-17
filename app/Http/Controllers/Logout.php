<?php

namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;

class Logout extends Controller
{
    function getOut()
    {
        session_unset();
        session_destroy();
        header("Location:admin");
    }
}
