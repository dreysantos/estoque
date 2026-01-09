<?php
class Auth {

    public static function check() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?rota=login");
            exit;
        }
    }

    public static function nivel($nivel) {
        if ($_SESSION['usuario']['nivel_acesso'] !== $nivel) {
            die("Acesso negado");
        }
    }
}
