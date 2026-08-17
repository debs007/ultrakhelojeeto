<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class CheckMembership extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where("status","member")->get();

        foreach($users as $user)
        {
            if($user->membership != null)
            {
                $newDate = date('Y-m-d',strtotime($user->membership .' + 1 year'));
                if($newDate < Carbon::now())
                {
                    User::where('id',$user->id)->update(["status"=>"expired"]);
                }
            }
        }

        return 0;
    }
}
