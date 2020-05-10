<?php
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
set_time_limit(0);
date_default_timezone_set('America/Sao_Paulo');

system('title InstaLive Gold Trial');
system('break off');
pclose (popen('cls', 'w'));
if (php_sapi_name() !== "cli") {
    die("Você só pode executar isso dentro da linha de comando do PHP!");
}

$texto_title[0] = false;
function title () {
    global $texto_title;
    if ($texto_title[0] > 1) {
        $texto_title[1] = "DIAS";
        $texto_title[2] = "RESTANTES";
    } elseif ($texto_title[0] === 1 || $texto_title[0] === 0){
        $texto_title[1] = "DIA";
        $texto_title[2] = "RESTANTE";
    } else {
        $texto_title[0] = null;
        $texto_title[1] = null;
        $texto_title[2] = "TRIAL";
    }
    pclose (popen('cls', 'w'));
    print "Bem vindo(a) ao";
    print "
 _____              _           _      _                  _____         _      _  
|_   _|            | |         | |    (_)                |  __ \       | |    | | 
  | |   _ __   ___ | |_   __ _ | |     _ __   __  ___    | |  \/  ___  | |  __| | 
  | |  | '_ \ / __|| __| / _` || |    | |\ \ / / / _ \   | | __  / _ \ | | / _` | ".$texto_title[0]."
 _| |_ | | | |\__ \| |_ | (_| || |____| | \ V / |  __/   | |_\ \| (_) || || (_| | ".$texto_title[1]."
 \___/ |_| |_||___/\___|\___,_|\_____/|_|  \_/  \____|   \_____/\_____/|_|\___,_| ".$texto_title[2];
    logM("\nCopyright © 2020 - Todos os direitos reservados");
}
title();

// verificador de updates
if (isset($version) == false || $version != 1.9){
    echo "\nForam encontradas novas atualizações. Aguarde enquanto fazemos a implantação.";
    if ((@include "https://pablomarcony.github.io/instalive-gold/v-trial-update.php") == FALSE) {
        $erro_update = true;
    } else {
    }
    if ($erro_update == true) {
        sleep(5);
        title();
        echo "\nFalha na implantação das atualizações! Por favor, verifique sua conexão a internet e reinicie o InstaLive Gold Trial.";
        system("PAUSE >nul");
        exit(0);
    } else {
        sleep(5);
        title();
        echo "\nAtualizações implantadas com sucesso! Por favor, reinicie o InstaLive Gold Trial.";
        system("PAUSE >nul");
        exit(0);
    }
}

function novo_limite ($limite) {
    $limite_fim = DateTime::createFromFormat('d/m/Y H:i:s', $limite);
    $limite_fim = date_format($limite_fim, 'YmdHis');
    return $limite_fim;
}

print "
┌─────────────────────────────────────────────────────────────────────────┐
│ ● Esta é uma versão de teste! Por favor, digite sua chave de acesso:    │
└─────────────────────────────────────────────────────────────────────────┘";
function date_limite() {
    print "\n ▌ ";
    $handle = fopen ("php://stdin","r");
    $code = trim(fgets($handle));

    $limite = null;
    $date = date("YmdHis");

    include 'https://pablomarcony.github.io/instalive-gold/v-trial-list.php';
    if ($limite == null){
        print "\n ▲ POR FAVOR, VERIFIQUE SUA CONEXÃO A INTERNET PARA UTILIZAR O INSTALIVE GOLD TRIAL. \NCASO O ERRO PERSISTA, ENTRE EM CONTATO COM DOS DESENVOLVEDORES.\r";
        $rsp_contato = contato();
        if ($rsp_contato != false) {
            echo $rsp_contato;
        }    
        system("PAUSE >nul");
        exit(0);
    } elseif ($limite == "c-invalido"){
        title();
        print "
┌────────────────────────────────────────────────────────────┐
│ ● Chave de acesso invalida. Por favor, Tente novamente.    │
└────────────────────────────────────────────────────────────┘";
        date_limite();
    } elseif ($limite_fim <= $date){
        title();
        print "\n ■ ESTA VERSÃO EXPIROU! POR FAVOR, ADQUIRA UMA NOVA VERSÃO COM OS DESENVOLVEDORES.";
        $rsp_contato = contato();
        if ($rsp_contato != false) {
            echo $rsp_contato;
        }    
        logM("\n ▲ SAINDO...");
        sleep(2);
        exit(0);
    } else {
        $_date = strtotime(date("d-m-Y"));
        $_limite = strtotime(date_format(DateTime::createFromFormat('d/m/Y H:i:s', $limite), 'd-m-Y'));
        return $dias_left = (($_date - $_limite) /86400) *-1;
    }
}
$texto_title[0] = date_limite();

function avisos() {
    $avisos = false;
    if ($avisos == true) {
        title();
        echo "\n                                             
    ▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒ AVISOS ▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒
    ╔══════════════════════════════════════════════════════════════════════════════════════════╗
    ║                                                                                          ║
    ║    SERVIDOR EM MANUTENÇÃO DE MELHORIAS COM DURAÇÃO MÉDIA DE 10 MINUTOS. DURANTE ESTE     ║
    ║    PERÍODO ALGUNS USUÁRIOS PODERÃO SOFRER INSTABILIDADES AO UTILIZAR O SISTEMA.          ║
    ║                                                                                          ║
    ╚══════════════════════════════════════════════════════════════════════════════════════════╝
      Pressione qualquer tecla para continuar. . .";
        system("PAUSE >nul");
    }
}
avisos();

use InstagramAPI\Instagram;
use InstagramAPI\Request\Live;
$debug = false;
$truncatedDebug = false;
$ig = new Instagram($debug, $truncatedDebug);

function login($ig) {
    title();
    print "\n ■ EFETUE O LOGIN NO INSTAGRAM";
    print "\n
┌──────────┬────────────────────────┐
│ USUÁRIO: │ ";
    $handle = fopen ("php://stdin","r");
    $ig_username = trim(fgets($handle));
    print "├──────────┼────────────────────────┤
│  SENHA:  │ ";
    $handle = fopen ("php://stdin","r");
    $ig_password = trim(fgets($handle));
    print "└──────────┴────────────────────────┘";

    print "\n ▲ CONECTANDO...\r";
    try {
        $loginResponse = $ig->login($ig_username, $ig_password);

        if ($loginResponse !== null && $loginResponse->isTwoFactorRequired()) {
            logM("Confirmação de acesso necessária! Siga os seguintes passos:
            \n 1 - Desconecte sua conta de todos os dispositivos;
            \n 2 - Faça login no instagram.com neste computador;
            \n 3 - Confirme sua atividade de acesso;
            \n 4 - POR ÚLTIMO, verifique o código SMS recebido em seu telefone.");
            $twoFactorIdentifier = $loginResponse->getTwoFactorInfo()->getTwoFactorIdentifier();
            print "\nDigite seu código recebido: ";
            $handle = fopen ("php://stdin","r");
            $verificationCode = trim(fgets($handle));
            logM("\nRealizando login com o código de confirmação...\r");
            $ig->finishTwoFactorLogin($ig_username, $ig_password, $twoFactorIdentifier, $verificationCode);
        }
    } catch (\Exception $e) {
        if (strpos($e->getMessage(), "Challenge") !== false) {
            title();
            logM("\nConta sinalizada! Siga os seguintes passos:
            \n 1 - Desconecte sua conta de todos os dispositivos;
            \n 2 - Faça login no instagram.com neste computador;
            \n 3 - Confirme sua atividade de acesso;
            \n 4 - Tente acessar novamente este sistema.");
            system("PAUSE >nul");
            title();
            login($ig);
        }
        logM("\n ▲ FALHA NO LOGIN. VERIFIQUE SUAS CREDENCIAIS.");
        print "\n
┌───────────────────────────────┬───────┬───────┐
│ ● Deseja tentar novamente?    │  SIM  │  NÃO  │
└───────────────────────────────┴───────┴───────┘";
        print "\n ▌ ";
        $handle = fopen ("php://stdin","r");
        $line = trim(fgets($handle));
        if ($line == "sim" || $line == "SIM") {
            title();
            login($ig);
        } else {
            logM("\n ▲ SAINDO...");
            sleep(2);
            exit(1);
        }
    }
    logado($ig,$ig_username);
}
login($ig);

function logado($ig,$ig_username) {
    try {
        if (!$ig->isMaybeLoggedIn) {
            print "\n ▲ NÃO FOI POSSÍVEL ENTRAR! SAINDO...";
            exit();
        }
        
        $data = date("d/m/Y H:i:s");
        title();
        print "\n ■ LOGIN EFETUADO COM SUCESSO";
        print "\n
┌──────────┬────────────────────────┐
│ USUÁRIO: │ ". $ig_username."
├──────────┼────────────────────────┤
│ ACESSO:  │ ". $data."
└──────────┴────────────────────────┘";
        logM("\n ▲ PRESSIONE QUALQUER TECLA PARA INICIAR A TRANSMISSÃO...");
        system("PAUSE >nul");
        new_tunel($ig, $ig_username);
    } catch (\Exception $e) {
        logM("\n ▲ NÃO FOI POSSÍVEL ENTRAR! SAINDO...".$e->getMessage()."\n");
    }
}
// Bloco responsável por criar a transmissão ao vivo.
function new_tunel($ig, $ig_username) {
    logM(" ▲ GERANDO TÚNEL...");
    $stream = $ig->live->create();
    $broadcastId = $stream->getBroadcastId();
    $ig->live->start($broadcastId);
    // Alterne do URL de upload RTMPS para RTMP, pois o RTMPS não funciona bem.
    $streamUploadUrl = $stream->getUploadUrl();

    //Pegue a URL e a chave do fluxo.
    $split = preg_split("[".$broadcastId."]", $streamUploadUrl);

    $streamUrl = $split[0];
    $streamKey = $broadcastId.$split[1];
    $hora_inicio = date("d/m/Y H:i:s");
    $hora_fim = date('d/m/Y H:i:s', strtotime('+1 Hours'));
    title();
    $status_live = "ativada";
    $status_cmts = "ATIVADOS";
    print "\n ■ TRANSMISSÃO INICIADA";
    print "\n
┌──────────┬────────────────────────┐
│ USUÁRIO: │ ". $ig_username."
├──────────┼────────────────────────┤
│ ACESSO:  │ ". $hora_inicio."
└──────────┴────────────────────────┘";
    echo "
         ╭────────────────────────╮
─────────┘ ■ URL DE TRANSMISSÃO ■ └──────────────────────────────────────────────────────────────
$streamUrl
─────────────────────────────────────────────────────────────────────────────────────────────────";
    echo "
        ╭──────────────────────────╮
────────┘ ■ CHAVE DE TRANSMISSÃO ■ └─────────────────────────────────────────────────────────────
$streamKey
─────────────────────────────────────────────────────────────────────────────────────────────────";
    comandos();
    newCommand($ig->live, $broadcastId, $streamUrl, $streamKey,$ig,$ig_username,$hora_inicio,$hora_fim,$status_live,$status_cmts);
    logM("\n ▲ ALGO DEU SUPER ERRADO! TENTANDO CORRIGIR!");
    $ig->live->getFinalViewerList($broadcastId);
    $ig->live->end($broadcastId);
    return $status_live;
}

function comandos() {
    echo "                                                
                                                                                 ╭────────────╮
                                                                                 │  COMANDOS  │
    ╭───┬───┬──────────────────────────────────┬───┬───┬─────────────────────────┴──────────┬─┴─╮
    │   │ 1 │ ● Limpar tela do sistema         │   │ 2 │ ● Informações da transmissão       │   │
    │   ├───┼──────────────────────────────────┤   ├───┼────────────────────────────────────┤   │
    │   │ 3 │ ● URL de transmissão             │   │ 4 │ ● Chave de transmissão             │   │
    │   ├───┼──────────────────────────────────┤   ├───┼────────────────────────────────────┤   │
    │   │ 5 │ ● Desativar comentários          │   │ 6 │ ● Ativar comentários               │   │
    │   ├───┼──────────────────────────────────┤   ├───┼────────────────────────────────────┤   │
    │   │ 7 │ ● Espectadores atuais            │   │ 8 │ ● Janela de comentários            │   │
    │   ├───┼──────────────────────────────────┤   ├───┴┬───────────────────────────────────┤   │
    │   │ 9 │ ● Parar transmissão              │   │ 10 │● Contato dos desenvolvedores      │   │
    ╰───┴───┴──────────────────────────────────┴───┴────┴───────────────────────────────────┴───╯";
}

function contato() {
    print "\n\n ● CONTATOS:";
    print "
┌───────────┬─────────────────────────────────────────────────────┐
│ TELEFONE: │ +55 98 98348 6439                                   │
├───────────┼─────────────────────────────────────────────────────┤
│ E-MAIL:   │ grupoinovarcontato@gmail.com                        │
├───┬───────┴────────────┬───┬──────────────────┬───┬─────────────┤
│ 1 │ ● ENVIAR MENSAGEM  │ 2 │ ● ENVIAR E-MAIL  │ 3 │ ● CANCELAR  │
└───┴────────────────────┴───┴──────────────────┴───┴─────────────┘";
    return $rsp_contato = input_contato();
}
function input_contato() {
    print "\n ▌ ";
    $handle = fopen ("php://stdin","r");
    $line = trim(fgets($handle));
    if ($line == "1" || $line == "ENVIAR MENSAGEM" || $line == "enviar mensagem") {
        $rsp_contato = "\n\n ▲ JANELA PARA ENVIO DA MENSAGEM SERÁ INICIADA.\n";
        $link_msg = "https://api.whatsapp.com/send?phone=5598983486439&text=Ol%C3%A1%2C%20sou%20o%20usu%C3%A1rio%20do%20INSTALIVE%20GOLD%20Trial%20e%20preciso%20de%20um%20suporte."; 
        open_link($link_msg);
    } elseif ($line == "2" || $line == "ENVIAR E-MAIL" || $line == "enviar e-mail") {
        $rsp_contato = "\n\n ▲ JANELA PARA ENVIO DO E-MAIL SERÁ INICIADA.\n"; 
        shell_exec('start outlook.exe /c ipm.note /m "grupoinovarcontato@gmail.com&subject=SUPORTE%20INSTALIVE%20GOLD%20TRIAL&body="');
    } elseif ($line == "3" || $line == "CANCELAR" || $line == "cancelar") {
        $rsp_contato = false; 
    } else {
        print "\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!\n";
        return $rsp_contato = input_contato();
    }
    return $rsp_contato;        
}

function corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live) {
    title();
    if ($status_live == "desativada") {
        print "\n ■ TRANSMISSÃO FINALIZADA";
        print "\n
┌─────────┬─────────────────────────┐
│ INICIO: │ ". $hora_inicio."
├─────────┼─────────────────────────┤
│ FIM:    │ ". $hora_final_live."
└─────────┴─────────────────────────┘";
    }else{
        print "\n ■ TRANSMISSÃO EM ANDAMENTO";
        print "\n
┌──────────┬────────────────────────┐
│ USUÁRIO: │ ". $ig_username."
├──────────┼────────────────────────┤
│ INICIO:  │ ". $hora_inicio."
└──────────┴────────────────────────┘";
        comandos();
    }
}

function open_link($link) {
    $chrome = 'C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe';
    $edge = 'C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe';
    $firefox = 'C:\Program Files\Mozilla Firefox\firefox.exe';
    $iexplore = 'C:\Program Files\Internet Explorer\iexplore.exe';
    If (file_exists($chrome)){
        shell_exec("start chrome /incognito --app=". $link);
    } elseif (file_exists($edge)) {
        shell_exec("start shell:AppsFolder\Microsoft.MicrosoftEdge_8wekyb3d8bbwe!MicrosoftEdge -private ". $link;
    } elseif (file_exists($firefox)) {
        shell_exec("start firefox -private-window ". $link);
    } elseif (file_exists($iexplore)) {
        shell_exec("start iexplore -private ". $link);
    }else {
        shell_exec("start ". $link);
    }
}

function save_live($live, $broadcastId) {
    print "\n
┌──────────────────────────────────────────────────────────┬───────┬───────┐
│ ● Deseja manter a transmissão arquivada por 24 horas?    │  SIM  │  NÃO  │
└──────────────────────────────────────────────────────────┴───────┴───────┘";
    print "\n ▌ ";
    $handle = fopen ("php://stdin","r");
    $archived = trim(fgets($handle));
    if ($archived == 'sim' || $archived == 'SIM') {
        $live->addToPostLive($broadcastId);
        logM("\n ▲ TRANSMISSÃO AO VIVO SALVA!");
    } elseif ($archived == 'nao' || $archived == 'NAO' || $archived == 'não' || $archived == 'NÃO') {
        logM("\n ▲ TRANSMISSÃO AO VIVO NÃO FOI SALVA!");
    } else {
        logM("\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!");
        save_live($live, $broadcastId);
    }
}

function cmd_sair ($ig,$ig_username) {
    print "
┌───────────────────────────────────────────────────────────────────────────┬────────┬─────────────┐
│ ● Deseja sair do InstaLive Gold Trial ou iniciar uma nova transmissão?    │  SAIR  │  NOVA LIVE  │
└───────────────────────────────────────────────────────────────────────────┴────────┴─────────────┘";
    print "\n ▌ ";
    $handle = fopen ("php://stdin","r");
    $line = trim(fgets($handle));
    if ($line == "sair" || $line == "SAIR") {
        logM("\n ▲ SAINDO...");
        sleep(2);
        exit(0);
    } elseif ($line == "nova live" || $line == "NOVA LIVE") {
        new_tunel($ig, $ig_username);
    }else {
        logM("\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!");
        cmd_sair($ig,$ig_username);
    }
}

/**
 * O manipulador para interpretar os comandos transmitidos pela linha de comando.
 */
function newCommand(Live $live, $broadcastId, $streamUrl, $streamKey,$ig,$ig_username,$hora_inicio,$hora_fim,$status_live,$status_cmts) {
    print "\n ▌ ";
    $handle = fopen ("php://stdin","r");
    $line = trim(fgets($handle));
    if($line == 'ativar c' || $line == 'ATIVAR C' || $line == '6') {
        $live->enableComments($broadcastId);
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\n\n ▲ COMENTÁRIOS ATIVADOS!");
        $status_cmts = "ATIVADOS";
    } elseif ($line == 'desativar c' || $line == 'DESATIVAR C' || $line == '5') {
        $live->disableComments($broadcastId);
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\n\n ▲ COMENTÁRIOS DESATIVADOS!");
        $status_cmts = "DESATIVADOS";
    } elseif ($line == 'parar' || $line == 'PARAR' || $line == '9') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        print "\n
┌───────────────────────────────────────────────────┬───────┬───────┐
│ ● Deseja realmente finalizar esta transmissão?    │  SIM  │  NAO  │
└───────────────────────────────────────────────────┴───────┴───────┘";
        print "\n ▌ ";
        $handle = fopen ("php://stdin","r");
        $line = trim(fgets($handle));
        if ($line == 'sim' || $line == 'SIM') {
            fclose($handle);
            //Precisa disso para reter, eu acho?
            $live->getFinalViewerList($broadcastId);
            $live->end($broadcastId);
            $status_live = "desativada";
            $hora_final_live = date("d/m/Y H:i:s");
            corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
            save_live($live, $broadcastId);
            cmd_sair($ig,$ig_username);
        } else {
            corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
            logM("\n\n ▲ TRANSMISSÃO NÃO FINALIZADA");
        }
    } elseif ($line == 'url' || $line == 'URL' || $line == '3') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        echo "
         ╭────────────────────────╮
─────────┘ ■ URL DE TRANSMISSÃO ■ └──────────────────────────────────────────────────────────────
$streamUrl
─────────────────────────────────────────────────────────────────────────────────────────────────";
    } elseif ($line == 'key' || $line == 'KEY' || $line == '4') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        echo "
        ╭──────────────────────────╮
────────┘ ■ CHAVE DE TRANSMISSÃO ■ └─────────────────────────────────────────────────────────────
$streamKey
─────────────────────────────────────────────────────────────────────────────────────────────────";
    } elseif ($line == 'info' || $line == 'INFO' || $line == '2') {
        $info = $live->getInfo($broadcastId);
        $status = $info->getStatus();
        $muted = var_export($info->is_Messages(), true);
        $count = $info->getViewerCount();
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        print "\n\n ● INFORMAÇÕES DA TRANSMISSÃO:";
        print "
┌─────────────────┬───────────────────────────────┐
│ STATUS:         │ ". $status."
├─────────────────┼───────────────────────────────┤
│ COMENTÁRIOS:    │ ". $status_cmts."
├─────────────────┼───────────────────────────────┤
│ VISUALIZAÇÕES:  │ ". $count."
└─────────────────┴───────────────────────────────┘";
    } elseif ($line == 'viewers' || $line == 'VIEWERS' || $line == '7') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        print "\n\n ● VISUALIZADORES:";
        $live->getInfo($broadcastId);
        print "
┌────────────────────────────────────────────────────────────────┐";
        foreach ($live->getViewerList($broadcastId)->getUsers() as &$cuser) {
            print "
│ @".$cuser->getUsername()."  │  ".$cuser->getFullName();
        }
        print "\n
└────────────────────────────────────────────────────────────────┘";
    } elseif ($line == 'limpar' || $line == 'LIMPAR' || $line == '1') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
    } elseif ($line == 'comentarios' || $line == 'COMENTARIOS' || $line == '8') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\n\n ▲ ABRINDO JANELA DE COMENTÁRIOS...");
        $link_coments = "https://instagram.com/". $ig_username ."/live";
        open_link($link_coments);
        sleep(5);
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\n\n ▲ JANELA DE COMENTÁRIOS INICIADA! FAÇA LOGIN COM ESTA CONTA.");
    } elseif ($line == 'contato' || $line == 'CONTATO' || $line == '10') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        $rsp_contato = contato();
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        if ($rsp_contato != false) {
            print $rsp_contato;
        }        
    } else {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\n\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!");
    }
    fclose($handle);
    newCommand($ig->live, $broadcastId, $streamUrl, $streamKey,$ig,$ig_username,$hora_inicio,$hora_fim,$status_live,$status_cmts);
}

/**
 * Registra uma mensagem no console, mas na verdade usa novas linhas.
 */
function logM($message) {
    print $message."\n";
}