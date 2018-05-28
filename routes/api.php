<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Sistemas - Crud - Squadra

$router->group(['prefix' => 'sistemas', 'as' => 'sistemas.'], function () use ($router) {
    $router->post('/', 'Api\SistemasController@incluir');
    /*$router->post('store', ['as' => 'gravar', 'uses' => 'UsuarioController@store']);
    $router->get('create', ['as' => 'criar', 'uses' => 'UsuarioController@create']);
    $router->get('{id}/destroy', ['as' => 'remover', 'uses' => 'UsuarioController@destroy']);
    $router->get('{id}/edit', ['as' => 'editar', 'uses' => 'UsuarioController@edit']);
    $router->post('{id}/update', ['as' => 'atualizar', 'uses' => 'UsuarioController@update']);*/
});


//sugestão de uso
/*Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
    });
});*/


Route::group(['middleware' => 'cors'], function () {
    Route::group(['middleware' => 'jwt.auth'], function () {
        //tudo que for puxado pela api tem que vir aqui

        //Route::get('products', 'Api\ProductsController@index');
        //Route::get('session', 'Api\PagSeguroController@getSessionId');
        //Route::post('order', 'Api\OrdersController@store');
        Route::get('user', function () {
            $user = JWTAuth::parseToken()->toUser();
            return response()->json(compact('user'));
        });

        Route::post("localizacao/dispositivos", function(Request $request){
            \Log::info($request->all());

            return Response::json(['success'=> $request->all()]);
        });

        Route::get('posts', function () {
            $posts = [
                [
                    'id' => 1,
                    'title' => 'Post 1',
                    'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at venenatis sapien.'
                ],
                [
                    'id' => 2,
                    'title' => 'Post 2',
                    'body' => 'Nullam ultrices dui porttitor libero faucibus luctus.'
                ],
                [
                    'id' => 3,
                    'title' => 'Post 3',
                    'body' => 'Duis aliquet, nibh vel accumsan mattis, orci dui lobortis ligula, in ultrices velit libero ut justo.'
                ],
            ];
            return response()->json(compact('posts'));
        });
    });

    //registrar usuario
    Route::post('register', 'Api\AuthController@register');

    //obter token
    Route::post('login/v1', 'Api\AuthController@login');
    Route::post('login/v2', 'Api\AuthController@login2');

    //para atualizar o token
    Route::post('refresh_token', function(){
        try {
            $token = JWTAuth::parseToken()->refresh();
            //return response()->json(compact('token'));
			return response()->json(['success' => true, 'data'=> [ 'token' => $token ]]);
        }catch (JWTException $exception){
            return response()->json(['error' => 'token_invalid'],400);
        }
    });
});
