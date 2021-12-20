<?php

namespace App\Http\Resources\SuperAdmin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'code' => $this->code,
            'phone' => $this->phone,
            'address' => $this->address,
            'image' => env('APP_URL').$this->image,
            'role' => $this->role,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'blood_group' => $this->blood_group,
            'watch_history' => $this->id,
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'author_url_website' => env('AUTHOR_API_WEBSITE'),
            'author_name' => env('AUTHOR_API_NAME')
        ];
    }
}
