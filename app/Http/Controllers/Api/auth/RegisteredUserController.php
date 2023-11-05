<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegisterResource;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{


    public function index()
    {
        $users = User::all();
        return RegisterResource::collection($users);
    }

    public function store(UserRequest $request) {


        $user = User::create(array_merge(
                    $request->all(),
                    ['password' => bcrypt($request->password)]
                ));



        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (User::where('id', $id)->exists()) {

            $user = User::find($id)->get();
            return RegisterResource::collection($user);
        } else {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $user = User::find($id);
        $user->update($request->all());
        return response()->json([
            'message' => 'User successfully updated',
            'user' => $user
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }
    }
}
