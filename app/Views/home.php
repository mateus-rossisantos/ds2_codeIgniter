<!DOCTYPE html>
<html>

<head>
    <?php

    use App\Models\InscricaoModel;

    $session = session(); ?>
    <title>ConfBrasil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            background-color: #f2f2f2;
            /* cor de fundo cinza claro */
            border-radius: 10px;
            /* cantos arredondados */
            margin-bottom: 20px;
            /* espaçamento inferior entre os cards */
            padding: 20px;
            /* espaçamento interno */
        }

        .red {
            color: lightcoral;
        }
    </style>
</head>

<body>
    <header class="bg-light py-3">
        <div class="container d-flex align-items-center">
            <?php
            $session = session();
            if ($session->get('avatar') != null) {
                echo '<img id="user-photo" src="' . $session->get('avatar') . '" alt="Foto do Usuário" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                ';
            } else {
                echo '<img id="user-photo" src="https://png.pngtree.com/png-clipart/20210915/ourlarge/pngtree-avatar-placeholder-abstract-white-blue-green-png-image_3918476.jpg" alt="Foto do Usuário" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                ';
            }
            ?>
            <h2 id="user-name"> Olá, <?php echo $session->get('user_name'); ?></h2>
            <a id="home-button" class="btn btn-primary ml-auto">Home</a>
            <a id="account-button" class="btn btn-secondary ml-2" href='/account'>Minha Conta</a>
            <a id="logout-button" class="btn btn-danger ml-2" href='/logout'>Sair</a>
        </div>
    </header>

    <div class="container py-4">
        <div class="d-flex align-items-center">
            <h3>Encontre as convenções e eventos do seu interesse:</h3>
            <hr>
            <div class="ml-auto">
                <form action="/pesquisaEventos" method="post">
                    <input type="text" id="searchInput" name="searchValue" placeholder="Pesquisar Conferências">
                    <button type="submit" class="btn btn-info" id="searchButton">Buscar</button>
                </form>
            </div>
        </div>
        <br>
        <?php
        foreach ($eventos as $evento) {
            $sigla = $evento['silga'];
            $nome = $evento['nome'];
            $espaco = $evento['espaco'];
            $cidade = $evento['cidade'];
            $pais = $evento['pais'];
            $fim_inscricao = date('d/m/Y', strtotime($evento['fim_inscricao']));
            $data_inicio = date('d/m/Y', strtotime($evento['data_inicio']));
            $data_fim = date('d/m/Y', strtotime($evento['data_fim']));

            $agora = date('d/m/Y');
            $menosUmaSemana = date('d/m/Y', strtotime('-1 week'));

            if (strtotime($evento['data_inicio']) > time()) {
                $inscricaoModel = model(InscricaoModel::class);
                $inscricao = $inscricaoModel->encontraPorIdDoUsuarioEEvento($session->get('user_id'),  $evento['id']);

                echo '<div class="card">';
                echo '<h3>' . $nome . ' (' . $sigla . ')</h3>';
                echo '<hr>';
                echo '<h4><strong>Local:</strong> ' . $espaco . ', ' . $cidade . ', ' . $pais . '</h4>';
                echo '<p><strong>Fim das inscrições:</strong> ' . $fim_inscricao . '</p>';
                echo '<p><strong>Data de início:</strong> ' . $data_inicio . '</p>';
                echo '<p><strong>Data de fim:</strong> ' . $data_fim . '</p>';
                echo '<hr>';
                if ($inscricao == null && strtotime($evento['fim_inscricao']) > time()) {
                    echo '<div class="buttons-container">';
                    echo '<a class="btn btn-primary" href="/ouvinte/' . $evento['id'] . '">Inscrever-se como Ouvinte</a>';
                    echo '<a class="btn btn-secondary ml-3"  href="/autor/' . $evento['id'] . '">Inscrever-se como Autor</a>';
                    echo '</div>';
                } else if ($inscricao == null && strtotime($evento['fim_inscricao']) <= time()) {
                    echo '<h4>Inscrições encerradas.</h4>';
                } else {
                    echo '<h4>Inscrito como ' . $inscricao->tipo . '</h4>';
                }

                echo '</div>';
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>