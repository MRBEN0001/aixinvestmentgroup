<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Account;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class createAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = 'admin@aix.top';

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'is_admin' => true,
                'username' => 'aix',
                'email' => $email,
                'password' => Hash::make('password@aix'),
            ]);
            Account::create([
                'user_id' => $user->id,
                'account_number' => generateUniqueAccountNumber(),
                'balance' => 0.00,
                'is_suspended' => false,
            ]);

            echo "Admin created successfully.";
        } else {
            echo "Admin already exists.";
        }
    }
}
