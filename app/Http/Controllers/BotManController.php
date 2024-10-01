<?php

namespace App\Http\Controllers;

use App\Conversations\Contacto;
use App\Conversations\Howto;
use App\Conversations\Menu;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;


class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }
    public function ini()
    {
        $this->say('¡Bienvenido al chatbot! ¿Cómo puedo ayudarte hoy?');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    #funciones que invocan las conversaciones
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }
    public function startMenu(BotMan $bot)
    {
        $bot->startConversation(new Menu());
    }
    public function startContacto(BotMan $bot)
    {
        $bot->startConversation(new Contacto());
    }
    public function startFuncionamiento(BotMan $bot)
    {
        $bot->startConversation(new Howto());
    }
}
