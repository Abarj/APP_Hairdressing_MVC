<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {

    public static function index(Router $router) {

        if(!$_SESSION['nombre']) {
            session_start();
        }

        isAdmin();

        $servicios = Servicio::all();

        $router->render('servicios/index', [
            'shortName' => $_SESSION['shortName'] . " [Admin]",
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router) {
        
        if(!$_SESSION['nombre']) {
            session_start();
        }

        isAdmin();

        $servicio = new Servicio;

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)) {

                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear', [
            'shortName' => $_SESSION['shortName'] . " [Admin]",
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        
        if(!$_SESSION['nombre']) {
            session_start();
        }

        isAdmin();

        if(!is_numeric($_GET['id'])) {
            header('Location: /servicios');
            return;
        }

        $servicio = Servicio::find($_GET['id']);

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)) {

                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'shortName' => $_SESSION['shortName'] . " [Admin]",
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        
        if(!$_SESSION['nombre']) {
            session_start();
        }

        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];

            $servicio = Servicio::find($id);

            $servicio->eliminar();

            header('Location: /servicios');
        }
    }
}