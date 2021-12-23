<?php

namespace App\Http\Resources\SuperAdmin;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'department' => new DepartmentResource($this->whenLoaded('department')),
            'permissions'=> TeacherPermissionResource::collection($this->whenLoaded('permissions')),
            'designation' => $this->designation,
            // 'school_id' => $this->school_id,
            'social_links' => json_decode($this->social_links),
            'about' => $this->about,
            // 'show_on_website' => $this->show_on_website,
        ];

    }
}
