<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('hola', function ($bot) {
    $bot->reply('¡Bienvenido estudiante! Escribe una de las opciones para iniciar Preguntas Funcionamiento
    Contacto');
});
$botman->hears(' ', function ($bot) {
    $bot->reply('Escribe una opción valida');
});
$botman->hears('contacto', BotManController::class.'@startContacto');
$botman->hears('Preguntas', BotManController::class.'@startMenu');
$botman->hears('Funcionamiento', BotManController::class.'@startFuncionamiento');
Route::post('/botman/tinker', [BotManController::class, 'tinker']);
