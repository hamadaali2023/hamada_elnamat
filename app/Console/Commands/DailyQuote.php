<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

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
        if(session('videos_watch_sessions')){
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
        }
    }
}
