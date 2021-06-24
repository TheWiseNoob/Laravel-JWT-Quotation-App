<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Quotation;

use Carbon\Carbon;





class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if(! $token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Invalid login information.']);
        }



		return $this->respondWithToken($token);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
			'error' => '',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }





    /**
     * Get a quotation.
     *
     * @return \Illuminate\Http\JsonResponse
     */

	public function quotation(Request $request)
	{

		$ages = $request -> age;

		$regex="/^[0-9,]+$/";

		if(!preg_match($regex, $ages))
		{

			return response() -> json(['error' => 'Number list format incorrect.']);

		}

		$ages = explode(',', $ages);

		if($ages[0] < 18)
		{

			return response() -> json(['error' => 'First age must be 18+.']);

		}

		foreach($ages as $age)
		{

			if($age <= 0)
			{

				return response() -> json(['error' => 'Ages cannot be 0.']);

			}

		}



		$currency_id = $request -> currency_id;



		$start_date = Carbon::createFromFormat('Y-m-d', $request -> start_date) -> startOfDay();

		$end_date = Carbon::createFromFormat('Y-m-d', $request -> end_date) -> startOfDay();

		$trip_length = $start_date -> diffInDays($end_date) + 1;



		$total_cost = 0.00;

		foreach($ages as $age)
		{

			$age_load = Age_Load((int)($age));

			$total_cost += (3 * $age_load * $trip_length);

		}

		$total_cost = round($total_cost, 2);



		$quotation = new Quotation();

		$quotation -> total = $total_cost;

		$quotation -> currency_id = $currency_id;

		$quotation -> start_date = $start_date;

		$quotation -> end_date = $end_date;

		$quotation -> save();



		return response() -> json(['error' => '', 'total' => $total_cost, 'currency_id' => $currency_id, 'quotation_id' => $quotation -> id]);

	}

}
