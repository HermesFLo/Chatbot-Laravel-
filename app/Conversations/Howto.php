<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class Howto extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askHowto();
    }
    private function askHowto()
    {
        $question= Question::create("Como funciona Laraboter?" )
        ->fallback("No se logro responder la pregunta")
        ->callbackId( "ask_reason")
        ->addButtons([
            Button::create("Funciones")->value("Funciones"),
            Button::create("Objetivo")->value("Objetivo"),
            Button::create("No puedo")->value("No puedo"),
        ]);
        return $this->ask($question, function(Answer $answer) {
            $response = $answer->getValue();

            switch ($response) {
                case "Funciones":
                    $this->say($answer->getValue());
                    $this->say("Es un chat especializado para responder preguntas sobre tu centro universitario.");
                    break;
                case "Objetivo":
                    $this->say($answer->getValue());
                    $this->say("Es ser una guia que te ayude a tener una idea clara sobre procesos que tendrás durante tu estadia.");
                    break;
                case "No puedo":
                    $this->say($answer->getValue());
                    $this->say("Agendar materias por ti o recomendar profesores con los que agendar jajaja.");
                    break;
                default:
                    $this->say("No se reconoció la respuesta.");
                    break;
            }
        });


    }
}
