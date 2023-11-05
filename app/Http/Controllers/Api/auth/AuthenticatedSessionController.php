<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Exception;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
class AuthenticatedSessionController extends Controller
{

    public function __construct()
{
    $this->middleware('auth:api', ['except' => ['login', 'refresh','register']]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }



    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60,
            'expires_in' => (auth('api')->factory()->getTTL() * 86400)/60,
            'user' => auth()->user()
        ]);
    }

    public function userProfile() {
        return response()->json(auth()->user());
    }



    public function update(ProfileUpdateRequest $request,$id)
    {

        $user = User::find(auth()->user()->id);
        $data = $request->validated();
        if ($request->hasFile($request['profile_image'])) {
            $image = $request->file($request['profile_image']);


            $imageName = time() . '_' . $image->getClientOriginalName();


            $image->move(public_path('profile_img'), $imageName);


           $data['profile_image']= $imageName;
        }
        $user->update($data);
        return response()->json([
            'message' => 'User successfully updated',
            'user' => $user
        ], 201);
    }


      /**
     * this function create user account and set role.
     *
     * @param  string $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request)
{

    try{
        //dd($request->phone);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_admin'=>$request->is_admin,
            'password' => bcrypt($request->password)
        ]);


        return response()->json($user, 201);

    }catch(Exception $e){
    return response()->json(['errors'=>$e]);
}
}


protected function changePassword(ChangePasswordRequest $request)
{


    $user = auth()->user();

    // Vérifier si l'ancien mot de passe correspond
    if (!Hash::check($request->input('password_current'), $user->password)) {
        return response(['errors'=>['message' => ['Le mot de passe actuel ne correspond pas']]], 400);
    }

    // Réinitialiser le mot de passe
    $user->password = Hash::make($request->input('password'));
    $user->save();

    // Déclencher l'événement de réinitialisation du mot de passe
    event(new PasswordReset($user));

    return response()->json([
        'message' => 'Mot de passe mis à jour avec succès',
    ], 201);
}
}
