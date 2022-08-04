<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'id'=>$this->id,
            'blok' => $this->product->blok,
            'no_kavling' => $this->product->no_kavling,
            'type' => $this->product->type,
            'luas_tanah' => $this->product->luas_tanah,
            'price' => $this->product->price,
            'tanah_lebih' => $this->product->tanah_lebih,
            'discount' => $this->product->discount,
            'status' => $this->status_booking->name,
            'customer_nik' => $this->customer->nik,
            'customer_name' => $this->customer->name,
            'address' => $this->customer->address,
            'phone' => $this->customer->phone,
            'avatar_customer' => $this->customer->avatar_url,
            'bukti' => $this->bukti_url,
        ];
    }
}
