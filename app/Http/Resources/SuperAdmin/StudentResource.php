<?php

namespace App\Http\Resources\SuperAdmin;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'matricule' => $this->code,
            'user' => new UserResource($this->whenLoaded('user')),
            'parent' => new TutorResource($this->whenLoaded('tutor')),
            'session' => new SessionResource($this->whenLoaded('session')),
            'enrol' => new EnrolResource($this->whenLoaded('enrols'))
        ];
    }
}
