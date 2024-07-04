<?php

// app/Console/Commands/UpdateUserPasswords.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user passwords to use Bcrypt hashing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Skip if the password is already hashed
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
                $user->save();
            }
        }

        $this->info('User passwords updated successfully.');

        return 0;
    }
}
