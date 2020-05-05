<?php
switch ($code) {
    case "#Z319N5": // Usuário: Pablo Marcony        
        $limite = "02/05/2022 00:00:00";
        $limite_fim = novo_limite($limite);
    break;
    case "#d5m5stage3": // Usuário: Pablo Marcony        
        $limite = "15/05/2020 00:00:00";
        $limite_fim = novo_limite($limite);
    break;
    default:
        $limite = "c-invalido";
    break;
}