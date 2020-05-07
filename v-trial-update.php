<?php
// abre o arquivo colocando o ponteiro de escrita no final 
$arquivo = fopen('../dir/inclus.php','r+');
if ($arquivo != false) { 
    // move o ponteiro para o inicio pois o ftruncate() nao fara isso 
    rewind($arquivo); 
    // truca o arquivo apagando tudo dentro dele 
    ftruncate($arquivo, 0); 

    // dados a serem colocados no arquivo
    $new_text = '<?php
require_once __DIR__."/vendor/autoload.php";
$version = 1.6;

if ((@include "https://pablomarcony.github.io/instalive-gold/v-trial-2.php") == FALSE) {
    echo "\e[H\e[J";
    echo "\nFalha no carregamento! Por favor, verifique sua conexão a internet para utilizar o sistema.";
    echo "\nCaso o erro persista, entre em contato com dos desenvolvedores.";
    system("PAUSE >nul");
}
    ';

    // reescreve o conteudo dentro do arquivo 
    if (fwrite($arquivo, $new_text)) {
        $erro_update = true;        
    } else {
        fclose($arquivo);
    }
} else {
    $erro_update = true;
}

sleep(5);