<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/', [CategoryApiController::class, 'index']);

# GET /categories -> index()
# GET /categories/id -> show()
# POST /categories -> store()
# PUT /categories/id -> update()
# DELETE /categories/id -> destroy()

Route::apiResource('/categories', CategoryApiController::class)
->middleware('auth:sanctum');

Route::post('/login', function() {
    $email = request()->email;
    $password = request()->password;

    $user = App\Models\User::where("email", $email)->first();

    if(!$user) return response('User not found', 403);

    if(password_verify($password, $user->password)) {
        return $user->createToken('chrome')->plainTextToken;
    }

    return response("Incorrect password", 403);
});

Route::delete('/logout', function() {
    $user = request()->user;
    $user->tokens()->delete();

    return "User logout successfully";
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
