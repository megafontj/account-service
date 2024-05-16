<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'auth_id' => $this->auth_id,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->update_at,
            'followers_count' => $this->whenNotNull($this->followers_count),
            'following_count' => $this->whenNotNull($this->following_count)
        ];
    }
}
