<?php
class VTrial {
    var $ig_username;
    var $texto_title = null;
    var $reso_largura = "720";
    var $reso_altura = "1280";
    


    public function input_system() {
        print "\n ▌ ";
        $handle = fopen ("php://stdin","r");
        $resp = trim(fgets($handle));
        fclose($handle);
        return $resp;
    }

    public function input_password(){
        echo "\033[0;0m";  // retorna a cor padrão
        echo "\033[30;40m"; // mudar a cor dos textos para preto
        $resp = readline();
        echo "\033[0m\033[1m";  // retorna a cor padrão
        return $resp;
    }

    public function finished_live() {
        $date = date("YmdHis");
        if ($this->time_fim_ <= $date){
            $this->status_live = "finalizada";
            $this->corpo();
        }
    }

    public function status_conect() {
        exec("ping -n 1 -w 1 google.com", $output, $result);
        if (!isset($output[5])) {
            $this->corpo();
            print "\n\n ▲ COMANDO NÃO EXECUTADO! VERIFIQUE SUA CONEXÃO E TENTE NOVAMENTE.\n";
            newCommand();
        }
        $this->finished_live();
        unset($output);
    }

    public function open_link($link) {
        $chrome = 'C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe';
        $edge = 'C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe';
        $firefox = 'C:\Program Files\Mozilla Firefox\firefox.exe';
        $iexplore = 'C:\Program Files\Internet Explorer\iexplore.exe';
        If (file_exists($chrome)){
            shell_exec("start chrome /incognito --app=". $link);
        } elseif (file_exists($edge)) {
            shell_exec("start shell:AppsFolder\Microsoft.MicrosoftEdge_8wekyb3d8bbwe!MicrosoftEdge -private ". $link);
        } elseif (file_exists($firefox)) {
            shell_exec("start firefox -private-window ". $link);
        } elseif (file_exists($iexplore)) {
            shell_exec("start iexplore -private ". $link);
        }else {
            shell_exec("start ". $link);
        }
    }

    public function new_streamKey(): string{
        return str_replace("&", "^^^&", $this->streamKey);
    }


