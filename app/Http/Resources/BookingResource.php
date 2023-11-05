<?php

namespace App\Http\Resources;

use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $car =Cars::find($this->car_id);
        return [
            "id"=> $this->id,
            "start_date"=> $this->start_date,
            "lname"=> $this->lname,
            "fname"=> $this->fname,
            "time"=> $this->time,
            "amount"=> $this->amount,
            "status"=> $this->status,
            "phone"=> $this->phone,
            "special_request"=> $this->special_request,
            "car"=>[
                'model'=>$car->model,
                'brand'=>$car->brand,
                'picture1'=>'http://127.0.0.1:8000/car_images/'.$car->picture1
                ]

        ];
    }
}
