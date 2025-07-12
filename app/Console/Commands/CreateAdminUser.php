<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin-user';

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
        $name = $this->ask('Name');
        
        // Loop until a unique email is provided
        do {
            $email = $this->ask('Email');
            
            // Check if email already exists
            if (User::where('email', $email)->exists()) {
                $this->error("Error: Email '{$email}' already exists in the system.");
                $this->info('Please use a different email address.');
                $this->newLine();
            }
        } while (User::where('email', $email)->exists());
        
        $password = $this->secret('Password');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        $this->info('Admin user created successfully.');
        $this->info("Name: {$name}");
        $this->info("Email: {$email}");
        
        return 0; // Return success code
    }
}
