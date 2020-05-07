<?php
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');


// abre o arquivo colocando o ponteiro de escrita no final 
$arquivo = fopen('../dir/inclu.php','r+');
if ($arquivo) { 
    /*
    while(true) { 
        $linha = fgets($arquivo); 
        if ($linha==null) break; 
        // busca na linha atual o conteudo que vai ser alterado 
        if(preg_match("/José da Silva:/", $linha)) { 
            $string .= str_replace("José da Silva: 27 anos", "José da Silva: 28 anos", $linha); 
        } else { 
            // vai colocando tudo numa nova string 
            $string.= $linha; 
        } 
    } 
    */

    // move o ponteiro para o inicio pois o ftruncate() nao fara isso 
    rewind($arquivo); 
    // truca o arquivo apagando tudo dentro dele 
    ftruncate($arquivo, 0); 
    $new_text .= "<?php
require_once __DIR__.'/vendor/autoload.php';

if ((@include 'https://pablomarcony.github.io/instalive-gold/v-trial-2.php') == FALSE) {
    echo '\e[H\e[J';
    echo '\nFalha no carregamento! Por favor, verifique sua conexão a internet para utilizar o sistema.';
    echo '\nCaso o erro persista, entre em contato com dos desenvolvedores.';
    system('PAUSE >nul');
}
    ";
    // reescreve o conteudo dentro do arquivo 
    if (!fwrite($arquivo, $new_text)) die('Não foi possível atualizar o arquivo.'); 
    echo 'Arquivo atualizado com sucesso'; fclose($arquivo); 
}



system("PAUSE >nul");



system('title InstaLive Gold Trial');
system('break off');
echo "\e[H\e[J";
if (php_sapi_name() !== "cli") {
    die("Você só pode executar isso dentro da linha de comando do PHP!");
}

