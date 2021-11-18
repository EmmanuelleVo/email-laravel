<?php

use App\Events\CommentPosted;
use App\Models\Comment;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comment', function () {
    $comment = new Comment();
    $comment->body = "Normalement on devrait gérer l'envoi d'email ici, ce qui alourdirait notre controller et lui ferait réaliser des tâches annexes à celles qui lui sont normalement dédiées";
    $comment->save();

    // Normalement on devrait gérer l'envoi d'email ici. Ce qui alourdirait notre controller et lui ferait réaliser des tâches annexes à celles qui lui sont normalement dédiées

    $start = hrtime(true);
    CommentPosted::dispatch($comment);
    /*Mail::to('admin@monsite.com')
        ->send(new \App\Mail\CommentPosted($comment));*/
    $end = hrtime(true);
    // émettre l'event qui dit qu'un new comment a été créé pour pouvoir ensuite envoyer un email à ce sujet à notre admin
    return ($end - $start)/1e+6; //1 exposant 6

});
