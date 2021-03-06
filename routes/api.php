<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['namespace' => 'App\Api\V1\Controllers'],function (Router $api){;
        $api->group(['prefix' => 'auth'], function(Router $api) {
            $api->post('signup', 'Auth\AuthController@signup');
            $api->post('signin', 'Auth\AuthController@signin');
            $api->post('update_info', 'Auth\AuthController@updateMe');
            $api->post('recovery', 'Auth\PasswordResetController@sendResetToken');
            $api->post('verify', 'Auth\PasswordResetController@verify');
            $api->post('reset', 'Auth\PasswordResetController@reset');
            $api->post('activateEmail', 'Auth\AccountVerificationController@activateEmail');
            $api->post('activatePhone', 'Auth\AccountVerificationController@activatePhone');

            $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
                $api->get('me', 'Auth\AuthController@getAuthenticatedUser');
                $api->post('update_info', 'Auth\AuthController@updateMe');
                $api->post('logout', 'LogoutController@logout');
                $api->post('refresh', 'RefreshController@refresh');
            });
        });


        $api->group(['middleware' => 'api'], function(Router $api) {
            $api->get('protected', function() {
                return response()->json([
                    'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
                ]);
            });
            $api->group(['middleware' => 'jwt.auth','prefix' => 'users'], function(Router $api) {
                $api->get('me', 'UserController@me');
                $api->post('updateMe', 'Auth\AuthController@updateMe');
                $api->resource("parametres", 'ParametresController');
                $api->resource("paiements", 'PaiementsController');
                $api->resource("clients", 'ClientsController');
                $api->resource("abonnements", 'AbonnementsController');
            });


            $api->get('refresh', [
                'middleware' => 'jwt.refresh',
                function() {
                    return response()->json([
                        'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                    ]);
                }
            ]);
        });
        $api->resource("categories", 'CategoriesController');
        $api->resource("marques", 'MarquesController');
        $api->resource("entreprises", 'EntreprisesController');
        $api->resource("localisation", 'LocalisationController');
        $api->resource("notes", 'NotesController');
        $api->resource("note_offres", 'NoteOffresController');
        $api->resource("note_entreprises", 'NoteEntreprisesController');
        $api->resource("offres", 'OffresController');
        $api->resource("prix", 'PrixController');
        $api->resource("promotions", 'PromotionsController');
        $api->resource("souhaits", 'SouhaitsController');
        $api->resource("sous_categories", 'SousCategoriesController');
        $api->resource("type_entreprises", 'TypeEntreprisesController');
        $api->resource("type_abonnements", 'TypeAbonnementsController');
        $api->resource("villes", 'VillesController');

        $api->get('hello', function() {
            return response()->json([
                'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
            ]);
        });

    });

});
