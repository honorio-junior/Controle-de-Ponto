<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ponto eletronico</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <script defer src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
    <script defer src="src/js/script.js"></script>
</head>

<body class="m-2">
    <div class="container text-center">
        <img src="src/img/logo.jpg" alt="logo">
        <h1><b>Register point system</b></h1>
        <p class="text-danger">Detected: <span class="text-dark"><?= $ip ?> (<?= $userName ?>)</span></p>
        <p><b id="currentTime"></b></p>
    </div>
    <?php if(!empty($success)): ?>
    <div class="container alert alert-success" role="alert">
        <?= $success ?>
    </div>
    <?php endif ?>
    <?php if(!empty($erro)): ?>
    <div class="container alert alert-danger" role="alert">
        <?= $erro ?>
    </div>
    <?php endif ?>
    <div class="container py-4" id="formContainer">
        <form method="post" action="/register">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Registration</label>
                <input type="text" class="form-control" id="registration" name="registration" required>
            </div>
            <button type="submit" class="btn btn-primary col-12">Register</button>
        </form>
    </div>

</body>

</html>