<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\UsersAccount;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance
     * 
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


     /**
     * 透過JWT認證取得Token
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {   
        $credentials = $request->only('name', 'password');

        if ($token = Auth::attempt($credentials)) {
            return $this->createNewToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * 登出 (使Token失效)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * 刷新Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(Auth::refresh());
    }


    /**
     * 新增帳號
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|between:2,100',
            'email'     => 'required|string|email|max:100|unique:users',
            'password'  => 'required|string|confirmed|min:6',
            'phone'     => 'required|digits:10',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        #新增users前先新增Users_account
        UsersAccount::create([
            'account'   => $request->name,
            'password'  => bcrypt($request->password),
        ]);
        $userAccount = UsersAccount::where('account', $request->name)->first();
        $userAccountId = $userAccount->id;
        #新增users
        $user = Users::create(array_merge(
            $validator->validated(),
            [   'password'          => bcrypt($request->password),
                'user_account_id'   => $userAccountId,
            ]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
    * 呈現登錄的用戶的資料
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * 取得Token相關資料
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}