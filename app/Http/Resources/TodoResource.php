<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'title'=>$this->title,
            'description'=>$this->description,
            'priority'=>$this->whenLoaded('priority',fn()=>$this->priority->name),
            'category'=>$this->whenLoaded('category',fn()=>$this->category->name),
            'completed'=>$this->is_completed,
        ];
    }
}
