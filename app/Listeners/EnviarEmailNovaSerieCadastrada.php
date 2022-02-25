<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $nomeSerie = $event->nomeSerie;
        $qtdtemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;

        $users = User::all();
        foreach ($users as $indice => $user) 
        {
            $multiplicador = $indice +1;

            $email = new NovaSerie(
                $nomeSerie,
                $qtdtemporadas,
                $qtdEpisodios
            );

            $email->subject = 'Nova série adicionada';

            Mail::to($user)->later(now()->addSeconds($multiplicador * 10), ($email));
        }
    }
}
