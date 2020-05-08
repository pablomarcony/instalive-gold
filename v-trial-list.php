<?php
switch ($code) {
    case "#Z319N5":
        
        // Usuário: Pablo Marcony
        // Contato: ## ##### #### 
        // Limite: Ilimitado    

        $limite = "02/05/2022 00:00:00";
        $limite_fim = novo_limite($limite);
    break;
    case "#d5m5stage3":

        // Usuário: Stage3 Audiovisual
        // Contato: 98 98565 0742  
        // Limite: 10 dias (05/05/2020)  

        $limite = "15/05/2020 00:00:00";
        $limite_fim = novo_limite($limite);
    break;
    case "#d7m50790":

        // Usuário: Eduardo Rocha
        // Contato: 65 99247 0790 
        // Limite: 5 dias (05/05/2020)  

        $limite = "12/05/2020 23:59:59";
        $limite_fim = novo_limite($limite);
    break;
    case "#d8m56855":

        // Usuário: Gabriel Jung
        // Contato: 51 98431 6855 
        // Limite: 5 dias (05/05/2020)  

        $limite = "13/05/2020 23:59:59";
        $limite_fim = novo_limite($limite);
    break;
    default:
        $limite = "c-invalido";
    break;
}