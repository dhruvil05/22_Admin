<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;

class UserLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = Admin::all();
        foreach ($user as $all) {
            Mail::raw("This is automatically generated Mail", function ($message) use ($all) {
                $message->from('softsales07@gmail.com'); 
                $message->to($all->email);
                $message->subject("Login Info");
            });
        }

        $this->info("Login mail has been send successfully.");
        // return 0;
    }
}
