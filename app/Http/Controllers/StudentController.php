<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function register(Request $request) {
        $rules = [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ];

        $input     = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->only('email', 'password');
        $user = User::where('email', '=', $input['email'])->first();
        $token = '';
        if (! $token = JWTAuth::fromUser($user,['role' => 'Admin'])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
       
        return $this->createNewToken($token);
    }

    protected function createNewToken($token){
        return response()->json([
            'message' => 'success',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function balanced(Request $request) {

        $str = trim($request->string);
        $strArray = str_split($str);
        
        $there = ['(','{','[','<'];
        $arr1 = $arr2 = [];
        foreach($strArray as $key => $value){
            if (in_array($value,$there)) {
                array_push($arr1,$value);
            }else{
                array_push($arr2,$value);
            }
        }  

        $count1 = count($arr1);$count2 = count($arr2);

        if ($count1 != $count2) {
            $message = 'Failed to be balanced';
        } else {
            $message = 'Success to be balanced';
        }

        $user = JWTAuth::authenticate($request->token);
        $count = $user->count + 1;
        User::where('email', $user->email)->update(array('count' => $count));
        return response()->json([
            'message' => $message,            
            'username' => $user->name,
            'attempts' => $count
        ]);
    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function userProfile(Request $request) { 
        $data = JWTAuth::parseToken();

        $user = JWTAuth::authenticate($request->token);
        return response()->json(['user' => $user,'data' => $data]);
    }
}
