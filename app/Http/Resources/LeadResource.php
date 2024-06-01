<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'source' => $this->source,
            'owner' => $this->owner,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'created_by' => $this->created_by,
        ];
    }
}
