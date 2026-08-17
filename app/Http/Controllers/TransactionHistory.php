<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class TransactionHistory extends Controller
{
    function setTransaction(Request $request)
    {
       //die("Checked");
     $set =  Transaction::insert([

       'id'=>$request->id,
       'amount'=>$request->amount,
       'type'=>$request->type,
       'bountyRemain'=>User::where('id',$request->id)->first()->bounty,
       'winBountyRemain'=>User::where('id',$request->id)->first()->winBounty
]);

        if($set)
        {
            return true;
        }

        return false;
    }

}
