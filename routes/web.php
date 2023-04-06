<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;
use Carbon\Carbon;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/hello/{name}', function ($name){
        echo 'Olá, '.$name.'! Bem-vindo ao meu site.';
}) ->where('name', '[A-Za-z]{3,}$');

Route::get('/conta/{número1}/{número2}/{operação?}', function (int $numero1,int $numero2, $operacao = null) {
        if ($operacao == null){
        $operacaoSoma = $numero1 + $numero2;
        $operacaoSub = $numero1 - $numero2;
        $operacaoMulti = $numero1 * $numero2;
        $operacaoDivi = $numero1 / $numero2;
        return
            $numero1 . ' + ' . $numero2 . ' = ' . $operacaoSoma . '<br>' .
            $numero1 . ' - ' . $numero2 . ' = ' . $operacaoSub . '<br>' .
            $numero1 . ' x ' . $numero2 . ' = ' . $operacaoMulti . '<br>' .
            $numero1 . ' % ' . $numero2 . ' = ' . $operacaoDivi;
        }
        if ($operacao == 'soma' or 'Soma' or 'SOMA'){
            $operacaoSoma = $numero1 + $numero2;
            return $numero1 . ' + ' . $numero2 . ' = ' . $operacaoSoma;
        }
        if ($operacao == 'subtração'){
            $operacaoSub = $numero1 - $numero2;
            return $numero1 . ' - ' . $numero2 . ' = ' . $operacaoSub;
        }
        if ($operacao == 'multiplicação'){
            $operacaoMulti = $numero1 * $numero2;
            return $numero1 . ' x ' . $numero2 . ' = ' . $operacaoMulti;
        }
        if ($operacao == 'divisão'){
            $operacaoDivi = $numero1 / $numero2;
            return $numero1 . ' % ' . $numero2 . ' = ' . $operacaoDivi;
        }
        }) ->where('número1' and
         'número2' , '[0-9]+');

Route::get('/idade/{ano}/{mês?}/{dia?}', function (int $ano, int $mes = null, $dia = null) {
    $dataReal = Carbon::now('America/Sao_Paulo');
    $aniversario = Carbon::createfromDate($ano, $mes, $dia, 'America/Sao_Paulo');
    $data = $aniversario->diff($dataReal);

    if($aniversario > $dataReal){
        $res = "Não é possível calcular uma data futura com o tempo atual.";
    } elseif ($aniversario == $dataReal) {
        $res = "Não é possível calcular a mesma data atual.";
    } elseif ($mes == null || $dia == null) {
        $res = "Você possui " . $dataReal->format('Y') - $ano . " anos de idade.";
    } else {
        $res = "Você possui " . $data->format('%y') . " anos, " . $data->format('%m') . " meses e " . $data->format('%d') . " dias de idade.";
    }

    return $res;
})->where ('ano', '[0-9]{4}')
    ->where ('mes', '[0-9]{1,2}?')
        ->where ('dia', '[0-9]{1,2}?');