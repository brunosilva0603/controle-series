<?php

use App\Mail\NovaSerie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/series', 'SeriesController@index')
    ->name('listar_series');
Route::get('/series/criar', 'SeriesController@create')
    ->name('form_criar_serie')
    ->middleware('autenticador');
Route::post('/series/criar', 'SeriesController@store')
    ->middleware('autenticador');
Route::delete('/series/{id}', 'SeriesController@destroy')
    ->middleware('autenticador');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
    ->middleware('autenticador');

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {

    Auth::logout();
    return redirect('/entrar');
});

Route::get('/visualizando-email', function () {
    return new \App\Mail\NovaSerie(
        nome: 'Arrow',
        qtdTemporadas: '5',
        qtdEpisodios: '10'
    );
});

Route::get('/enviando-email', function () {
    $email = new NovaSerie(
        nome: 'Arrow',
        qtdTemporadas: '5',
        qtdEpisodios: '10'
    );

    $email->subject = 'Nova série adicionada';

    $user = (object)[
        'email' => 'bruno@teste.com',
        'name' => 'Bruno'
    ];

    Mail::to($user)->send($email);

    return 'Email enviado !';
});
