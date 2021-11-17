<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'level' => url('/').'/'.$this->picture,
            'description' => $this->when($request->route()->parameter('order'), $this->description),
            'computers' => $this->computers()->get()->implode('computer', ','),
            'types' => $this->types()->get()->implode('type', ','),
        ];
    }
}
