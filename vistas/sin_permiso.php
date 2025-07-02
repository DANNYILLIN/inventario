<?php
    session_name("IV");
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Denegado</title>
    <link rel="stylesheet" href="../css/bulma.min.css">
</head>
<body class="has-background-dark has-text-white-ter">

    <section class="section">
        <div class="container">
            <div class="notification is-danger has-text-centered">
                <h1 class="title">🚫 Acceso denegado</h1>
                <p class="subtitle">No tienes permisos para acceder a esta sección.</p>
                <div class="buttons is-centered mt-4">
                    <a href="javascript:history.back()" class="button is-warning">🔙 Volver</a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
