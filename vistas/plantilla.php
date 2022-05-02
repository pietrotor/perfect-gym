<?php
require_once('start_session.php');
$activo=1;
if($_SESSION['accesos_globales']['disciplina_acceso'] != $activo) {
    $ver_disciplina=$_SESSION['$ocultar'];
}else{$ver_disciplina="";}

if($_SESSION['accesos_globales']['instructor_acceso'] != $activo) {
    $ver_instructor=$_SESSION['$ocultar'];
}else{$ver_instructor="";} 

if($_SESSION['accesos_globales']['lista_asistencia_acceso'] != $activo) {
    $ver_lista_asistencia=$_SESSION['$ocultar'];
}else{$ver_lista_asistencia="";} 

if($_SESSION['accesos_globales']['pago_acceso'] != $activo) {
    $ver_pagos=$_SESSION['$ocultar'];
}else{$ver_pagos="";} 

if($_SESSION['accesos_globales']['tienda_acceso'] != $activo) {
    $ver_tienda=$_SESSION['$ocultar'];
}else{$ver_tienda="";} 

$id_rol=$_SESSION['$rol'];
if($id_rol == 2){
    $mostrar_datos_empresa = "display:none;";
}else{
    $mostrar_datos_empresa= "";
}

$logo = "imagenes-sistema/logo.png";
$razon_social = $_SESSION['$razon_social'];
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $razon_social; ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="dist/css/styles.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="imagenes-sistema/fav-icon.png"/>
    

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="main.css">
    <style>
        body, h1{
        font-family: 'Roboto', sans-serif;
        font-weight:800;
        }
        #tablaPersonas th, #tablaAsistencia th, #tablaPagos th, #tablaDisciplinas th, #tablaInstructores th{
        font-family: 'Roboto', sans-serif;
        color:white;
        background:#048DF1;
        text-align:center;
        }
        #tablaPersonas tbody td, #tablaAsistencia tbody td, #tablaPagos tbody td, #tablaDisciplinas tbody td, #tablaInstructores tbody td{
            text-align:center;
        }
    </style>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">


    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">


 
  
  </head>
  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="inicio.php"><?php echo $razon_social; ?></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <!-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div> -->
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0" >           
        <a class="nav-link " <?php echo $ver_tienda; ?> id="" href="punto_de_venta.php" role="button"><i class="fas fa-shopping-cart"></i></a>
            <a class="nav-link " id="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class=""><?php echo $_SESSION['$nombre']." ".$_SESSION['$apellido']; ; ?></i></a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="perfil.php"><i class="fas fa-user-lock"></i> Ver Perfil</a>                    
                    <a class="dropdown-item" style="<?php echo $mostrar_datos_empresa; ?>" href="datos-empresa.php"><i class="fas fa-dumbbell"></i> Ver Empresa</a>                    
                    <a class="dropdown-item" href="bd/salir.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </div>     
                          
            </li>            
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                      <a href="inicio.php"><img src='<?php echo $logo; ?>' class="h-50 ml-3" style="margin-top:20px;max-height: 80px !important; max-width:180px !important;" alt=""></a>
                        <div class="sb-sidenav-menu-heading">Inicio</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link collapsed" href="disciplinas.php" <?php echo $ver_disciplina; ?>  >
                            <div class="sb-nav-link-icon"><i class="fas fa-dumbbell"></i></div>
                            Disciplinas
                            <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                        </a>
                        <!-- <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div> -->
                        <a class="nav-link collapsed" href="instructores.php"  <?php echo $ver_instructor; ?>  >
                            <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>
                            Instructores
                            <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                        </a>
                        <a class="nav-link collapsed" href="lista-asistencia.php" <?php echo $ver_lista_asistencia; ?>  >
                            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                            Lista de asistencia
                            <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                        </a>
                        
                        <!-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div> -->
                        <div class="sb-sidenav-menu-heading">Control</div>
                        <a class="nav-link" href="asistencia.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-door-open"></i></div>
                            Asistencia
                        </a>
                        <a class="nav-link" href="pagos.php" <?php echo $ver_pagos; ?> >
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                            Pagos
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Bienvenido:</div>
                    <?php echo $_SESSION['$nombre']." ".$_SESSION['$apellido']; ; ?>
                </div>
            </nav>
        </div>
      <div id="layoutSidenav_content">
        <main>
     
