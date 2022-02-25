<?php

namespace App\Events;

use Illuminate\Mail\Mailable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NovaSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $nomeSerie, $qtdTemporadas, $qtdEpisodios;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($nomeSerie, $qtdTemporadas, $qtdEpisodios)
    {
        $this->nomeSerie = $nomeSerie;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->qtdEpisodios = $qtdEpisodios;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
