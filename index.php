<?php

require_once("templates/footer.php");

$url = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/usuario/1';
$response = file_get_contents($url);
$data = json_decode($response, true);

$urlHorta = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta';
$responseHorta = file_get_contents($urlHorta);
$dataHorta = json_decode($responseHorta, true);

$urlImgHorta = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta/busca/foto/';

$urlUsuarios = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/usuario';
$responseUsuarios = file_get_contents($urlUsuarios);
$usuarios = json_decode($responseUsuarios, true);

?>
<link rel="stylesheet" href="/plantara/css/style.css">

<html>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php
                require_once("templates/menu.php"); ?>
            </div>
            <div class="col-md-10 titulo-page">
                <div>
                    <?php
                    require_once("templates/header.php");
                    ?>
                </div>

                <div class="body-index">
                    <p class="bem-vindo"> Bem vindo!</p>
                    <label for="selectUsuario">Selecione um usuário:</label>
                    <select id="selectUsuario" class="form-select">
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?php echo $usuario['id']; ?>">
                                <?php echo $usuario['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p>Selecione qual espaço deseja acessar</p>
                </div>


                <?php

                foreach ($userHortas as $item):
                    ?>

                    <a href="#" class="link-horta" data-horta-id="<?php echo $item['id']; ?>">
                        <div class="card card-horta">
                            <div class="row">
                                <div class="col-md-4 card-logo">
                                    <img src="<?php echo $urlImgHortaCompleta; ?>" class="" alt="" style="width:30%">
                                </div>
                                <div class="col-md-8 nome-horta">
                                    <div class="">
                                        <?php echo $item['nomeHorta'] ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>

                <a class="adicionar-horta" href="pages/addHorta.php?id=1">
                    <div>
                        <img src="assets/adicionar.png" class="" alt="">&emsp;&emsp;
                    </div>
                    <div>
                        Adicionar nova horta
                    </div>
                </a>

            </div>
        </div>
    </div>

</body>

</html>

<script>
    $('#selectUsuario').change(function () {
        var userIdSelecionado = $(this).val();

        // Atualize dinamicamente os links de horta com base no usuário selecionado
        $('.link-horta').each(function () {
            var hortaId = $(this).data('horta-id');
            var novoLink = '/pages/paginaHorta.php?id=' + hortaId + '&userId=' + userIdSelecionado;
            $(this).attr('href', novoLink);
        });
    });
</script>
