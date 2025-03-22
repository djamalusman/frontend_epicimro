<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendRegistrationEmail;

class SendQueuedEmails extends Command
{
    protected $signature = 'emails:send'; // Nama perintah untuk cronjob
    protected $description = 'Mengirim email pendaftaran yang tertunda';

    public function handle()
    {
        // Ambil daftar user yang perlu dikirim email (misalnya yang baru terdaftar)
        $users = User::where('comfir_email', null)->get();
        foreach ($users as $user) {
            if ($user->status_email != 1 && $user->status_email != 2) {
                dispatch(new SendRegistrationEmail($user, 'password_default'));

            }
            
        }

        $this->info('Semua email telah dikirim.');
    }
}
