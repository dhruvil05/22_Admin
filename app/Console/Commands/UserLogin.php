<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $all = DB::table('admins')->get();
        foreach ($all as $item) {
            $email = $item->email;
            $password = $item->password;
            $date = get_formatted_date($item->created_at, "d-m-Y");
            $currentDate = date('d-m-Y');
            if ($date == $currentDate) {

                $mail_data = [
                    'email' => $email,
                    'password' => $password,
                ];
                Mail::send("admin.mail", $mail_data, function ($message) use ($mail_data) {
                    $message->from('dhruvil.patel23117@gmail.com');
                    $message->to($mail_data['email']);
                    $message->subject("Login Info");
                });
            }
            // print_r($currentDate);
        }
        $this->info("Login mail has been send successfully.");

        // $user = DB::table('admins')->get();
        // $mail_data = [
        //     'email'=> $user->email,
        //     'password'=> $user->password,
        // ];
        // foreach ($user as $mail_data) {
        //     $mail_data = [
        //         'email' => $user->email,
        //         'password' => $user->password,
        //     ];
        //     Mail::send("mail", $mail_data, function ($message) use ($mail_data) {
        //         $message->from('dhruvil.patel23117@gmail.com');
        //         $message->to($mail_data['email']);
        //         $message->subject("Login Info");
        //     });
        // }

        // $this->info("Login mail has been send successfully.");
        // return 0;
    }
}
