<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Inscrição como autor</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
  <div class="container">
    <br>
    <h1>Inscrição</h1>
    <?php
    echo '<h3>' . $evento->nome . ' (' . $evento->silga . ')</h3>';
    echo '<hr>';
    echo '<h4><strong>Local:</strong> ' . $evento->espaco . ', ' . $evento->cidade . ', ' . $evento->pais . '</h4>';
    echo '<p><strong>Fim das inscrições:</strong> ' . date('d/m/Y', strtotime($evento->fim_inscricao)) . '</p>';
    echo '<p><strong>Data de início:</strong> ' . date('d/m/Y', strtotime($evento->data_inicio)) . '</p>';
    echo '<p><strong>Data de fim:</strong> ' . date('d/m/Y', strtotime($evento->data_fim)) . '</p>';
    echo '<hr>';
    ?>
    <form action='inscreverautor' method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <?php echo '<input type="hidden" id="evento" name="evento" value=' . $evento->id . '>'; ?>
        <label for="pdfFile" class="form-label">Adicionar arquivo PDF:</label>
        <?php if (session()->getFlashdata('alert')) : ?>
          <div class="alert alert-danger"><?= session()->getFlashdata('alert') ?></div>
        <?php endif; ?>
        <input type="file" class="form-control" id="pdfFile" name="pdfFile" accept=".pdf" required>
      </div>

      <button type="submit" class="btn btn-primary">Inscrever-se</button>
      <a href="/" class="btn btn-secondary">Voltar</a>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>