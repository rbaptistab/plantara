<?php

require_once("../templates/footer.php");

$url = 'http://apiadvisor.climatempo.com.br/api/v1/anl/synoptic/locale/BR?token=ab396b7adba95e1520e7933b5550aa04';
$response = file_get_contents($url);
$data = json_decode($response, true);

// $urlHorta = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta';
// $responseHorta = file_get_contents($urlHorta);
// $dataHorta = json_decode($responseHorta, true);

// $urlImgHorta = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta/busca/foto/';


?>
<html>
<link rel="stylesheet" href="/plantara/css/style.css">

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php
                require_once("../templates/menu.php"); ?>
            </div>
            <div class="col-md-10 titulo-page">
                <div>
                    <?php
                    require_once("../templates/header.php");
                    ?>
                </div>

                <h1><span class="">Previsão do tempo</span></h1>

                <h3>Previsão geral</h3>
                <?php echo $data[0]['text'] ?>
                
            </div>
        </div>
    </div>

</body>

</html>