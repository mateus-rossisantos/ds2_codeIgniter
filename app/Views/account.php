<!DOCTYPE html>
<html>

<head>
    <?php

    use App\Controllers\Eventos;
    use App\Models\EventoModel;
    use CodeIgniter\Controller;

    $session = session(); ?>
    <title>Minha Página</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .card {
            background-color: #f2f2f2;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <header class="bg-light py-3">
        <div class="container d-flex align-items-center">
            <?php $session = session();
            if ($session->get('avatar') != null) {
                echo '<img id="user-photo" src="' . $session->get('avatar') . '" alt="Foto do Usuário" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                ';
            } else {
                echo '<img id="user-photo" src="https://png.pngtree.com/png-clipart/20210915/ourlarge/pngtree-avatar-placeholder-abstract-white-blue-green-png-image_3918476.jpg" alt="Foto do Usuário" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                ';
            }
            ?>
            <h2 id="user-name">Olá, <?php echo $session->get('user_name'); ?></h2>
            <a id="account-button" class="btn btn-secondary ml-auto" href='/home'>Home</a>
            <a id="account-button" class="btn btn-primary ml-2">Minha Conta</a>
            <a id="logout-button" class="btn btn-danger ml-2" href='/logout'>Sair</a>
        </div>
    </header>

    <div class="container py-4">
        <h3>Aqui estão as convenções e eventos que você participará</h3>
        <hr>
        <div class="row">
            <div class="col-md-6 section-container">
                <section>
                    <h2>Próximas Conferências</h2>
                    <hr>
                    <?php
                    foreach ($inscricoes as $inscricao) {
                        $eventoModel = model(EventoModel::class);

                        $evento = $eventoModel->buscaEventoPorId($inscricao->evento);

                        $nome = $evento->nome;
                        $data_inicio = date('d/m/Y', strtotime($evento->data_inicio));
                        $data_fim = date('d/m/Y', strtotime($evento->data_fim));
                        $tipo = $inscricao->tipo;


                        if (date('Y-m-d H:i:s', strtotime('now')) <= $evento->data_fim) {
                            echo '<div class="card">';
                            echo '<h4 href="detalhes/' . $evento->id . '">' . $nome . '</h4>';
                            echo '<hr>';
                            echo '<p> Inscrito como ' . $tipo . '. ';
                            echo '<br>';
                            echo 'De ' . $data_inicio . ' até ' . $data_fim . '.</p>';
                            echo '<hr>';
                            echo '<a class="btn btn-secondary"  href="/cancelar/' . $inscricao->id . '">Cancelar Inscricao</a>';
                            echo '</div>';
                        }
                    }
                    ?>
                </section>
            </div>
            <div class="col-md-6 section-container">
                <section>
                    <h2>Conferências Encerradas</h2>
                    <hr>
                    <?php
                    foreach ($inscricoes as $inscricao) {
                        $eventoModel = model(EventoModel::class);
                        $evento = $eventoModel->buscaEventoPorId($inscricao->evento);

                        $nome = $evento->nome;
                        $data_inicio = date('d/m/Y', strtotime($evento->data_inicio));
                        $data_fim = date('d/m/Y', strtotime($evento->data_fim));
                        $tipo = $inscricao->tipo;

                        if (date('Y-m-d H:i:s', strtotime('now')) > $evento->data_fim) {
                            echo '<div class="card">';
                            echo '<h4 href="detalhes/' . $evento->id . '">' . $nome . '</h4>';
                            echo '<hr>';
                            echo '<p> Inscrito como ' . $tipo . '. ';
                            echo '<br>';
                            echo 'De ' . $data_inicio . ' até ' . $data_fim . '.</p>';
                            echo '</div>';
                        }
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>