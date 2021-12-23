<?php

namespace App\Http\Resources\SuperAdmin;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherPermissionResource extends JsonResource
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
            'classe' => new ClasseResource($this->whenLoaded('classe')),
            'section' => new SectionResource($this->whenLoaded('section')),
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
            'marks' => $this->marks,
            'assignment' => $this->assignment,
            'attendance' => $this->attendance,
            'online_exam' => $this->online_exam,
            // 'created_at' => $this->class_id,
            // 'updated_at' => $this->class_id,

        ];
    }
}
