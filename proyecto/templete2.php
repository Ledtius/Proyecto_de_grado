<?php
session_start();
if(empty($_SESSION['active'])){
	header( "location: /login.php" );  //redirect to dashboard if user is already logged in
}
if ($_SESSION['id_rol'] != 4) {
    // Si el usuario no tiene el rol adecuado, redirigirlo a la página de error
    header("Location: 400.html");
    exit; // Salir del script
}
error_reporting(E_ALL);

require_once(__DIR__ . '/consultas/notificaciones.php');

$recordatorios = consultarRecordatorios();

function Head($title){
ob_start();
?>
    <head>
     <!-- Basic Page Info -->
	 <meta charset="utf-8" />
    <title>veterinaria sos</title>
    

    <!-- Site favicon -->
        <!-- Site favicon -->
    <link rel="icon" type"icon" size="100%" href="IconoCVSOS.ico" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    
    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css" />
  

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258" crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->
</head>
    <?php
    return ob_get_clean();
}

function starBody(){
	require_once('funtion/scripts.php');
	
	
    ob_start();
?>

<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
        }
    </style>
	<!-- para cargar tablas y  demas sin que se vean los loading -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<link rel="stylesheet" href="../tablacss/estilo.css">
<script> $(document).ready( function () {
             $('#myTable').DataTable(
        {
            "language" :{
                "url":"//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
          }
       );
      } 
     );
    </script>
	<!-- hasta aqui lo de las tablas -->

    <div class="pre-loader">
		
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="../vendors/images/deskapp-logo.svg" alt="" />
                <!-- cambiar imagen crear una  -->
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>
            <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
            <div class="header-search">
                <form>
                    <div class="form-group mb-0">
                        <i class="dw dw-search2 search-icon"></i>
                        <input type="text" class="form-control search-input" placeholder="Search Here" />
                        <div class="dropdown">
                            <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                                <i class="ion-arrow-down-c"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">From</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">To</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Subject</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="text-right">
										
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="header-right">
			<div class="text-center mt-4">
					
			<p id="hora">Barrancabermeja santander <?php echo fechaC();?></p>
					
				</div>
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>
				<div class="user-notification">
    <div class="dropdown">
        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
            <i class="icon-copy dw dw-notification"></i>
            <span class="badge notification-active"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="notification-list mx-h-350 customscroll">
                <ul>
                    <?php
                    // Llamamos a la función para obtener los recordatorios
                    $recordatorios = consultarRecordatorios();

                    // Verificamos si hay recordatorios disponibles
                    if ($recordatorios !== null && count($recordatorios) > 0) {
                        // Iteramos sobre los recordatorios y los mostramos en la lista
                        foreach ($recordatorios as $recordatorio) {
                            echo '<li>';
                            echo '<a href="#">';
                            echo '<img src="../vendors/images/icons8-recordatorios-de-citas.gif" alt="" />';
							echo '<h3> Mascota :' . $recordatorio['NombreMascota'] . '</h3>';
                            echo '<h3> Cliente :' . $recordatorio['nombre'] . '</h3>';
							echo '<p style="color: red;" > vence: ' . $recordatorio['fechaVencimiento'] . '</p>';
                            echo '<p> Mensaje :' . $recordatorio['textoRecordatorio'] . '</p>';
                            echo '<p> Fecha :' . $recordatorio['fechaCreacion'] . '</p>';
                            echo '</a>';
                            echo '</li>';
                        }
                    } else {
                        // Si no hay recordatorios, mostramos un mensaje indicando que no hay ninguno
                        echo '<li>No hay recordatorios disponibles</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="../vendors/images/8454452.png" alt="" />
							</span>
							<span class="user-name"><?php echo $_SESSION['nombre'];?></span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							
							<a class="dropdown-item" href=../controllers/salir.php
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
						
					</div>
					
				</div>
				<div class="text-center mt-4">
				<?php
				if ($_SESSION['id_rol'] == 1) {
					echo "<p> Administrador</p>";

				} elseif ($_SESSION['id_rol'] == 2) {
					echo "<p> Administrador</p>";
				} elseif ($_SESSION['id_rol'] == 4) {
					echo "<p> Doctor</p>";
				} else {

					echo "<p>Rol no definido</p>";
				}
				?>

					</div>
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2" />
                                    <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3" />
                                    <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i
							></label>
                                </div>
                            </div>

                            <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                            <div class="sidebar-radio-group pb-30 mb-10">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="" />
                                    <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2" />
                                    <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3" />
                                    <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="" />
                                    <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5" />
                                    <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6" />
                                    <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i
							></label>
                                </div>
                            </div>

                            <div class="reset-options pt-30 text-center">
                                <button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="left-side-bar">   
                <div class="brand-logo">
                    <a href="index.php">
                        <img src="../vendors/images/untitled1.svg" alt="" class="dark-logo" />
                        <img src="../vendors/images/untitled2.svg" alt="" class="light-logo" />
                    </a>
                    <div class="close-sidebar" data-toggle="left-sidebar-close">
                        <i class="ion-close-round"></i>
                    </div>
                </div>
                <div class="menu-block customscroll">
                    <div class="sidebar-menu">
                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="../doctor/index.php" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-house"></span
								><span class="mtext">Home</span>
                                </a>

                            </li>

                            <li>
                                <a href="citas_programadas.php" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-diagram-3"></span
								><span class="mtext">Citas Programadas</span>
                                </a>
                            </li>
                         
                            

							<li>
  

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-overlay"></div>





			
            <div class="main-container">
			<script src="../funtion/actualizarhora.js"></script>

<?php
    return ob_get_clean();
}

function endBody(){

    ob_start();
?>
            
        <!-- dividir aqui -->


        <div class="title pb-20 pt-20">
                    
                </div>

                <div class="footer-wrap pd-20 mb-20 card-box">
                 Copyright © 2024    Clinica veterinaria S.O.S   
                        <a href="https://github.com/dorotyalvarez" target="_blank">   CLINICA VETERINARIA S.O.S</a>
					
				</div>
			</div>
		</div>
		<!-- welcome modal start -->
		<div class="welcome-modal">
			<button class="welcome-modal-close">
				<i class="bi bi-x-lg"></i>
			</button>

			<div class="text-center">
				<h3 class="h5 weight-500 text-center mb-2">
					Feliz Dia
					<span role="img" aria-label="gratitude">❤️</span>
                                                    </h3>
                                                    <div class="pb-2">
                                                       
			</div>
			<div class="text-center mb-1">
				<div>
					<a
						
					>
						<span class="text-danger weight-600">veterinario</span>
						<span class="weight-600">FAVORITO</span>
						<i class="fa fa-github"></i>
					</a>
                </div>
                <script async defer="defer" src="#"></script>
            </div>

            <p class="font-14 text-center mb-1 d-none d-md-block">
                Quien ama a los animales ama al ser humano
            </p>
            <div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
                <i class="fa fa-paw prints"></i>
            </div>
        </div>

        <!-- welcome modal end -->
        <!-- js -->
		<script src="../funtion/actualizarhora.js"></script>
        <script src="../vendors/scripts/core.js"></script>
        <script src="../vendors/scripts/script.min.js"></script>
        <script src="../vendors/scripts/process.js"></script>
        <script src="../vendors/scripts/layout-settings.js"></script>
        <script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
        <script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
        <script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
        <script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
        <script src="../vendors/scripts/dashboard3.js"></script>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
        <!-- End Google Tag Manager (noscript) -->
</body>
<?php
    return ob_get_clean();
}
?>