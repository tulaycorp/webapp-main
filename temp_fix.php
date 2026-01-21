<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

echo "START_SCRIPT\n";

try {
    if (!Schema::hasTable('users')) {
        echo "ERROR: Users table missing!\n";
    } else {
        $email = 'admin@example.com';
        $user = User::where('email', $email)->first();

        if (!$user) {
            echo "User $email not found. Creating...\n";
            $user = new User();
            $user->email = $email;
            $user->first_name = 'Admin';
            $user->last_name = 'Example';
            $user->role = 'admin';
            // Add other required fields if strict mode is on or no defaults
             $user->password_hash = Hash::make('password'); // Set initial hash
             $user->save();
             echo "User created.\n";
        } else {
            echo "User $email found.\n";
            $user->password_hash = Hash::make('password');
            $user->save();
            echo "Password updated.\n";
        }
        
        // Double check
        $check = User::where('email', $email)->first();
        echo "VERIFY: User ID: " . $check->id . " | Hash starts with: " . substr($check->password_hash, 0, 10) . "...\n";
    }
} catch (\Exception $e) {
    echo "EXCEPTION: " . $e->getMessage() . "\n";
}

echo "END_SCRIPT\n";
