<?php

require_once("../templates/footer.php");

if (isset($_GET['id'])) {
    $hortaId = $_GET['id'];
} else {
    echo "Horta não encontrada";
}
$url = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/usuario/3';
$response = file_get_contents($url);
$data = json_decode($response, true);

$urlHorta = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta';
$responseHorta = file_get_contents($urlHorta);
$dataHorta = json_decode($responseHorta, true);

$urlImgHorta = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta/busca/foto/';

?>


<?php foreach ($dataHorta as $horta): ?>
    <?php if ($horta['id'] == $hortaId): ?>
        <h2>
            <?php echo $horta['nomeHorta']; ?>
        </h2>
        <p>Localização:
            <?php echo $horta['latitude'] . ', ' . $horta['longitude']; ?>
        </p>
        <p>Proprietário:
            <?php echo $horta['usuario']['nome']; ?>
        </p>

        <?php foreach ($horta['imagems'] as $imagem): ?>
            <img src="<?php echo $urlImgHorta . $imagem['ds_nome']; ?>" alt="<?php echo $imagem['ds_nome']; ?>"
                style="width: 200px; margin: 5px;">
        <?php endforeach; ?>

    <?php endif; ?>
<?php endforeach; ?>