<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserFollowed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new job instance.
     */
    public function __construct(int $followingId, int $followerId)
    {
        $this->data = [
          'user_id' => $followerId,
          'follower' => User::find($followerId)->toArray()
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
