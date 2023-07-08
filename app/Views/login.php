<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ConfBrasil</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="app\Views\assets\login.css">
</head>

<body>
    <div class="container">
        <header class="bg-light py-3">
            <h1>ConfBrasil - Conferências e Eventos</h1>
        </header>
        <h2 class="mt-4">Informe seu e-mail e senha cadastrados para entrar</h2>
        <form action="authenticate" method="post">
            <div class="mb-3">
                <label for="InputForEmail" class="form-label">Email</label>
                <?php
                if (session()->has('erro_login')) {
                    echo '<p style="color: red">Usuário ou senha incorretos</p>';
                }
                ?>
                <input type="email" name="email" class="form-control" id="InputForEmail">
            </div>
            <div class="mb-3">
                <label for="InputForPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" maxlength="6" id="InputForPassword">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <hr>
        <a href="create">Criar novo usuário</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>