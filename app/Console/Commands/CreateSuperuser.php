<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CreateSuperuser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createsuperuser:createsuperuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Default Superuser';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::query()->delete();
        $user = User::create(
            [
                'first_name' => 'اشکان',
                'last_name' => 'کریمی',
                //            'email' => 'as@gmail.com',
                'phone' => '09396988720',
                'password' => Hash::make('123'),
                'phone_verified_at' => Carbon::now(),
                'is_superuser' => true,
            ]
        );
        auth()->login($user);
        return 0;
    }
}
