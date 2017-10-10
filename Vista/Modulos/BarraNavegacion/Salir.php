<?php

if (isset($_SESSION["perfil"])) {
    session_destroy();
    header("location:Inicio");
}

