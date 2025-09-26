<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/style_std.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
      <div class="card p-5 shadow text-center bg-light border-0" style="width: 350px;">
        <div class="mb-4">
            <i class="bi bi-person-circle" style="font-size: 80px;"></i>
    </div>


    <form method="POST" action="../public/index.php" >
      <div class="mb-3">
        <input type="text" class="form-control rounded-pill text-center bg-secondary text-white placeholder-light" placeholder="Usuário" name="usuario">
      </div>
      <div class="mb-3">
        <input type="password" class="form-control rounded-pill text-center bg-secondary text-white" placeholder="senha" name="senha">
      </div>
      <button type="submit" class="btn btn-dark w-100">Entrar</button>
    </form>
  </div>

</body>
</html>