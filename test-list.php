<?php

function novo_limite ($limite) {
    $limite_fim = DateTime::createFromFormat('d/m/Y H:i:s', $limite);
    $limite_fim = date_format($limite_fim, 'YmdHis');
    return $limite_fim;
}

switch ($code) {
    case "#Z319N5": // Usuário: Pablo Marcony        
        $limite = "02/05/2022 00:00:00";
        $limite_fim = novo_limite($limite);
    break;
    case "#Z320V1": // Usuário: Pablo Marcony        
        $limite = "14/05/2020 00:00:00";
        $limite_fim = novo_limite($limite);
    break;
    default:
        $limite = "c-invalido";
    break;
}