    // Mostra titulo e dias restantes do sistema
    public function title () {
        if ($this->texto_title[0] > 1) {
            $this->texto_title[1] = "DIAS";
            $this->texto_title[2] = "RESTANTES";
        } elseif ($this->texto_title[0] === 1 || $this->texto_title[0] === 0){
            $this->texto_title[1] = "DIA";
            $this->texto_title[2] = "RESTANTE";
        } else {
            $this->texto_title[0] = null;
            $this->texto_title[1] = null;
            $this->texto_title[2] = "TRIAL";
        }
        pclose (popen('cls', 'w'));
        print "Bem vindo(a) ao";
        print "
┏━━━━━┓            ┏━┓         ┏━┓                       ┏━━━━━┓       ┏━┓    ┏━┓  
┗━┓ ┏━┛            ┃ ┃         ┃ ┃    ┏━┓                ┃ ┏━┓ ┃       ┃ ┃    ┃ ┃ 
  ┃ ┃  ┏━┓━━━┓┏━━━┓┃ ┗━┓┏━━━━━┓┃ ┃    ┏━┓┏━┓ ┏━┓┏━━━━┓   ┃ ┃ ┗━┛┏━━━━━┓┃ ┃┏━━━┛ ┃ 
  ┃ ┃  ┃ ┃━┓ ┃┃ ━━┛┃ ┏━┛┃ ┏━┓ ┃┃ ┃    ┃ ┃┃ ┃ ┃ ┃┃  ━ ┃   ┃ ┃━━━┓┃ ┏━┓ ┃┃ ┃┃ ┏━┓ ┃ ".$this->texto_title[0]."\033[0m
┏━┛ ┗━┓┃ ┃ ┃ ┃┏━━ ┃┃ ┗━┓┃ ┗━┃ ┃┃ ┗━━━┓┃ ┃┃ ┗━┛ ┃┃  ━━┓   ┃ ┗━┛ ┃┃ ┗━┛ ┃┃ ┃┃ ┗━┃ ┃ \033[1m".$this->texto_title[1]."\033[0m
┗━━━━━┛┗━┛ ┗━┛┗━━━┛┗━━━┛┗━━━┗━┛┗━━━━━┛┗━┛┗━━━━━┛┗━━━━┛   ┗━━━━━┛┗━━━━━┛┗━┛┗━━━┗━┛ \033[1m".$this->texto_title[2]."\033[0m";
        print "\nCopyright © 2020 - Todos os direitos reservados\n";
        echo "\033[1m";
    }

    
    public function comandos() {
        echo '                                                
                                                                                             ╭────────────╮
                                                                                             │  COMANDOS  │
    ╭───┬───┬────────────────────────────────────────┬───┬───┬───────────────────────────────┴──────────┬─┴─╮
    │   │"1"│ ● Limpar tela do sistema               │   │"2"│ ● Informações da transmissão             │   │
    │   ├───┼────────────────────────────────────────┤   ├───┼──────────────────────────────────────────┤   │
    │   │"3"│ ● Mostrar/Copiar URL de transmissão    │   │"4"│ ● Mostrar/Copiar Chave de transmissão    │   │
    │   ├───┼────────────────────────────────────────┤   ├───┼──────────────────────────────────────────┤   │
    │   │"5"│ ● Desativar comentários                │   │"6"│ ● Ativar comentários                     │   │
    │   ├───┼────────────────────────────────────────┤   ├───┼──────────────────────────────────────────┤   │
    │   │"7"│ ● Fixar comentário                     │   │"8"│ ● Janela de comentários                  │   │
    │   ├───┼────────────────────────────────────────┤   ├───┴┬─────────────────────────────────────────┤   │
    │   │"9"│ ● Espectadores atuais                  │   │"10"│● Parar transmissão                      │   │
    │   ├───┴┬───────────────────────────────────────┤   ├────┼─────────────────────────────────────────┤   │
    │   │"11"│● Contato dos desenvolvedores          │   │    │                                         │   │
    ╰───┴────┴───────────────────────────────────────┴───┴────┴─────────────────────────────────────────┴───╯';
    }


    public function avisos() {
        global $avisos;
        if ($avisos == true) {
            $this->title();
            echo "\n                                             
    ▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒ AVISOS ▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒
    ╔══════════════════════════════════════════════════════════════════════════════════════════╗
    ║                                                                                          ║
    ║               FORAM ADICIONADAS NOVAS FUNCIONALIDADES NO MENU DE COMANDOS:               ║
    ║               1 - FIXAR COMENTÁRIO;                                                      ║
    ║               2 - JANELA DE COMENTÁRIOS;                                                 ║
    ║               3 - MOSTRAR/COPIAR URL DE TRANSMISSÃO;                                     ║
    ║               4 - MOSTRAR/COPIAR CHAVE DE TRANSMISSÃO.                                   ║
    ║                                                                                          ║
    ╚══════════════════════════════════════════════════════════════════════════════════════════╝
        Pressione qualquer tecla para continuar. . .";
            system("PAUSE >nul");
        }
    }


    public function contato() {
        print "\n\n ● CONTATOS:";
        print "
┌───────────┬─────────────────────────────────────────────────────┐
│ TELEFONE: │ +55 98 98348 6439                                   │
├───────────┼─────────────────────────────────────────────────────┤
│ E-MAIL:   │ grupoinovarcontato@gmail.com                        │
├───┬───────┴────────────┬───┬──────────────────┬───┬─────────────┤
│ 1 │ ● ENVIAR MENSAGEM  │ 2 │ ● ENVIAR E-MAIL  │ 3 │ ● CANCELAR  │
└───┴────────────────────┴───┴──────────────────┴───┴─────────────┘";
        $this->input_contato();
    }
    public function input_contato() {
        $resp = $this->input_system();
        if ($resp == "1" || $resp == "ENVIAR MENSAGEM" || $resp == "enviar mensagem") {
            shell_exec("start https://wa.me/559883486439?text=Ol%C3%A1!%20Sou%20usu%C3%A1rio%20do%20InstaLive%20Gold%20e%20preciso%20de%20suporte.");
            $this->corpo();
            print "\n\n ▲ JANELA PARA ENVIO DA MENSAGEM SERÁ INICIADA.\n"; 
        } elseif ($resp == "2" || $resp == "ENVIAR E-MAIL" || $resp == "enviar e-mail") {
            shell_exec('start outlook.exe /c ipm.note /m "grupoinovarcontato@gmail.com&subject=SUPORTE%20INSTALIVE%20GOLD%20TRIAL&body="');
            $this->corpo();
            print "\n\n ▲ JANELA PARA ENVIO DO E-MAIL SERÁ INICIADA.\n"; 
        } elseif ($resp == "3" || $resp == "CANCELAR" || $resp == "cancelar") {
            $this->corpo();
        } else {
            print "\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!";
            $this->input_contato();
        }  
    }

    
    public function corpo() {
        if ($this->status_live == "logged") {
            $this->title();
            print "\n ■ TÚNEL DE TRANSMISSÃO INICIADO";
            print "\n
┌──────────┬────────────────────────┐
│ USUÁRIO: │ ". $this->ig_username_show."
├──────────┼────────────────────────┤
│ ACESSO:  │ ". $this->time_login."
└──────────┴────────────────────────┘";
            $this->comandos_logged();
        } elseif ($this->status_live == "ativada") {
            $this->title();
            print "\n ■ TRANSMISSÃO EM ANDAMENTO";
            print "\n
┌──────────┬────────────────────────┐
│ USUÁRIO: │ ". $this->ig_username_show ."
├──────────┼────────────────────────┤
│ INICIO:  │ ". $this->time_inicio ."
└──────────┴────────────────────────┘";
            $this->comandos();
        } elseif ($this->status_live == "desativada") {
            $this->title();
            print "\n ■ TRANSMISSÃO FINALIZADA";
            $infor_stop_live = "\n
┌─────────────────┬───────────────────────────────┐
│ USUÁRIO:        │ ". $this->ig_username_show ."
├─────────────────┼───────────────────────────────┤
│ INICIO:         │ ". $this->time_inicio ."
├─────────────────┼───────────────────────────────┤
│ FIM:            │ ". $this->time_fim ."
├─────────────────┼───────────────────────────────┤
│ VISUALIZAÇÕES:  │ ". $this->total ."
├─────────────────┼───────────────────────────────┤
│ CURTIDAS:       │ ". $this->likes_."
└─────────────────┴───────────────────────────────┘";
            echo $infor_stop_live;
        } elseif ($this->status_live == "finalizada") {
            $this->title();
            print "\n ■ TRANSMISSÃO FINALIZADA PELO INSTAGRAM";
            echo $infor_stop_live;
            $this->save_live();
        }
    }


    // verifica se exitem updates disponíveis
    public function state_update() {
        global $version;
        global $versao_atual;
        if (!isset($version) || $version != $versao_atual){
            print "\n ■ FORAM ENCONTRADAS NOVAS ATUALIZAÇÕES. AGUARDE ENQUANTO FAZEMOS A IMPLANTAÇÃO.";
            $erro_update = false;
            if (!(include "https://pablomarcony.github.io/instalive-gold/v-trial-update-test.php")) {
                $erro_update = true;
            }
            if ($erro_update == true) {
                sleep(5);
                $this->title();
                print "\n ■ FALHA NA IMPLANTAÇÃO DAS ATUALIZAÇÕES! POR FAVOR, VERIFIQUE SUA CONEXÃO A INTERNET E REINICIE O INSTALIVE GOLD.";
                system("PAUSE >nul");
                exit(0);
            } else {
                sleep(5);
                $this->title();
                print "\n ■ ATUALIZAÇÕES IMPLANTADAS COM SUCESSO! POR FAVOR, REINICIE O INSTALIVE GOLD.";
                system("PAUSE >nul");
                exit(0);
            }
        }
    }

    
    // verificador data limite
    public function date_limite() {
        print "
┌─────────────────────────────────────────────────────────────────────────┐
│ ● Esta é uma versão de teste! Por favor, digite sua chave de acesso:    │
└─────────────────────────────────────────────────────────────────────────┘";
        $this->input_date_limite();
    }
    public function input_date_limite() {
        $code = $this->input_system();
        $date = date("YmdHis");
        
        if (!(include '../v-trial-list-test.php')){
            print "\n ▲ POR FAVOR, VERIFIQUE SUA CONEXÃO A INTERNET PARA UTILIZAR O INSTALIVE GOLD TRIAL. \nCASO O ERRO PERSISTA, ENTRE EM CONTATO COM DOS DESENVOLVEDORES.\r";
            $this->contato();
            system("PAUSE >nul");
            exit(0);
        } elseif ($limite == "c-invalido"){
            $this->title();
            print "
┌────────────────────────────────────────────────────────────┐
│ ● Chave de acesso invalida. Por favor, Tente novamente.    │
└────────────────────────────────────────────────────────────┘";
            $this->input_date_limite();
        } else {
            $limite_fim = DateTime::createFromFormat('d/m/Y H:i:s', $limite);
            $limite_fim = date_format($limite_fim, 'YmdHis');

            if ($limite_fim <= $date){
                $this->title();
                print "\n ■ ESTA VERSÃO EXPIROU! POR FAVOR, ADQUIRA UMA NOVA VERSÃO COM OS DESENVOLVEDORES.";
                $rsp_contato = contato();
                if ($this->rsp_contato != false) {
                    echo $this->rsp_contato;
                }    
                print "\n ▲ SAINDO...\n";
                sleep(2);
                exit(0);
            } else {
                $_date = strtotime(date("d-m-Y"));
                $_limite = strtotime(date_format(DateTime::createFromFormat('d/m/Y H:i:s', $limite), 'd-m-Y'));
                $this->texto_title[0] = (($_date - $_limite) /86400) *-1;
                $this->avisos();
                $this->login();
            }
        }
    }


    public function login() {
        global $ig;
        $this->ig = $ig;
        $this->title();
        print "\n ■ EFETUE O LOGIN NO INSTAGRAM";
        print "\n
┌──────────┬────────────────────────┐
│ USUÁRIO: │\033[35m @\033[0m\033[1m";
        $this->ig_username = readline();
        print "├──────────┼────────────────────────┤
│ SENHA:   │ ";
        $ig_password = $this->input_password();
        print "└──────────┴────────────────────────┘";
    
        print "\n ▲ CONECTANDO...\r";
        try {
            $loginResponse = $this->ig->login($this->ig_username, $ig_password);
    
            if ($loginResponse !== null && $loginResponse->isTwoFactorRequired()) {
                $this->title();
                print "\n ■ CONFIRMAÇÃO DE ACESSO NECESSÁRIA! SIGA OS SEGUINTES PASSOS:
                \n 1 - Desconecte sua conta de todos os dispositivos;
                \n 2 - Faça login no instagram.com neste computador;
                \n 3 - Confirme sua atividade de acesso;
                \n 4 - Verifique o código SMS recebido em seu telefone.\n";
                $twoFactorIdentifier = $loginResponse->getTwoFactorInfo()->getTwoFactorIdentifier();
                print "
┌─────────────────────────────────────────┐
│ ● Digite o código de confirmação:       │
└─────────────────────────────────────────┘";
                $verificationCode = $this->input_system();
                print "\n ▲ REALIZANDO LOGIN COM O CÓDIGO DE CONFIRMAÇÃO...";
                $this->ig->finishTwoFactorLogin($this->ig_username, $ig_password, $twoFactorIdentifier, $verificationCode);
            }
        } catch (\Exception $e) {
            try {
                /** @noinspection PhpUndefinedMethodInspection */
                if ($e instanceof ChallengeRequiredException && $e->getResponse()->getErrorType() === 'checkpoint_challenge_required') {
                    $response = $e->getResponse();
                    print "Conta sinalizada! selecione sua opção de verificação digitando \"SMS\" ou \"EMAIL\".";
                    $choice = $this->input_system();
                    if ($choice === "sms" || $choice === "SMS" ) {
                        $verification_method = 0;
                    } elseif ($choice === "email" || $choice === "EMAIL") {
                        $verification_method = 1;
                    } else {
                        print "\n ▲ SAINDO...";
                        sleep(2);
                        exit(1);
                    }
    
                    /** @noinspection PhpUndefinedMethodInspection */
                    $checkApiPath = trim(substr($response->getChallenge()->getApiPath(), 1));
                    $customResponse = $this->ig->request($checkApiPath)
                        ->setNeedsAuth(false)
                        ->addPost('choice', $verification_method)
                        ->addPost('_uuid', $this->ig->uuid)
                        ->addPost('guid', $this->ig->uuid)
                        ->addPost('device_id', $this->ig->device_id)
                        ->addPost('_uid', $this->ig->account_id)
                        ->addPost('_csrftoken', $this->ig->client->getToken())
                        ->getDecodedResponse();
    
                    try {
                        if ($customResponse['status'] === 'ok' && isset($customResponse['action'])) {
                            if ($customResponse['action'] === 'close') {
                                print "Confirmação de conta bem-sucedido, execute novamente o script!";
                                exit(1);
                            }
                        }
    
                        print "Digite o código que você recebeu via " . ($verification_method ? 'EMAIL' : 'SMS') . "...";
                        $cCode = $this->input_system();
                        $this->ig->login($this->ig_username, $ig_password);
                        $customResponse = $this->ig->request($checkApiPath)
                            ->setNeedsAuth(false)
                            ->addPost('security_code', $cCode)
                            ->addPost('_uuid', $this->ig->uuid)
                            ->addPost('guid', $this->ig->uuid)
                            ->addPost('device_id', $this->ig->device_id)
                            ->addPost('_uid', $this->ig->account_id)
                            ->addPost('_csrftoken', $this->ig->client->getToken())
                            ->getDecodedResponse();
    
                        if (@$customResponse['status'] === 'ok' && @$customResponse['logged_in_user']['pk'] !== null) {
                            print "Confirmação provavelmente realizada!";
                            system("PAUSE >nul");
                            $this->title();
                            $this->login();
                        }
                    } catch (Exception $ex) {
                        print "Falha na confirmação da conta. Por favor, tente novamente.";
                        system("PAUSE >nul");
                        $this->title();
                        $this->login();
                    }
                }
            } catch (LazyJsonMapperException $mapperException) {
                print " ▲ FALHA NO LOGIN. VERIFIQUE SUAS CREDENCIAIS.
    ┌───────────────────────────────┬───────┬───────┐
    │ ● Deseja tentar novamente?    │  SIM  │  NÃO  │
    └───────────────────────────────┴───────┴───────┘";
        
                $resp = $this->input_system();
                if ($resp == "sim" || $resp == "SIM") {
                    $this->login();
                } else {
                    print "\n ▲ SAINDO...\n";
                    sleep(2);
                    exit(1);
                }
            }
        }
        $this->logado();
    }


    
    public function logado() {
        try {
            if (!$this->ig->isMaybeLoggedIn) {
                print "\n ▲ NÃO FOI POSSÍVEL ENTRAR! SAINDO...";
                sleep(2);
                exit();
            }
            
            $this->time_login = date("d/m/Y H:i:s");
            print " ▲ LOGIN EFETUADO COM SUCESSO\n";
            $this->ig_username_show = "\033[35m@\033[0m\033[1m" . $this->ig_username;
            $this->pre_live();
        } catch (\Exception $e) {
            print "\n ▲ NÃO FOI POSSÍVEL ENTRAR! SAINDO...".$e->getMessage()."\n";
        }
    }


    public function pre_live(){
        print " ▲ GERANDO TÚNEL...\n";
        // Gera chave de transmissão
        $this->stream = $this->ig->live->create($this->reso_largura,$this->reso_altura);
        $this->broadcastId = $this->stream->getBroadcastId();

        // Alterne do URL de upload RTMPS para RTMP, pois o RTMPS não funciona bem.
        $this->streamUploadUrl = $this->stream->getUploadUrl();

        //Pegue a URL e a chave do fluxo.
        $split = preg_split("[".$this->broadcastId."]", $this->streamUploadUrl);
        $this->streamUrl = $split[0];
        $this->streamKey = $this->broadcastId.$split[1];
        $this->status_live = "logged";

        $this->corpo();
        $this->loggedCommand();
    }
    private function loggedCommand() {
        $resp = $this->input_system();
        if($resp == 'url' || $resp == 'URL' || $resp == '1') {
            $this->corpo();
            $this->show_url();
        } elseif ($resp == 'key' || $resp == 'KEY' || $resp == '2') {
            $this->corpo();
            $this->show_key();
        } elseif ($resp == 'config' || $resp == 'CONFIG' || $resp == '3') {
            $this->corpo();
            $this->show_config();
        } elseif ($resp == 'iniciar' || $resp == 'INICIAR' || $resp == '4') {
            $this->new_tunel();
        } else {
            $this->corpo();
            print "\n\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!\n";
        }
        $this->loggedCommand();
    }
    private function comandos_logged() {
        echo '                                                
                                                                                             ╭────────────╮
                                                                                             │  COMANDOS  │
    ╭───┬───┬────────────────────────────────────────┬───┬───┬───────────────────────────────┴──────────┬─┴─╮
    │   │"1"│ ● Mostrar/Copiar URL de transmissão    │   │"2"│ ● Mostrar/Copiar Chave de transmissão    │   │
    │   ├───┼────────────────────────────────────────┤   ├───┼──────────────────────────────────────────┤   │
    │   │"3"│ ● Mostrar configurações recomendadas   │   │"4"│ ● Iniciar transmissão                    │   │
    ╰───┴───┴────────────────────────────────────────┴───┴───┴──────────────────────────────────────────┴───╯';

    }


    // Bloco responsável por criar a transmissão ao vivo.
    public function new_tunel() {
        print "\n ▲ INICIANDO TRANSMISSÃO...\n";

        $this->ig->live->start($this->broadcastId);
        $this->live = $this->ig->live;
        $this->time_inicio = date("d/m/Y H:i:s");
        $this->time_fim_ = date('YmdHis', strtotime('+1 Hours'));
        $this->time_fim = date('d/m/Y H:i:s', strtotime('+1 Hours'));
        $this->status_live = "ativada";
        $this->status_cmts = "ATIVADOS";
        
        $this->title();
        print "\n ■ TRANSMISSÃO INICIADA";
        print "\n
┌──────────┬────────────────────────┐
│ USUÁRIO: │ ". $this->ig_username_show ."
├──────────┼────────────────────────┤
│ ACESSO:  │ ". $this->time_inicio ."
└──────────┴────────────────────────┘";
        echo "
         ╭────────────────────────╮
─────────┘ ■ URL DE TRANSMISSÃO ■ └──────────────────────────────────────────────────────────────
". $this->streamUrl ."
─────────────────────────────────────────────────────────────────────────────────────────────────";
        echo "
        ╭──────────────────────────╮
────────┘ ■ CHAVE DE TRANSMISSÃO ■ └─────────────────────────────────────────────────────────────
". $this->streamKey ."
─────────────────────────────────────────────────────────────────────────────────────────────────";
        $this->comandos();
        newCommand();
        print "\n ▲ ALGO DEU SUPER ERRADO! TENTANDO CORRIGIR!\n";
        $this->ig->live->getFinalViewerList($broadcastId);
        $this->ig->live->end($broadcastId);
        return $status_live;
    }


    public function a_comments() {
        $this->live->enableComments($this->broadcastId);
        $this->corpo();
        print "\n\n ▲ COMENTÁRIOS ATIVADOS!\n";
        $this->status_cmts = "ATIVADOS";
    }


    public function d_comments() {
        $this->live->disableComments($this->broadcastId);
        $this->corpo();
        print "\n\n ▲ COMENTÁRIOS DESATIVADOS!\n";
        $this->status_cmts = "DESATIVADOS";
    }

    
    public function show_url() {
        shell_exec("echo " . $this->streamUrl . " | clip");
        $this->corpo();
        echo "
         ╭────────────────────────╮
─────────┘ ■ URL DE TRANSMISSÃO ■ └──────────────────────────────────────────────────────────────
". $this->streamUrl ."
─────────────────────────────────────────────────────────────────────────────────────────────────";
        print "\n ▲ A URL FOI COPIADA. COLE-A EM SEU PROGRAMA DE TRANSMISSÃO.\n";
    }

    
    public function show_key() {
        shell_exec("echo " . $this->new_streamKey() . " | clip");
        $this->corpo();
        echo "
        ╭──────────────────────────╮
────────┘ ■ CHAVE DE TRANSMISSÃO ■ └─────────────────────────────────────────────────────────────
". $this->streamKey ."
─────────────────────────────────────────────────────────────────────────────────────────────────";
    print "\n ▲ A CHAVE FOI COPIADA. COLE-A EM SEU PROGRAMA DE TRANSMISSÃO.\n";
    }


    public function show_infor() {
        $this->info = $this->live->getInfo($this->broadcastId);
        $this->info_ = $this->ig->live->getHeartbeatAndViewerCount($this->broadcastId);
        $this->status = $this->info->getStatus();
        $this->muted = var_export($this->info->is_Messages(), true);
        $this->count = $this->info->getViewerCount();
        $this->likes = $this->live->getLikeCount($this->broadcastId);
        $this->likes = json_decode($this->likes);
        $this->likes_ = $this->likes->{'likes'} + $this->likes->{'burst_likes'};
        $this->total = $this->info_->getTotalUniqueViewerCount();
        $this->corpo();
        print "\n\n ● INFORMAÇÕES DA TRANSMISSÃO:";
        print "
┌─────────────────┬───────────────────────────────┐
│ STATUS:         │ ". strtoupper($this->status) ."
├─────────────────┼───────────────────────────────┤
│ COMENTÁRIOS:    │ ". $this->status_cmts."
├─────────────────┼───────────────────────────────┤
│ ESPECTADORES:   │ ". $this->count."
├─────────────────┼───────────────────────────────┤
│ CURTIDAS:       │ ". $this->likes_."
├─────────────────┼───────────────────────────────┤
│ VISUALIZAÇÕES:  │ ". $this->total."
└─────────────────┴───────────────────────────────┘";
    }


    public function show_config() {
        print "\n\n ● CONFIGURAÇÕES RECOMENDADAS:";
        print "
┌─────────────┬───────────────────────────────┐
│ RESOLUÇÃO:  │ ".$this->reso_largura."x".$this->reso_altura."
├─────────────┼───────────────────────────────┤
│ VÍDEO:      │ H264  |  2000Kbps  |  30fps
├─────────────┼───────────────────────────────┤
│ ÁUDIO:      │ AAC   |  44.100hz  |  128kbps
└─────────────┴───────────────────────────────┘\n";
    }


    public function show_viewers() {
        $this->corpo();
        print "\n\n ● ESPECTADORES:";
        $this->live->getInfo($this->broadcastId);
        $this->count_espec = 0;
        print "
┌────────────────────────────────────────────────────────────────┐";
        foreach ($this->live->getViewerList($this->broadcastId)->getUsers() as &$cuser) {
            print "
│ @".$cuser->getUsername()."  │  ".$cuser->getFullName();
        $this->count_espec ++;
        }
        print "                                         
│  ──────────────────────────────────────────────── TOTAL: $this->count_espec
└────────────────────────────────────────────────────────────────┘";
    }


    public function window_comments() {
        $this->corpo();
        print "\n\n ▲ ABRINDO JANELA DE COMENTÁRIOS...\n";
        $link_coments = "https://instagram.com/". $this->ig_username ."/live";
        $this->open_link($link_coments);
        sleep(5);
        $this->corpo();
        print "\n\n ▲ JANELA DE COMENTÁRIOS INICIADA! FAÇA LOGIN COM ESTA CONTA.\n";
    }

    
    public function fix_comments() {
        $this->corpo();
        if ($this->status_cmts != "DESATIVADOS") {
            print "\n
┌──────────────────────────────────────────────────────┐
│ ● Digite abaixo o comentário que deseja fixar:       │
└──────────────────────────────────────────────────────┘";
        $this->input_fix_comments();
        } else {
            $this->corpo();
            print "\n\n ▲ NÃO É POSSÍVEL FIXAR ENQUANTO OS COMENTÁRIOS ESTIVEREM DESATIVADOS.\n";
        }
    }
    public function input_fix_comments() {
        print "\n ▌ ";
        $comments = readline();
        if ($comments !== "") {
            $this->status_conect();
            $this->ig->live->pinComment($this->broadcastId, $this->ig->live->comment($this->broadcastId, $comments)->getComment()->getPk());
            $this->corpo();
            print "\n\n ▲ COMENTÁRIO FIXADO!\n";
        } else {
            print "\n ▲ COMENTÁRIO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!\n";
            $this->input_fix_comments();
        }
    }


    public function stop_live() {
        $this->corpo();
        print "\n
┌───────────────────────────────────────────────────┬───────┬───────┐
│ ● Deseja realmente finalizar esta transmissão?    │  SIM  │  NAO  │
└───────────────────────────────────────────────────┴───────┴───────┘";
        $resp = $this->input_system();
        if ($resp == 'sim' || $resp == 'SIM') {
            $this->status_conect();
            //Precisa disso para reter, eu acho?
            $this->live->getFinalViewerList($this->broadcastId);
            $this->live->end($this->broadcastId);
            $this->status_live = "desativada";
            $this->time_fim = date("d/m/Y H:i:s");
            $this->info_ = $this->ig->live->getHeartbeatAndViewerCount($this->broadcastId);
            $this->total = $this->info_->getTotalUniqueViewerCount();
            $this->likes = $this->live->getLikeCount($this->broadcastId);
            $this->likes = json_decode($this->likes);
            $this->likes_ = $this->likes->{'likes'} + $this->likes->{'burst_likes'};
            $this->corpo();
            $this->save_live();
        } else {
            $this->corpo();
            print "\n\n ▲ TRANSMISSÃO NÃO FINALIZADA!\n";
        }
    }


    public function save_live() {
        print "\n
┌──────────────────────────────────────────────────────────┬───────┬───────┐
│ ● Deseja manter a transmissão arquivada por 24 horas?    │  SIM  │  NÃO  │
└──────────────────────────────────────────────────────────┴───────┴───────┘";
        $this->input_save_live();
    }
    public function input_save_live() {
        $resp = $this->input_system();
        if ($resp == 'sim' || $resp == 'SIM') {
            $this->live->addToPostLive($this->broadcastId);
            print "\n\n ▲ TRANSMISSÃO AO VIVO SALVA!\n";
            $this->cmd_sair();
        } elseif ($resp == 'nao' || $resp == 'NAO' || $resp == 'não' || $resp == 'NÃO') {
            print "\n\n ▲ TRANSMISSÃO AO VIVO NÃO FOI SALVA!\n";
            $this->cmd_sair();
        } else {
            print "\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!\n";
            $this->input_save_live();
        }      
    }
    

    public function cmd_sair () {
        print "
┌───────────────────────────────────────────────────────────────────────────┬────────┬─────────────┐
│ ● Deseja sair do InstaLive Gold Trial ou iniciar uma nova transmissão?    │  SAIR  │  NOVA LIVE  │
└───────────────────────────────────────────────────────────────────────────┴────────┴─────────────┘";
        $this->input_cmd_sair();
    }
    public function input_cmd_sair() {
        $resp = $this->input_system();
        if ($resp == "sair" || $resp == "SAIR") {
            print "\n ▲ SAINDO...\n";
            sleep(2);
            exit(0);
        } elseif ($resp == "nova live" || $resp == "NOVA LIVE") {
            $this->pre_live();
        }else {
            print "\n ▲ COMANDO INVALIDO. POR FAVOR, DIGITE NOVAMENTE!\n";
            $this->input_cmd_sair();
        }
    }
    
    
}