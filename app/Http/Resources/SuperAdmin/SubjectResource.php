<?php

namespace App\Http\Resources\SuperAdmin;

use App\Http\Resources\Select2\SelectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'name' => $this->name,
            'class_id' => $this->class_id,
            'school_id' => $this->school_id,
            'session' => $this->session,
            'classe' => new SelectResource($this->classe),
        ];
    }
}