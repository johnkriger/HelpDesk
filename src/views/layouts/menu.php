<?php

declare(strict_types=1);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary position-relative align-items-center">
    <img src="/img/logo/logo.png" alt="Logo" class="logo">

    <?php
    switch ($_SESSION['usuarioPerfilId']) {
        case 1: ?>
            <div class="d-flex gap-3 position-absolute top-50 start-50 translate-middle">
                <a href="/usuarios.php" class="btn btn-outline-secondary">
                   Gerenciamento de Usuários
                </a>
                <a href="#" class="btn btn-outline-secondary">
                    Tipos de problema
                </a>
            </div>
    <?php break;

        case 2:
            //opções solicitante
            break;
        case 3:
            //opções atendente
    }
    ?>
    <div class="dropdown ms-auto">
        <button
            class="btn btn-secondary dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown">
            Perfil
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
            </svg>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Meu Perfil</a></li>
            <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
        </ul>
    </div>
</nav>