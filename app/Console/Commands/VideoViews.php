<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\View;

class VideoViews extends Command
{
    
    protected $signature = 'videoviews:expire';

    protected $description = 'expire users every 5 minute ';

    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    { 
        // $add_video = new View;
        //         $add_video->userId  = 1;
        //         $add_video->videoId = 1;
        //         $add_video->watchtime =1;
        //         $add_video->save(); 

        // if(session('videos_watch_sessions')){
            $videos=session()->get('videos_watch_sessions');
            $items=[];
            foreach($videos as $id => $_item){
                $cars = array("userid"=>$_item['userid'],
                              "videoid"=>$_item['videoid'],
                              "watchtime"=>$_item['watchtime']);
                $items[]= $cars;
            }
            foreach($items as $i => $item){    
                $add_video = new View;
                $add_video->userId  = $item['userid'];
                $add_video->videoId = $item['videoid'];
                $add_video->watchtime = $item['watchtime'];
                $add_video->save(); 
            }
        // }
    }
}
// https://www.positronx.io/laravel-cron-job-task-scheduling-tutorial-with-example/