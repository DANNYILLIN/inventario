<?php

    session_name("IV");
    session_start();

    function solo_admin() {
        if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
            header("Location: ./vistas/sin_permiso.php");
            exit;
        }
        }
