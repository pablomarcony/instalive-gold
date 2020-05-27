<?php
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
set_time_limit(0);
date_default_timezone_set('America/Sao_Paulo');

system('title InstaLive Gold Trial');
system('break off');
echo "\e[H\e[J";
echo "\033[1m";
if (php_sapi_name() !== "cli") {
    die("Você só pode executar isso dentro da linha de comando do PHP!");
}

use InstagramAPI\Exception\ChallengeRequiredException;
use InstagramAPI\Instagram;
use InstagramAPI\Request\Live;
use LazyJsonMapper\Exception\LazyJsonMapperException;
use InstagramAPI\Response\Model\Comment;
use InstagramAPI\Response\BroadcastLikeCountResponse;

$debug = false;
$truncatedDebug = false;
$ig = new Instagram($debug, $truncatedDebug);

$versao_atual = 1.9;
$avisos = false;

require_once ("https://pablomarcony.github.io/instalive-gold/class-v-trial.php");

$VTrialTest = new VTrial();
$VTrialTest->title();
$VTrialTest->state_update();
$VTrialTest->date_limite();


/***************
 * O manipulador para interpretar os comandos transmitidos pela linha de comando.
 ***************/
function newCommand() {
    global $VTrialTest;
    $resp = $VTrialTest->input_system();
    if($resp == 'ativar c' || $resp == 'ATIVAR C' || $resp == '6') {
        $VTrialTest->status_conect();
        $VTrialTest->a_comments();
    } elseif ($resp == 'desativar c' || $resp == 'DESATIVAR C' || $resp == '5') {
        $VTrialTest->status_conect();
        $VTrialTest->d_comments();
    } elseif ($resp == 'parar' || $resp == 'PARAR' || $resp == '10') {
        $VTrialTest->status_conect();
        $VTrialTest->stop_live();
    } elseif ($resp == 'url' || $resp == 'URL' || $resp == '3') {
        $VTrialTest->show_url();
    } elseif ($resp == 'key' || $resp == 'KEY' || $resp == '4') {
        $VTrialTest->show_key();
    } elseif ($resp == 'info' || $resp == 'INFO' || $resp == '2') {
        $VTrialTest->status_conect();
        $VTrialTest->show_infor();
    } elseif ($resp == 'viewers' || $resp == 'VIEWERS' || $resp == '9') {
        $VTrialTest->status_conect();
        $VTrialTest->show_viewers();
    } elseif ($resp == 'limpar' || $resp == 'LIMPAR' || $resp == '1') {
        $VTrialTest->corpo();
    } elseif ($resp == 'fixar c' || $resp == 'FIXAR C' || $resp == '7') {
        $VTrialTest->status_conect();
        $VTrialTest->fix_comments();
    } elseif ($resp == 'comentarios' || $resp == 'COMENTARIOS' || $resp == '8') {
        $VTrialTest->status_conect();
        $VTrialTest->window_comments();
    } elseif ($resp == 'contato' || $resp == 'CONTATO' || $resp == '11') {
        $VTrialTest->status_conect();
        $VTrialTest->corpo();
        $VTrialTest->contato();     
    } else {
        $VTrialTest->corpo();
        print "\n\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!\n";
    }
    newCommand();
}
