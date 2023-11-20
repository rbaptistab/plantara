<link rel="stylesheet" href="/plantara/css/style.css">

<div class="container-fluid container-menu">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3.5 min-vh-100" style="background: #F2F2F2;">
            <div class="d-flex flex-column justify-content-between p-2">
                <ul class="nav nav-pills mt-4 d-flex flex-column justify-content-end">
                    <li class="nav-item">
                        <a href=""
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('agenda.php'); ?>">
                            <img src="/plantara/assets/icon-map.png"></img><span class="">Localização</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href=""
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('clientes.php'); ?>">
                            <img src="/plantara/assets/icon-plant.png"></img><span class="">Cultivos</span>
                        </a>
                    </li>
                    <li class="nav-item usuario">
                        <a href=""
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('profissionais.php'); ?>">
                            <img src="/plantara/assets/icon-recomen.png"></img><span class="">Recomendações</span>
                        </a>
                    <li class="nav-item usuario">
                        <a href="/plantara/pages/previsaoTempo.php"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('especialidade.php'); ?>">
                            <img src="/plantara/assets/icon-prev.png"></img><span class="">Previsão do tempo</span>
                        </a>
                    </li>
                    <li class="nav-item usuario">
                        <a href=""
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('servicos.php'); ?>">
                            <img src="/plantara/assets/icon-vizi.png"></img><span class="">Minha Vizinhança</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a onclick="sair()" href="#" class="nav-link d-flex justify-content-between">
                            <i class="fa-solid fa-solid fa-arrow-right-from-bracket"></i><span class="">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
function isActivePage($page)
{
    if (basename($_SERVER['PHP_SELF']) === $page) {
        echo 'active';
    }
}
?>
<script>
    $(document).ready(function () {
        $('.nav-link').click(function () {
            $('.nav-link').removeClass('active'); // Remove a classe "active" de todos os links
            $(this).addClass('active'); // Adiciona a classe "active" ao link clicado
        });
    });

</script>