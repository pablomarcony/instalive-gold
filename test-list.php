<?php
switch ($code) {
    case "#Z319N5": // Usuário: Pablo Marcony        
        $limite = "02-05-2022 17:40";
        $limite = DateTime::createFromFormat('d/m/Y H:i', $limite);
    break;
    case "#Z320V1": // Usuário: Pablo Marcony        
        $limite = "14/05/2020 00:00:00";
        $limite = DateTime::createFromFormat('d/m/Y H:i:s', $limite);
    break;
    default:
        $limite = "c-invalido";
    break;
}