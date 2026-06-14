<?php

namespace App\Http\Resources\Api\Blog\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'is_published'   => (bool) $this->is_published,

            'content_raw'    => $this->content_raw,

            'date_published' => $this->published_at ? date('Y-m-d H:i:s', strtotime($this->published_at)) : null,

            'user_id'        => $this->user_id,
            'category_id'    => $this->category_id,

            'user'           => $this->user,
            'category'       => $this->category,
        ];
    }
}