$texto_title = "";
function title () {
    global $texto_title;
    echo "\e[H\e[J";
    logM("Bem vindo(a) ao");
    logM(" _____              _           _      _                  _____         _      _  
|_   _|            | |         | |    (_)                |  __ \       | |    | | 
  | |   _ __   ___ | |_   __ _ | |     _ __   __  ___    | |  \/  ___  | |  __| | 
  | |  | '_ \ / __|| __| / _` || |    | |\ \ / / / _ \   | | __  / _ \ | | / _` | 
 _| |_ | | | |\__ \| |_ | (_| || |____| | \ V / |  __/   | |_\ \| (_) || || (_| | 
 \___/ |_| |_||___/\___|\___,_|\_____/|_|  \_/  \____|   \_____/\_____/|_|\___,_| Versão de pre-teste 2.0
    ");
    logM("Copyright © 2020 - Todos os direitos reservados - Pablo Marcony");
    echo $texto_title;
}

set_time_limit(0);
date_default_timezone_set('America/Sao_Paulo');
function contato() {
    logM("\nCONTATOS:");
    logM("Telefone: +55 98 98348-6439");
    logM("Email: pablomarconyjf@gmail.com");
}
function novo_limite ($limite) {
    $limite_fim = DateTime::createFromFormat('d/m/Y H:i:s', $limite);
    $limite_fim = date_format($limite_fim, 'YmdHis');
    return $limite_fim;
}
title();
logM("\nEsta é uma versão de teste! Por favor, digite sua chave de acesso:");
function date_teste() {
    print "> ";
    $handle = fopen ("php://stdin","r");
    $code = trim(fgets($handle));
    $limite = null;
    $date = date("YmdHis");
    include 'https://pablomarcony.github.io/instalive-gold/test-list.php';
    if ($limite == null){
        logM("\nPor favor, verifique sua conexão a internet para utilizar o sistema. \nCaso o erro persista, entre em contato com dos desenvolvedores.");
        contato();
        system("PAUSE >nul");
        exit(0);
    } elseif ($limite == "c-invalido"){
        title();
        logM("\nChave de acesso invalida. Por favor, Tente novamente.");
        date_teste();
    } elseif ($limite_fim <= $date){
        title();
        logM("\nEsta versão de teste expirou! Por favor, adquira uma nova versão com os desenvolvedores.");
        contato();
        system("PAUSE >nul");
        exit(0);
    } else {
        title();
        logM("VERSÃO DE TESTE VALIDA ATÉ: $limite");
        $texto_title = "VERSÃO DE TESTE VALIDA ATÉ: ". $limite ."\n";
        define("TEXTO_TITLE", $texto_title);
    }
}
date_teste();
$texto_title = TEXTO_TITLE;
function comandos() {
    logM("\n                                                 COMANDOS:                                              
    #--------------------------------------------------------------------------------------------------------#
    |  \"1\" ou \"HELP\" - Mostra esta mensagem               \"2\" ou \"INFO\" - Mostra informações da transmissão  |
    |  \"3\" ou \"URL\" - Mostra a URL da transmissão         \"4\" ou \"CHAVE\" - Mostra a chave da transmissão     |
    |  \"5\" ou \"DESATIVAR C\" - Desativa os comentários     \"6\" ou \"ATIVAR C\" - Ativa os comentários           |
    |  \"7\" ou \"VIEWERS\" - Espectadores atuais             \"8\" ou \"LIMPAR\" - Limpa a tela do sistema          |
    |  \"9\" ou \"PARAR\" - Interrompe a transmissão          \"10\" ou \"CONTATO\" - Contato dos desenvolvedores    |
    #--------------------------------------------------------------------------------------------------------#");
}


use InstagramAPI\Instagram;
use InstagramAPI\Request\Live;
$debug = false;
$truncatedDebug = false;
$ig = new Instagram($debug, $truncatedDebug);
function login($ig) {    
    logM("\nDigite os dados de acesso a conta no instagram.");
    //Login no Instagram
    print "\nUsuário: ";
    $handle = fopen ("php://stdin","r");
    $ig_username = trim(fgets($handle));
    print "Senha: ";
    $handle = fopen ("php://stdin","r");
    $ig_password = trim(fgets($handle));

    echo "\nFazendo login no Instagram...\r";
    try {
        $loginResponse = $ig->login($ig_username, $ig_password);

        if ($loginResponse !== null && $loginResponse->isTwoFactorRequired()) {
            logM("Confirmação de acesso necessários! Siga os seguintes passos:
            \n 1 - Faça login no instagram.com neste computador;
            \n 2 - Confirme sua atividade de acesso (CASO SOLICITADO);
            \n 3 - POR ÚLTIMO, verifique o código SMS recebido em seu telefone.");
            $twoFactorIdentifier = $loginResponse->getTwoFactorInfo()->getTwoFactorIdentifier();
            print "\nDigite seu código recebido: ";
            $handle = fopen ("php://stdin","r");
            $verificationCode = trim(fgets($handle));
            logM("Realizando login com o código de confirmação...");
            $ig->finishTwoFactorLogin($ig_username, $ig_password, $twoFactorIdentifier, $verificationCode);
        }
    } catch (\Exception $e) {
        if (strpos($e->getMessage(), "Challenge") !== false) {
            title();
            logM("\nConta sinalizada! Siga os seguintes passos:
            \n 1 - Faça login no instagram.com neste computador;
            \n 2 - Confirme sua atividade de acesso (CASO SOLICITADO);
            \n 3 - Tente acessar novamente este sistema.");
            system("PAUSE >nul");
            title();
            login($ig);
        }
        echo 'Falha no login. Verifique suas credenciais.';
        logM("\nDeseja tentar novamente? \"SIM\" \ \"NAO\"");
        print "> ";
        $handle = fopen ("php://stdin","r");
        $line = trim(fgets($handle));
        if ($line == "sim" || $line == "SIM") {
            title();
            login($ig);
        } else {
            exit(0);
        }
    }
    logado($ig,$ig_username);
}
login($ig);

// Bloco responsável por criar a transmissão ao vivo.
function new_tunel($ig, $ig_username) {
    logM("\nGerando túnel...");
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
    logM("Túnel de transmissão iniciado!");
    $status_live = "ativada";
    $status_cmts = "Ativados";
    logM("\nUsuário: ". $ig_username);
    logM("Inicio: ". $hora_inicio);
    logM("Limite do Instagram: ". $hora_fim);
    logM("\n================================ URL de Transmissão ================================\n".$streamUrl."\n================================ URL de Transmissão ================================");

    logM("\n======================== Chave de Transmissão ========================\n".$streamKey."\n======================== Chave de Transmissão ========================");

    logM("\n^^ Inicie a transmissão no programa da sua preferencia com a URL e a chave acima ^^");
    comandos();
    newCommand($ig->live, $broadcastId, $streamUrl, $streamKey,$ig,$ig_username,$hora_inicio,$hora_fim,$status_live,$status_cmts);
    logM("Algo deu super errado! Tentativa de pelo menos limpar!");
    $ig->live->getFinalViewerList($broadcastId);
    $ig->live->end($broadcastId);
    return $status_live;
}
function logado($ig,$ig_username) {
    try {
        if (!$ig->isMaybeLoggedIn) {
            logM("Não foi possível entrar! Saindo...");
            exit();
        }
        
        $data = date("d/m/Y H:i:s");
        title();
        logM("Login efetuado com sucesso!");
        logM("\nUsuário: ". $ig_username);
        logM("Acesso: ". $data);
    
        print "\nPressione qualquer tecla para iniciar a transmissão.";
        system("PAUSE >nul");
        new_tunel($ig, $ig_username);
    } catch (\Exception $e) {
        echo 'Erro ao criar transmissão ao vivo: '.$e->getMessage()."\n";
    }
}

function corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live) {
    title();
    if ($status_live == "desativada") {
        logM("\nTransmissão finalizada com sucesso!");
        logM("\nInicio: ". $hora_inicio);
        logM("Fim: ". $hora_final_live);
    }else{
        logM("Túnel de transmissão em andamento!");
        logM("\nUsuário: ". $ig_username);
        logM("Inicio: ". $hora_inicio);
        logM("Limite do Instagram: ". $hora_fim);
        comandos();
    }
}


function save_live($live, $broadcastId) {
    logM("\nDeseja manter a transmissão arquivada por 24 horas? \"SIM\" para confirmar \ \"NAO\" para negar");
    print "> ";
    $handle = fopen ("php://stdin","r");
    $archived = trim(fgets($handle));
    if ($archived == 'sim' || $archived == 'SIM') {
        $live->addToPostLive($broadcastId);
        logM("Transmissão ao vivo salva!");
    } elseif ($archived == 'nao' || $archived == 'NAO' || $archived == 'não' || $archived == 'NÃO') {
        logM("Transmissão ao vivo não foi salva!");
    } else {
        logM("Comando inválido. Por favor, digite novamente!");
        save_live($live, $broadcastId);
    }
}


function cmd_sair ($ig,$ig_username) {
    logM("\nDeseja sair do sistema ou iniciar uma nova transmissão? \"SAIR\" para sair \ \"NOVA LIVE\" para iniciar nova transmissão");
    print "> ";
    $handle = fopen ("php://stdin","r");
    $line = trim(fgets($handle));
    if ($line == "sair" || $line == "SAIR") {
        logM("\nSaindo...");
        sleep(2);
        exit(0);
    } elseif ($line == "nova live" || $line == "NOVA LIvE") {
        new_tunel($ig, $ig_username);
    }else {
        logM("Comando inválido. Por favor, digite novamente!");
        cmd_sair($ig,$ig_username);
    }
}

/**
 * O manipulador para interpretar os comandos transmitidos pela linha de comando.
 */
function newCommand(Live $live, $broadcastId, $streamUrl, $streamKey,$ig,$ig_username,$hora_inicio,$hora_fim,$status_live,$status_cmts) {
    print "\n> ";
    $handle = fopen ("php://stdin","r");
    $line = trim(fgets($handle));
    if($line == 'ativar c' || $line == 'ATIVAR C' || $line == '6') {
        $live->enableComments($broadcastId);
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\nComentários ativados!");
        $status_cmts = "Ativados";
    } elseif ($line == 'desativar c' || $line == 'DESATIVAR C' || $line == '5') {
        $live->disableComments($broadcastId);
        $status_cmts = "Desativados";
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\nComentários desativados!");
    } elseif ($line == 'parar' || $line == 'PARAR' || $line == '9') {
        logM("\nDeseja realmente finalizar esta transmissão? \"SIM\" para confirmar \ \"NAO\" para cancelar");
        print "> ";
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
            logM("\nTransmissão não finalizada.");
        }
    } elseif ($line == 'url' || $line == 'URL' || $line == '3') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\n================================ URL de Transmissão ================================\n".$streamUrl."\n================================ URL de Transmissão ================================");
    } elseif ($line == 'key' || $line == 'KEY' || $line == '4') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\n======================== Chave de Transmissão ========================\n".$streamKey."\n======================== Chave de Transmissão ========================");
    } elseif ($line == 'info' || $line == 'INFO' || $line == '2') {
        $info = $live->getInfo($broadcastId);
        $status = $info->getStatus();
        $muted = var_export($info->is_Messages(), true);
        $count = $info->getViewerCount();
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\nInformações da Transmissão:\n\nStatus: $status\nComentários: $status_cmts\nVisualizações: $count");
    } elseif ($line == 'viewers' || $line == 'VIEWERS' || $line == '7') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\nVisualizadores:");
        $live->getInfo($broadcastId);
        foreach ($live->getViewerList($broadcastId)->getUsers() as &$cuser) {
            logM("@".$cuser->getUsername()." (".$cuser->getFullName().")");
        }
    } elseif ($line == 'limpar' || $line == 'LIMPAR' || $line == '8') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
    } elseif ($line == 'ajuda' || $line == 'AJUDA' || $line == '1') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
    } elseif ($line == 'contato' || $line == 'CONTATO' || $line == '10') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        contato();        
    } else {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\nComando inválido. Digite \"AJUDA\" para obter ajuda!");
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