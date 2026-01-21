<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin 
                            {email? : The email of the admin user} 
                            {password? : The password of the admin user} 
                            {--first_name=Admin : The first name} 
                            {--last_name=User : The last name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? $this->ask('Email Address');
        $password = $this->argument('password') ?? $this->secret('Password');
        $firstName = $this->option('first_name');
        $lastName = $this->option('last_name');

        if (User::where('email', $email)->exists()) {
            $this->error("User with email {$email} already exists.");
            return 1;
        }

        $user = new User();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $email;
        $user->password_hash = Hash::make($password);
        $user->role = 'admin';
        $user->save();

        $this->info("Admin user {$email} created successfully.");
        return 0;
    }
}
