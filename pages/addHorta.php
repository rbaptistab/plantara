<?php

require_once("../templates/footer.php");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
} else {
    echo "Usuário não encontrada";
}

// Permitir solicitações de qualquer origem (CUIDADO: Usar '*' em produção pode ser um risco de segurança)
header("Access-Control-Allow-Origin: http://localhost:81");

// Permitir credenciais
header("Access-Control-Allow-Credentials: true");

// Permitir métodos HTTP especificados
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// Permitir cabeçalhos personalizados
header("Access-Control-Allow-Headers: Content-Type, Authorization");

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

                <h1><span class="">Nova Horta</span></h1>
                <form class="row g-3 form-cadastro" id="form-cadastro-horta">
                    <div class="d-flex">
                        <div class="col-md-3 me-3">
                            <label for="nome" class="form-label">Nome da horta</label>
                            <input type="text" class="form-control" id="nomeHorta">
                        </div>

                        <div class="col-md-3 me-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="ativo" selected>Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="col-md-2 me-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude">
                        </div>

                        <div class="col-md-2 me-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude">
                        </div>
                    </div>


                    <div class="col-12">
                        <button type="submit" class="btn btn-primary botao-cadastrar">Cadastrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>

<script>
    $('#form-cadastro-horta').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta',
            method: 'POST',
            data: JSON.stringify({
                nomeHorta: $('#nomeHorta').val(),
                status: $('#status').val(),
                longitude: $('#longitude').val(),
                latitude: $('#latitude').val(),
                usuario: {
                    id: <?php echo $userId ?>
                }
            }),
            contentType: 'application/json',
            crossDomain: true,
            xhrFields: {
                withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
            },
            success: function (response) {
                toastr.success('Horta cadastrada com sucesso!', 'Sucesso');
                window.location.href = "../index.php";
            },
            error: function () {
                $('#mensagem').text('Erro ao processar a requisição.');
            }
        })
    })
</script>