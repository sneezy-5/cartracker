<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 5;
        $count = Transactions::count();
        $cars = Transactions::paginate($perPage);


        return response()->json([
            'data' =>TransactionResource::collection($cars),
            'count' => $count,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->validated();
        $transaction = Transactions::create($data);

        return response()->json(['success' => 'Enregistrement réussi !'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cars = Transactions::find($id);
        return new  TransactionResource($cars);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, string $id)
    {
        $data = $request->validated();
        $transaction = Transactions::find($id);
        $transaction->update($data);
        return response()->json(['success'=> 'Modifié avec succès'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transactions::find($id);
        $transaction->delete();
        return response()->json(['success'=> 'Suprimé avec succès'], 204);
    }
}
