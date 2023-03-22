<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Book;

class SendFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/books';
            $request-> file('photo') ->move($path,$file_name);
            // $add->photo  = $file_nameone;
        }else{
            // $add->photo  = "profile_image.png"; 
        }
         $add= new Book;
        $add->photo  = "hamada.jpggg";
        $add->save();

        // Mail::to('hamadaali221133@gmail.com')->send(new TestMailable('ygyjgbjhjg'));

    }
}
