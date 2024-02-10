<!-- teste_carro.php -->
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function obterDados() {
    $url = "http://93.104.213.107/sharing/8cacef2890a0d46a58814b0da0e13298";

    // Obtém o conteúdo da página
    $html = file_get_contents($url);

    // Use expressões regulares para encontrar o script
    $pattern = '/<script.*?>(.*?)<\/script>/is';
    preg_match_all($pattern, $html, $matches);

    if (!empty($matches[1])) {
        foreach ($matches[1] as $scriptContent) {
            if (strpos($scriptContent, 'app.sharingInit') !== false) {
                $pattern2 = '/\$\((window)\)\.on\("load", function\(\) {(.+?)\}\);/is';
                preg_match_all($pattern2, $scriptContent, $matches2);

                // Verifica se houve correspondências
                if (!empty($matches2[2])) {
                    // Itera sobre as correspondências encontradas
                    foreach ($matches2[2] as $match) {
                        // Remove a chamada da função
                        $cleanedContent = str_replace(['app.sharingInit(', ');'], '', $match);

                        // Remove os caracteres "\n" e espaços em branco antes do início do array JSON
                        $cleanedContent2 = preg_replace('/^\s+/', '', $cleanedContent);

                        // Remove as barras invertidas antes de decodificar a string JSON
                        $cleanedContent3 = stripslashes($cleanedContent2);

                        // Retorna os dados JSON formatados
                        return $cleanedContent3;
                    }
                } else {
                    return 'Conteúdo não encontrado dentro do padrão.';
                }
            }
        }
    } else {
        return 'Scripts não encontrados ou padrão não corresponde.';
    }
}

// Chamada da função para fornecer dados quando incluído em outros scripts
return obterDados();
?>
