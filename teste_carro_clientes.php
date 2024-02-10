<?php
// Inclui o script e obtém os dados
$cleanedContent2 = include('teste_carro.php');

// Decodifica a string JSON em um array associativo
$jsonData2 = json_decode($cleanedContent2, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tabela de Dados</h1>
    <div>
        <label for="">Pesquisar</label>
        <input type="search" placeholder="Pesquise aqui...">
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Velocidade</th>
            </tr>
        </thead>
        <tbody>
        <p>
        <?php
            $totalVeiculos = count($jsonData2);
            echo "Total de Veículos Rastreados: $totalVeiculos";
        ?>
        </p>

        <?php
            $veiculosMovimento = array_filter($jsonData2, function($veiculo) {
                return $veiculo['speed'] > 0;
            });

            $veiculosParados = array_filter($jsonData2, function($veiculo) {
                return $veiculo['speed'] == 0;
            });

            echo "Veículos em Movimento: " . count($veiculosMovimento) . "<br>";
            echo "Veículos Parados: " . count($veiculosParados) . "<br>";
        ?>

        <?php
            $distanciaTotal = array_sum(array_column($jsonData2, 'total_distance'));
            echo "Distância Total Percorrida: $distanciaTotal km";
        ?>


            <?php
            // Verifica se a decodificação foi bem-sucedida
            if ($jsonData2 !== null) {
                
                // Itera sobre os dispositivos no JSON e exibe na tabela
                foreach ($jsonData2 as $device) {
                    echo "<tr>";
                    echo "<td>{$device['id']}</td>";
                    echo "<td>{$device['name']}</td>";
                    echo "<td>{$device['lat']}</td>";
                    echo "<td>{$device['lng']}</td>";
                    echo "<td>{$device['speed']}</td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="5">Erro ao decodificar JSON.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>

<script>
    // Função para recarregar a página a cada 5 segundos
    setInterval(function() {
        location.reload();
    }, 10000); // 5000 milissegundos = 5 segundos
</script>

</html>
