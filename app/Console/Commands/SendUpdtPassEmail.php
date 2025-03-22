<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendUpdtPassEmail extends Command
{
    protected $signature = 'emails:reset-password {email}';
    protected $description = 'Mengirim email reset password ke pengguna';

    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("User dengan email {$email} tidak ditemukan.");
            return;
        }
        if ($user->status_email == 2) {
            $status =  dispatch(new SendPasswordResetEmail($user, $token));
            if ($status === Password::RESET_LINK_SENT) {
                $this->info("Email reset password telah dikirim ke {$email}.");
            } else {
                $this->error("Gagal mengirim email reset password.");
            }
        }

        
       
    }
}