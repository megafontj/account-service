<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UserRegistered implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    /**
     * @return string|null
     */
    public function getQueue(): ?string
    {
        return 'user-registered';
    }
    /**
     * @var array $data
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::create([
           'email' => $this->data['email'],
           'auth_id' => $this->data['id'],
           'username' => $this->data['username'],
           'name' => $this->data['name']
        ]);
    }
}
