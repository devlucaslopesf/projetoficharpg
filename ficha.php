<?php

$host = 'localhost'; 
$dbname = 'ficha'; 
$username = 'root'; 
$password = ''; 

try {
    // Cria uma conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_POST) {
        // Captura os dados
        $player_name = htmlspecialchars(trim($_POST['player_name']));
        $character_name = htmlspecialchars(trim($_POST['character_name']));
        $age = htmlspecialchars(trim($_POST['age']));
        $class = htmlspecialchars(trim($_POST['class']));
        $race = htmlspecialchars(trim($_POST['race']));
        $background = htmlspecialchars(trim($_POST['background']));
        
        // Captura os atributos
        $forca = htmlspecialchars(trim($_POST['forca']));
        $destreza = htmlspecialchars(trim($_POST['destreza']));
        $constituicao = htmlspecialchars(trim($_POST['constituicao']));
        $inteligencia = htmlspecialchars(trim($_POST['inteligencia']));
        $sabedoria = htmlspecialchars(trim($_POST['sabedoria']));
        $carisma = htmlspecialchars(trim($_POST['carisma']));
        
        $equipment = htmlspecialchars(trim($_POST['equipment']));
        $notes = htmlspecialchars(trim($_POST['notes']));

        // Exibe os dados (opcional)
        ?>

    
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ficha de Personagem</title>
            <link rel="stylesheet" href="stylephp.css"> 
        </head>
        <body>

        <div class="container">
            <h1>Ficha de Personagem</h1>
            <p><strong>Nome do Jogador:</strong> <?php echo $player_name; ?></p>
            <p><strong>Nome do Personagem:</strong> <?php echo $character_name; ?></p>
            <p><strong>Idade:</strong> <?php echo $age; ?></p>
            <p><strong>Classe:</strong> <?php echo $class; ?></p>
            <p><strong>Raça:</strong> <?php echo $race; ?></p>
            <h3>Background</h3>
            <p><?php echo $background; ?></p>
            <h3>Atributos</h3>
            <p>Força: <?php echo $forca; ?></p>
            <p>Destreza: <?php echo $destreza; ?></p>
            <p>Constituição: <?php echo $constituicao; ?></p>
            <p>Inteligência: <?php echo $inteligencia; ?></p>
            <p>Sabedoria: <?php echo $sabedoria; ?></p>
            <p>Carisma: <?php echo $carisma; ?></p>
            <h3>Equipamento</h3>
            <p><?php echo $equipment; ?></p>
            <h3>Anotações</h3>
            <p><?php echo $notes; ?></p>

        <?php

        // Prepara a consulta SQL para inserir os dados
        $stmt = $pdo->prepare("INSERT INTO personagens 
            (player_name, character_name, age, class, race, background, forca, destreza, constituicao, inteligencia, sabedoria, carisma, equipment, notes) 
            VALUES 
            (:player_name, :character_name, :age, :class, :race, :background, :forca, :destreza, :constituicao, :inteligencia, :sabedoria, :carisma, :equipment, :notes)");

        // Liga os parâmetros
        $stmt->bindParam(':player_name', $player_name);
        $stmt->bindParam(':character_name', $character_name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':race', $race);
        $stmt->bindParam(':background', $background);
        $stmt->bindParam(':forca', $forca);
        $stmt->bindParam(':destreza', $destreza);
        $stmt->bindParam(':constituicao', $constituicao);
        $stmt->bindParam(':inteligencia', $inteligencia);
        $stmt->bindParam(':sabedoria', $sabedoria);
        $stmt->bindParam(':carisma', $carisma);
        $stmt->bindParam(':equipment', $equipment);
        $stmt->bindParam(':notes', $notes);

        // Executa a consulta
        if ($stmt->execute()) {
            echo '<div class="success-message">Dados salvos com sucesso!</div>';
        } else {
            echo '<div class="error-message">Erro ao salvar os dados.</div>';
        }

        ?>
        </div>
        </body>
        </html>

        <?php
    } else {
        echo "<p>Formulário não enviado corretamente.</p>";
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
