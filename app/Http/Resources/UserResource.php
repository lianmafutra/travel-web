<?php

namespace App\Http\Resources;

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
        return [
            'id'            => $this->id,
            'username'       => $this->username,
            'name'          => $this->name,
            'role'          => implode(",", $this->getRoleNames()->toArray()),
            'created_at'    => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at'    => date('d-m-Y H:i:s', strtotime($this->updated_at))
        ];
    }
}
