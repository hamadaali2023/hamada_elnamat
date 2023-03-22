<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\View;
use Carbon\Carbon;
use DateTime;
class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire users every 5 minute ';

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
        // $users = User::where('expire',0)->get();
        // foreach ($users as $user) {
        //     $user->expire  = 1;
        //     $user->save();
        // }


         $add_video = new View;
                $add_video->userId  = 1;
                $add_video->videoId = 1;
                $add_video->watchtime =1;
                $add_video->save(); 

        // if(session('videos_watch_sessions')){
        //     $videos=session()->get('videos_watch_sessions');
        //     $items=[];
        //     foreach($videos as $id => $_item){
        //         $cars = array("userid"=>$_item['userid'],
        //                       "videoid"=>$_item['videoid'],
        //                       "watchtime"=>$_item['watchtime']);
        //         $items[]= $cars;
        //     }
        //     foreach($items as $i => $item){    
        //         $add_video = new View;
        //         $add_video->userId  = $item['userid'];
        //         $add_video->videoId = $item['videoid'];
        //         $add_video->watchtime = $item['watchtime'];
        //         $add_video->save(); 
        //     }
        // }
    }
}
