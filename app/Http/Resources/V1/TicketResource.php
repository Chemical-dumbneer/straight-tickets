<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->value,

            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),

            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],

            'tech' => $this->when($this->tech_id !== null, function () {
                return [
                    'id' => $this->tech?->id,
                    'name' => $this->tech?->name,
                    'email' => $this->tech?->email,
                ];
            }),

            'interactions' =>$this->whenLoaded('interactions', function () {
                return $this->interactions->map(function ($interaction) {
                    return [
                        'timelinePosition' => $interaction->timelinePosition,
                        'type' => $interaction->type->value,
                        'description' => $interaction->description,

                        'user' => [
                            'id' => $interaction->user->id,
                            'name' => $interaction->user->name,
                            'email' => $interaction->user->email,
                        ],

                        'created_at' => $interaction->created_at?->toIso8601String(),
                    ];
                });
            })
        ];
    }
}
