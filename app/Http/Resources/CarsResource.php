<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'id'=>$this->id,
            'brand'=>$this->brand,
            'model'=>$this->model,
            'mileage'=>$this->mileage,
            'gps'=>$this->gps,
            'gearbox'=>$this->gearbox,
            'numberplate'=>$this->numberplate,
            'fuel_type'=>$this->fuel_type,
            'year_of_manufacture'=>$this->year_of_manufacture,
            'number_place'=>$this->number_place,
            'description'=>$this->description,
            'rental_price_per_day'=>$this->rental_price_per_day,
            'status'=> $this->status,
            'picture1'=> 'http://127.0.0.1:8000/car_images/'.$this->picture1,
            'picture2'=> 'http://127.0.0.1:8000/car_images/'. $this->picture2,
            'picture3'=> 'http://127.0.0.1:8000/car_images/'.$this->picture3,
            'picture4'=> 'http://127.0.0.1:8000/car_images/'.$this->picture4,
        ];
    }
}
