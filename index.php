<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Blancas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/5.2/examples/sign-in/signin.css">
</head>
<body>
    <main class="form-signin w-100 m-auto">
        <form method="GET" action="resultados.php">
            <img class="mb-4" style="display: block; margin: 0 auto;" src="https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal" style="font-size: 1.1rem;text-align:center;">Busqueda Base Pag Blancas</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="name" placeholder="Nombre y/o apellido">
                <label for="name">Ingresa un nombre o apellido</label>
            </div>
            <button class="w-100 btn btn-primary" type="submit">Buscar</button>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>