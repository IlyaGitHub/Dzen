<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\User;

class RegistrationUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:registration {name} {email} {phone} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create new user. Formate: {name} {email} {phone} {password}.';

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
     * @return mixed
     */
    public function handle()
    {
        $data['name'] = $this->argument('name');
        $data['email'] = $this->argument('email');
        $data['phone'] = $this->argument('phone');
        $data['password'] = $this->argument('password');

        $validator = $this->validator($data);
        if(!$validator->fails()){
            $this->create($data);
            $this->info('User ' . $data['name'] . ' have created successfully!');
        } else {
            $this->error('You have errors...');
            foreach ($validator->errors()->all() as $message) {
                $this->error($message);
            }
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    private function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
