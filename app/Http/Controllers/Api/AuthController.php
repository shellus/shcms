<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Exception\HttpResponseException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;

class AuthController extends Controller
{
    public function postLogin(Request $request)
    {
        try
        {
            $this->validate($request, [
                'name' => 'required|max:255', 'password' => 'required',
            ]);
        }
        catch (HttpResponseException $e)
        {
            return response()->json([
                'error' => [
                    'message'     => 'Invalid auth',
                    'status_code' => IlluminateResponse::HTTP_BAD_REQUEST
                ]],
                IlluminateResponse::HTTP_BAD_REQUEST,
                $headers = []
            );
        }

        $credentials = $this->getCredentials($request);

        try
        {
            // attempt to verify the credentials and create a token for the user
            if ( ! $token = JWTAuth::attempt($credentials))
            {
                return response()->json(['error' => 'invalid_credentials','credentials' => $credentials], 401);
            }
        }
        catch (JWTException $e)
        {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('name', 'password');
    }
}
