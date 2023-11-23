<?php
require_once("templates/footer.php");

// $url = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/usuario/1';
// $response = file_get_contents($url);
// $data = json_decode($response, true);

$urlUsuarios = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/usuario';
$responseUsuarios = file_get_contents($urlUsuarios);
$usuarios = json_decode($responseUsuarios, true);

$urlHorta = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta';
$responseHorta = file_get_contents($urlHorta);
$dataHorta = json_decode($responseHorta, true);

$urlImgHorta = 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta/busca/foto/';
?>
<link rel="stylesheet" href="/plantara/css/style.css">

<html>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php require_once("templates/menu.php"); ?>
            </div>
            <div class="col-md-10 titulo-page">
                <div>
                    <?php require_once("templates/header.php"); ?>
                </div>

                <div class="body-index">
                    <p class="bem-vindo"> Bem vindo!</p>
                    <label for="selectUsuario">Selecione um usuário:</label>
                    <select id="selectUsuario" class="form-select">
                        <option selected> Selecione</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?php echo $usuario['id']; ?>">
                                <?php echo $usuario['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p>Selecione qual espaço deseja acessar</p>
                </div>
                <ul id="listaHortas"></ul>
                <div id="esconder-botao">
                           <a class="adicionar-horta" href="">
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
    </div>

</body>

</html>

<script>
    // Certifique-se de que o script é executado após o carregamento do DOM
    $(document).ready(function () {
        // Adicione a classe 'hidden' no carregamento inicial
        $('#esconder-botao').hide();

        $('#selectUsuario').change(function () {
            var userIdSelecionado = $(this).val();

            console.log(userIdSelecionado);

            // Remova a classe 'hidden' do link para torná-lo visível
            $('.adicionar-horta').removeClass('hidden');

            // Atualize o atributo 'href' do link com o ID do usuário selecionado
            $('.adicionar-horta').attr('href', 'pages/addHorta.php?id=' + userIdSelecionado);

            $.ajax({
                url: 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta',
                method: 'GET',
                success: function (dataHorta) {
                    dadosHorta = dataHorta;
                    console.log(dadosHorta);
                    $('#listaHortas').empty();

                    // Itere sobre os hortas e crie elementos HTML para exibir na tela
                    for (var i = 0; i < dadosHorta.length; i++) {
                        var horta = dadosHorta[i];
                        var userIdDoHorta = horta.usuario.id;

                        console.log(userIdDoHorta);

                        // Verifique se o userIdDoHorta é igual ao userIdSelecionado
                        if (userIdDoHorta == userIdSelecionado) {
                            // Crie elementos HTML conforme necessário
                            var divUsuarioHorta = $('<a>').addClass('usuario-horta'); // Alterado para um link
                            divUsuarioHorta.attr('href', 'pages/paginaHorta.php?id=' + horta.id); // Adicionado o atributo href com o ID da horta
                            var divCardHorta = $('<div>').addClass('card card-horta');
                            var divRow = $('<div>').addClass('row');
                            var divCardLogo = $('<div>').addClass('col-md-4 card-logo');
                            var imgLogo = $('<img>').addClass('').attr('alt', '').css('width', '30%');
                            var divNomeHorta = $('<div>').addClass('col-md-8 nome-horta');
                            var divNomeHortaInner = $('<div>').text(horta.nomeHorta);

                            // Construa a estrutura HTML
                            divCardLogo.append(imgLogo);
                            divRow.append(divCardLogo);
                            divRow.append(divNomeHorta);
                            divNomeHorta.append(divNomeHortaInner);
                            divCardHorta.append(divRow);
                            divUsuarioHorta.append(divCardHorta);
                            $('#esconder-botao').show();

                            // Adicione o item à lista
                            $('#listaHortas').append(divUsuarioHorta);

                            console.log(horta.imagems[0].ds_nome);

                            $.ajax({
                                url: 'http://ec2-3-144-163-238.us-east-2.compute.amazonaws.com:8080/horta/busca/foto/' + horta.imagems[0].ds_nome,
                                method: 'GET',
                                success: function (imagemData) {
                                    // Atualize a imagem com os dados obtidos
                                    imgLogo.attr('src', imagemData);
                                },
                                error: function () {
                                    console.log('Erro ao obter a imagem da horta.');
                                }
                            });
                        }
                    }
                },
                error: function () {
                    console.log('Erro ao obter os hortas do usuário.');
                }
            });
        });
    });
</script>