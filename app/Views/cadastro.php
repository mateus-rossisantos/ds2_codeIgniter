<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <header class="bg-light py-3">
            <h1>ConfBrasil - Conferências e Eventos</h1>
        </header>
        <h2 class="mt-4">Cadastro</h2>
        <form action="/novo-usuario" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <?php if (session()->getFlashdata('alertEmail')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('alertEmail') ?></div>
                <?php endif; ?>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" onblur="validarSenhas()" name="password" maxlength="6" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirme a senha:</label>
                <input type="password" class="form-control" id="confirm_password" onblur="validarSenhas()" name="confirm_password" maxlength="6" required>
            </div>
            <br>
            <div class="form-group">
                <label for="photo">Foto:</label>
                <?php if (session()->getFlashdata('alert')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('alert') ?></div>
                <?php endif; ?>
                <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg">
            </div>
            <br>
            <div class="form-group">
                <label for="instituicao">Instituição:</label>
                <input type="text" class="form-control" id="instituicao" name="instituicao" required>
            </div>
            <br>
            <div>
                <input type="submit" id="botaoConfirma" class="btn btn-primary" value="Cadastrar"></input>
                <a href="/" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
    <script>
        function validarSenhas() {
            var senha = document.getElementById("password");
            var confirmarSenha = document.getElementById("confirm_password");
            var botaoConfirma = document.getElementById("botaoConfirma");

            if (senha.value !== confirmarSenha.value) {
                confirmarSenha.style.borderColor = "red";
                confirmarSenha.placeholder = "Senhas não batem";
                botaoConfirma.disabled = true;
                return false;

            } else {
                confirmarSenha.style.borderColor = "";
                confirmarSenha.placeholder = "";
                botaoConfirma.disabled = false;
                return true;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>