<?php
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
set_time_limit(0);
date_default_timezone_set('America/Sao_Paulo');

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
 \___/ |_| |_||___/\___|\___,_|\_____/|_|  \_/  \____|   \_____/\_____/|_|\___,_| V-Teste 1.9
    ");
    logM("Copyright © 2020 - Todos os direitos reservados");
    echo $texto_title;
}
title();


// verificador de updates
if (isset($version) == false || $version != 1.9){
    echo "\nForam encontradas novas atualizações. Aguarde enquanto fazemos a implantação.";
    if ((@include "https://pablomarcony.github.io/instalive-gold/v-trial-update-test.php") == FALSE) {
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

function avisos() {
    $avisos == true;
    if ($avisos = true) {
        title();
        logM("\n\n                                             AVISO DE MANUTENÇÃO:                                                 
    #--------------------------------------------------------------------------------------------------------#
                NOSSO SERVIDOR PASSARÁ POR MANUTENÇÃO DE MELHORIAS NO DIA 08/05/2020 ÀS 04:00H COM 
                DURAÇÃO MÉDIA DE 10 MINUTOS. DURANTE ESTE PERÍODO ALGUNS USUÁRIOS PODERÃO SOFRER 
                INSTABILIDADES AO UTILIZAR O SISTEMA.
    #--------------------------------------------------------------------------------------------------------#
        Pressione \"ENTER\" para continuar...");
        system("PAUSE >nul");
    }
}

function contato() {
    logM("\nCONTATOS:");
    logM("Telefone: +55 98 98348-6439");
    logM("Email: pablomarconyjf@gmail.com");
}

function novo_limite ($limite) {
    $_limite_fim = DateTime::createFromFormat('d/m/Y H:i:s', $limite);
    $limite_fim = date_format($_limite_fim, 'YmdHis');
    return $limite_fim;
}

logM("\nEsta é uma versão de teste! Por favor, digite sua chave de acesso:");
function date_teste() {
    print "> ";
    
    $handle = fopen ("php://stdin","r");
    $code = trim(fgets($handle));
    $limite = null;
    $date = date("YmdHis");
    
    include 'https://pablomarcony.github.io/instalive-gold/v-trial-list.php';
    if ($limite == null){
        logM("\nPor favor, verifique sua conexão a internet para utilizar o InstaLive Gold Trial. \nCaso o erro persista, entre em contato com dos desenvolvedores.");
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
        $_date = strtotime(date("d-m-Y"));
        $_limite = strtotime(date_format(DateTime::createFromFormat('d/m/Y H:i:s', $limite), 'd-m-Y'));
        $dias_left = (($_date - $_limite) /86400) *-1;
        $texto_title = "ESTA É UMA VERSÃO TRIAL. VOCÊ TEM ". $dias_left ." DIAS RESTANTES.\n";
        avisos();
        title();
        echo $texto_title;
        define("TEXTO_TITLE", $texto_title);
    }
}
date_teste();
$texto_title = TEXTO_TITLE;
function comandos() {
    logM("\n                                                 COMANDOS:                                              
    #--------------------------------------------------------------------------------------------------------#
    |  \"1\" ou \"LIMPAR\" - Limpa a tela do sistema          \"2\" ou \"INFO\" - Mostra informações da transmissão  |
    |  \"3\" ou \"URL\" - Mostra a URL da transmissão         \"4\" ou \"CHAVE\" - Mostra a chave da transmissão     |
    |  \"5\" ou \"DESATIVAR C\" - Desativa os comentários     \"6\" ou \"ATIVAR C\" - Ativa os comentários           |
    |  \"7\" ou \"VIEWERS\" - Espectadores atuais             \"8\" ou \"COMENTARIOS\" - Abre janela da comentários  |
    |  \"9\" ou \"PARAR\" - Interrompe a transmissão          \"10\" ou \"CONTATO\" - Contato dos desenvolvedores    |
    #--------------------------------------------------------------------------------------------------------#");
}

use InstagramAPI\Exception\ChallengeRequiredException;
use InstagramAPI\Instagram;
use InstagramAPI\Request\Live;
use LazyJsonMapper\Exception\LazyJsonMapperException;
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
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            if ($e instanceof ChallengeRequiredException && $e->getResponse()->getErrorType() === 'checkpoint_challenge_required') {
                $response = $e->getResponse();
                logM("Conta sinalizada! selecione sua opção de verificação digitando \"SMS\" ou \"EMAIL\".");
                $handle = fopen ("php://stdin","r");
                $choice = trim(fgets($handle));
                if ($choice === "sms" || $choice === "SMS" ) {
                    $verification_method = 0;
                } elseif ($choice === "email" || $choice === "EMAIL") {
                    $verification_method = 1;
                } else {
                    logM("Saindo!");
                    exit(1);
                }

                /** @noinspection PhpUndefinedMethodInspection */
                $checkApiPath = trim(substr($response->getChallenge()->getApiPath(), 1));
                $customResponse = $ig->request($checkApiPath)
                    ->setNeedsAuth(false)
                    ->addPost('choice', $verification_method)
                    ->addPost('_uuid', $ig->uuid)
                    ->addPost('guid', $ig->uuid)
                    ->addPost('device_id', $ig->device_id)
                    ->addPost('_uid', $ig->account_id)
                    ->addPost('_csrftoken', $ig->client->getToken())
                    ->getDecodedResponse();

                try {
                    if ($customResponse['status'] === 'ok' && isset($customResponse['action'])) {
                        if ($customResponse['action'] === 'close') {
                            logM("Confirmação de conta bem-sucedido, execute novamente o script!");
                            exit(1);
                        }
                    }

                    logM("Digite o código que você recebeu via " . ($verification_method ? 'EMAIL' : 'SMS') . "...");
                    $handle = fopen ("php://stdin","r");
                    $cCode = trim(fgets($handle));
                    $ig->login($ig_username, $ig_password);
                    $customResponse = $ig->request($checkApiPath)
                        ->setNeedsAuth(false)
                        ->addPost('security_code', $cCode)
                        ->addPost('_uuid', $ig->uuid)
                        ->addPost('guid', $ig->uuid)
                        ->addPost('device_id', $ig->device_id)
                        ->addPost('_uid', $ig->account_id)
                        ->addPost('_csrftoken', $ig->client->getToken())
                        ->getDecodedResponse();

                    if (@$customResponse['status'] === 'ok' && @$customResponse['logged_in_user']['pk'] !== null) {
                        logM("Confirmação provavelmente realizada!");
                        system("PAUSE >nul");
                        title();
                        login($ig);
                    }
                } catch (Exception $ex) {
                    logM("Falha na confirmação da conta. Por favor, tente novamente.");
                    system("PAUSE >nul");
                    title();
                    login($ig);
                }
            }
        } catch (LazyJsonMapperException $mapperException) {
            echo 'Falha no login. Verifique suas credenciais.';
            logM("\nDeseja tentar novamente? \"SIM\" \ \"NAO\"");
            print "> ";
            $handle = fopen ("php://stdin","r");
            $line = trim(fgets($handle));
            if ($line == "sim" || $line == "SIM") {
                title();
                login($ig);
            } else {
                exit(1);
            }
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
    logM("\nTúnel de transmissão iniciado!");
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
        logM("\nLogin efetuado com sucesso!");
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
        logM("\nTúnel de transmissão em andamento!");
        logM("\nUsuário: ". $ig_username);
        logM("Inicio: ". $hora_inicio);
        logM("Limite do Instagram: ". $hora_fim);
        comandos();
    }
}

function open_coments($ig_username) {
    $chrome = 'C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe';
    $edge = 'C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe';
    $firefox = 'C:\Program Files\Mozilla Firefox\firefox.exe';
    $iexplore = 'C:\Program Files\Internet Explorer\iexplore.exe';
    If (file_exists($chrome)){
        shell_exec("start chrome /incognito --app=https://instagram.com/". $ig_username ."/live");
    } elseif (file_exists($edge)) {
        shell_exec("start shell:AppsFolder\Microsoft.MicrosoftEdge_8wekyb3d8bbwe!MicrosoftEdge -private https://instagram.com/".$ig_username."/live");
    } elseif (file_exists($firefox)) {
        shell_exec("start firefox -private-window https://instagram.com/". $ig_username ."/live");
    } elseif (file_exists($iexplore)) {
        shell_exec("start iexplore -private https://instagram.com/". $ig_username ."/live");
    }else {
        shell_exec("start https://instagram.com/". $ig_username ."/live");
    }
}

function save_live($live, $broadcastId) {
    logM("\nDeseja manter a transmissão arquivada por 24 horas? \"SIM\" \ \"NAO\"");
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
    logM("\nDeseja sair do InstaLive Gold Trial ou iniciar uma nova transmissão? \"SAIR\" \ \"NOVA LIVE\"");
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
        logM("\nDeseja realmente finalizar esta transmissão? \"SIM\" \ \"NAO\"");
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
    } elseif ($line == 'limpar' || $line == 'LIMPAR' || $line == '1') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
    } elseif ($line == 'comentarios' || $line == 'COMENTARIOS' || $line == '8') {
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\nAbrindo janela de comentários...");
        open_coments($ig_username);
        sleep(3);
        corpo($ig_username,$hora_inicio,$hora_fim,$status_live,$hora_final_live);
        logM("\nJanela de comentários iniciada! Faça login com esta conta.");
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


class ExtendedInstagram extends Instagram
{
    public function changeUser($ig_username, $ig_password)
    {
        $this->_setUser($ig_username, $ig_password);
    }
}