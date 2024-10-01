<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
class Menu extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->menudo();
    }
    private function menudo()
    {
        $question= Question::create("Preguntas más solicitadas" )
        ->fallback("No se logro responder la pregunta")
        ->callbackId( "ask_reason")
        ->addButtons([
            Button::create("Sacar constancia o documentos relacionados")->value("Documentos")->url("http://escolar.cucei.udg.mx/cescolar/'"),
            Button::create("Cómo realizo el pre-registro o registro de materias?")->value("Pre-Registro"),
            Button::create("Como dar de baja una materia")->value("Baja"),
            Button::create("Qué son los art 33,34 y 35")->value("Articulo"),
            Button::create("Como escojo mi servicio social")->value("Servicio Social")->url("https://ss.siiau.udg.mx/login.xhtml;jsessionid=592a827f75c8dd399fdc08ff4810"),
            Button::create("Como presentar permiso de no se que")->value("Licencia"),
        ]);
        return $this->ask($question, function(Answer $answer) {
            $response = $answer->getValue();

            switch ($response) {
                case "Documentos":
                    $this->say($answer->getValue());
                    $this->say('Para tramites de documentos firmados se tiene que visitar la página');
                    break;
                case "Pre-Registro":
                    $this->say($answer->getValue());
                    $this->reg();
                    break;
                case "Baja":
                    $this->say($answer->getValue());
                    $this->say("Una vez iniciada la primer semana de clases deberás de contactar a tu coordinación y especificar la razón por la cual deseas dar de baja esa materia en el semestre.");
                    break;
                case "Articulo":
                    $this->say($answer->getValue());
                    $this->say("Se cae en Art 33 la primera vez que repruebas una materia,no hay consecuencias.");
                    $this->say("En 34 al reprobar la materia por segunda vez.");
                    $this->say("En 35 es al reprobar la misma materia por tercera vez, una vez eso suceda se te contactara por correo electronico y se debera de seguir un proceso especifico.");
                    break;
                case "Servicio Social":
                    $this->say($answer->getValue());
                    $this->say("Semanas antes de dar las plazas se dará una notificación en las redes oficiales de tu coordinación sobre la fecha.");
                    $this->say('Meterás solicitud en un periodo especfico dependiendo la plaza de tu selección.');
                    break;                
                case "Licencia":
                    $this->say($answer->getValue());
                    $this->say('Deberas de contactar a tu coordinación para darte más detalles sobre eso y darte el apoyo que necesites.');
                    $this->say('Recuerda ir a la opción de contactos del menú para darte el contacto de tu coordinación.');
                    break;
                default:
                    $this->say("No se reconoció la respuesta.");
                    break;
            }
        });


    }
    private function reg()
    {
        $question= Question::create("Especificamente sobre..." )
        ->fallback("No se logro responder la pregunta")
        ->callbackId( "ask_reason")
        ->addButtons([
            Button::create("Registro")->value("Registro"),
            Button::create("Pre-Registro")->value("Pre-Registro"),
        ]);
        return $this->ask($question, function(Answer $answer) {
            $response = $answer->getValue();

            switch ($response) {
                case "Registro":
                    $this->say($answer->getValue());
                    $this->say("Aproximadamente dos semanas antes del inicio a clases en Leo aparecerá tu horario para agendar.");
                    $this->say("Deberás ingresar el NRC de la materia y darle el botón de confirmar para ver si hay cupos disponibles.");
                    $this->say("En caso de no haber cupos de tu materia seleccionada deberás de seleccionar otra en la Oferta Academica");
                    break;
                case "Pre-Registro":
                    $this->say("Semanas antes de iniciar el pre-registro de materias se dará una notificación en las redes oficiales de tu coordinación sobre la fecha.");
                    $this->say("Una vez llegada la fecha deberás seleccionar el NRC de la materia y colocarlo en los recuadros correspondientes guardar");
                    break;
                default:
                    $this->say("No se reconoció la respuesta.");
                    break;
    }
});

}
}