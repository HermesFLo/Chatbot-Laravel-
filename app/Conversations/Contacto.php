<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class Contacto extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->cont();
    }
    public function cont()
    {
        $question= Question::create("¿Que carrera eres?" )
        ->fallback("No se logro responder la pregunta")
        ->callbackId( "ask_reason")
        ->addButtons([
            Button::create("Computación")->value("Computación"),
            Button::create("Informatica")->value("Informatica"),
        ]);
        return $this->ask($question, function(Answer $answer) {
            $response = $answer->getValue();

            switch ($response) {
                case "Computación":
                    $this->say($answer->getValue());
                    $this->compu();
                    break;
                case "Informatica":
                    $this->say($answer->getValue());
                    $this->inf();
                    break;
                default:
                    $this->say("No se reconoció la respuesta.");
                    break;
            }
        });


    }
    private function compu()
    {
       
        $this->say('Facebook: https://www.facebook.com/ing.cucei');
        $this->say('WhatsApp: 33 3139 9265');
                
}
    private function inf()
    {
       
        $this->say('Facebook: ');
        $this->say('WhatsApp: ');
                
}
}
