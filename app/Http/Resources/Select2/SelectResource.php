<?php

namespace App\Http\Resources\Select2;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'label' => $this->name,
        ];
    }
}
