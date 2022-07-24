<?php

namespace App\Http\Resources;

use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'date' => $this->created_at->toDateTimeString(),
            // 'image' => env('APP_URL') . '/storage/' . $this->images()->first()?->path
            // 'image' => $this->images()->first() ? Storage::url($this->images()->first()?->path) : null,
            // 'images' => $this->images->map(fn($i) => [
            //     'id' => $i->id,
            //     'url' => Storage::url($i->path) 
            // ]),
            'images' => ImageResource::collection($this->images),
            'author' => UserResource::make($this->user),
            'categories' => CategoryResource::collection($this->categories),
        ];
    }
}
