<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = [
                'google_id' => $request->google_id,
                'name' => $request->name,
                'email' => $request->email,
            ];

            // $user = DB::table('users')->insert($data);

            $get_user = User::where('google_id', $request->google_id);
            if (empty($get_user->count())) {
                $user = User::create($data);
            }else{
                $user = $get_user->first();
            }
            
            // dd($user);

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            
            $response   = [
                'success'   => true,
                'status'    => 'success',
                'message'   => 'The request was successful',
                'code'      => 200,
                'result'    => [
                    'access_token'  => $tokenResult,
                    'token_type'    => 'Bearer',
                    'users'         => $user,
                ]
            ];

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $response = [
                'success'  => false,
                'status'    => 'error',
                'message'   => $e->getMessage(),
                'code'      => 500
            ]; 
        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        DB::beginTransaction();
        try {

            $user = $request->user();
            // dd($user);
            // delete all tokens, essentially logging the user out
            // $user->tokens()->delete();
            // delete the current token that was used for the request
            $user->currentAccessToken()->delete();
            $response = [
                'success'   => true,
                'status'    => 'success',
                'message'   => 'Logout successfully',
                'code'      => 200
            ];
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            $response = [
                'success'   => false,
                'status'    => 'error',
                'message'   => $e->getMessage(),
                'code'      => 500
            ]; 
        }

        DB::commit();

        return response()->json($response);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
