<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'phone_number' => $this->user->phone_number,
                ];
            }),
            'order_id' => $this->order_id,
            'order' => $this->whenLoaded('order', function () {
                return [
                    'id' => $this->order->id,
                    'ingredients_cost' => $this->order->ingredients_cost,
                ];
            }),
            'payment_method' => $this->payment_method,
            'card_number' => substr_replace($this->card_number, '******', 6, 6), // Mask card number for security
            'expiry_date' => $this->expiry_date,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}