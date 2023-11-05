<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Models\Cars;
use App\Http\Resources\CarsResource;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 5;
        $count = Cars::count();
        $cars = Cars::paginate($perPage);


        // return  CarsResource::collection($cars);
        return response()->json([
            'data' =>CarsResource::collection($cars),
            'count' => $count,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        $data = $request->validated();

        // Enregistrer le véhicule
        $car = new Cars;
        $car->brand = $data['brand'];
        $car->model = $data['model'];
        $car->year_of_manufacture = $data['year_of_manufacture'];
        $car->fuel_type = $data['fuel_type'];
        $car->number_place = $data['number_place'];
        $car->description = $data['description'];
        $car->mileage = $data['mileage'];
        $car->numberplate = $data['numberplate'];
        $car->rental_price_per_day = $data['rental_price_per_day'];
        $car->status = $data['status'];
        $car->gearbox = $data['gearbox'];
        $car->gps = $data['gps'];

        $pictureFields = ['picture1', 'picture2', 'picture3', 'picture4'];

        foreach ($pictureFields as $field) {
            if ($request->hasFile($field)) {
                $image = $request->file($field);


                $imageName = time() . '_' . $image->getClientOriginalName();


                $image->move(public_path('car_images'), $imageName);


                $car->{$field} = $imageName;
            }
        }

        $car->save();

        return response()->json(['success' => 'Enregistrement réussi !'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cars = Cars::find($id);
        return new  CarsResource($cars);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, string $id)
    {


        $data = $request->validated();

        $car = Cars::find($id);

        if (!$car) {
            return response()->json(['error' => 'Véhicule non trouvé.'], 404);
        }

        // Mettre à jour les détails de la voiture
        $car->brand = $data['brand'];
        $car->model = $data['model'];
        $car->year_of_manufacture = $data['year_of_manufacture'];
        $car->fuel_type = $data['fuel_type'];
        $car->mileage = $data['mileage'];
        $car->numberplate = $data['numberplate'];
        $car->number_place = $data['number_place'];
        $car->description = $data['description'];
        $car->rental_price_per_day = $data['rental_price_per_day'];
        $car->status = $data['status'];
        $car->gearbox = $data['gearbox'];
        $car->gps = $data['gps'];
        
        $pictureFields = ['picture1', 'picture2', 'picture3', 'picture4'];

        foreach ($pictureFields as $field) {
            if ($request->hasFile($field)) {
                $image = $request->file($field);

                $imageName = time() . '_' . $image->getClientOriginalName();

                $image->move(public_path('car_images'), $imageName);

                $car->{$field} =$imageName;
            }
    }

    $car->save();

    return response()->json(['success' => 'Mise à jour réussie !'], 200);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Cars::find($id);
        $car->delete();
        return response()->json(['success' => 'delete success'], 204);
    }
}
