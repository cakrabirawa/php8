<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GenerateStoreUsers extends Command
{
    protected $signature = 'stores:generate-users';
    protected $description = 'Generate missing user accounts for stores';

    public function handle()
    {
        $stores = Store::whereDoesntHave('user')->get();

        if ($stores->isEmpty()) {
            $this->info('All stores already have user accounts.');
            return;
        }

        foreach ($stores as $store) {

            $email = strtolower(str_replace(' ', '',$store->id));

            if (User::where('email', $email)->exists()) {
                $email = $store->id . '_' . $email;
            }

            $user = User::create([
                'name' => $store->name . ' Store',
                'email' => $email,
                'password' => Hash::make('store123'),
                'role' => 'user',
            ]);

            $store->update([
                'user_id' => $user->id
            ]);

            $this->info("Generated user for store: {$store->name}");
        }

        $this->info('Done generating store users.');
    }
}