<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cargos TC 2</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="alta.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Cargos TC <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <!--<li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>-->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Operaciones
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-users"></i>
          <span>Clientes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Operaciones clientes:</h6>
            <a class="collapse-item" href="alta.php">Alta</a>
            <a class="collapse-item" href="actualizacion.php">Modificaciones</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="cobrostg.php">
          <i class="fas fa-fw fa-credit-card"></i>
          <span>Generar archivo</span></a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li>-->

      <!--Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Créditos
      </div>

      <!-- Nav Item - alta credito -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCreditos" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cash-register"></i>
          <span>Créditos cliente</span></a>
          
          <div id="collapseCreditos" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Operaciones céditos:</h6>
              <a class="collapse-item" href="altacredito.php">Alta crédito</a>
              <a class="collapse-item" href="detallesCredito.php">Modificación créditos</a>
            </div>
          </div>
      </li>

      <!-- Nav Item - pagos -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagos" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cash-register"></i>
          <span>Pagos</span></a>
          
          <div id="collapsePagos" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Operaciones pagos:</h6>
              <a class="collapse-item" href="pagos.php">Registro pagos</a>
              <a class="collapse-item" href="cambiospagos.php">Modificacion pagos</a>
            </div>
          </div>
      </li>

      <!-- Nav Item - estado de cuenta -->
      <li class="nav-item">
        <a class="nav-link" href="edocta.php">
          <i class="fas fa-fw fa-file-invoice"></i>
          <span>Estado de cuenta</span></a>
      </li>

      <!-- Divider -->
      <!--<hr class="sidebar-divider d-none d-md-block">-->

      <!-- Sidebar Toggler (Sidebar) -->
      <!--<div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>-->

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <!--<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>-->

          <!-- Topbar Search -->
          <!--<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>-->

          <!-- Topbar Navbar -->
          <!--<ul class="navbar-nav ml-auto">-->

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <!--<li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>-->
              <!-- Dropdown - Messages -->
              <!--<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>-->

            <!-- Nav Item - Alerts -->
            <!--<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>-->
                <!-- Counter - Alerts -->
                <!--<span class="badge badge-danger badge-counter">3+</span>
              </a>-->
              <!-- Dropdown - Alerts -->
              <!--<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>-->

            <!-- Nav Item - Messages -->
            <!--<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>-->
                <!-- Counter - Messages -->
                <!--<span class="badge badge-danger badge-counter">7</span>
              </a>-->
              <!-- Dropdown - Messages -->
              <!--<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>-->

            <!-- Nav Item - User Information -->
            <!--<li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>-->
              <!-- Dropdown - User Information -->
              <!--<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>-->

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Altas</h1>
          </div>
          
          <div class="row">

            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Nuevo cliente</h6>
                  <div class="dropdown no-arrow">
                    <!--<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>-->
                    <!--<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>-->
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  
                    <form id="alta">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="rfc">RFC</label>
                            <input type="text" class="form-control" id="rfc">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="direccion">Direccion</label>
                          <input type="text" class="form-control" id="direccion">
                        </div>
                        <div class="form-group">
                          <label for="ciudad">Ciudad</label>
                          <input type="text" class="form-control" id="ciudad">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="estado">Estado</label>
                                <select id="estado" class="form-control">
                                    <option value="" selected>Seleccionar...</option>
                                    <option value="AGUASCALIENTES">Aguascalientes</option>
                                    <option value="BAJA CALIFORNIA">Baja California </option>
                                    <option value="BAJA CALIFORNIA SUR">Baja California Sur </option>
                                    <option value="CAMPECHE">Campeche </option>
                                    <option value="CHIAPAS">Chiapas </option>
                                    <option value="CHIHUAHUA">Chihuahua </option>
                                    <option value="COAHUILA">Coahuila </option>
                                    <option value="COLIMA">Colima </option>
                                    <option value="CDMX">CDMX</option>
                                    <option value="DURANGO">Durango </option>
                                    <option value="ESTADO DE MEXICO">Estado de México </option>
                                    <option value="GUANAJUATO">Guanajuato </option>
                                    <option value="GUERRERO">Guerrero </option>
                                    <option value="HIDALGO">Hidalgo </option>
                                    <option value="JALISCO">Jalisco </option>
                                    <option value="MICHOACAN">Michoacán </option>
                                    <option value="MORELOS">Morelos </option>
                                    <option value="NAYARIT">Nayarit </option>
                                    <option value="NUEVO LEON">Nuevo León </option>
                                    <option value="OAXACA">Oaxaca </option>
                                    <option value="PUEBLA">Puebla </option>
                                    <option value="QUERETARO">Querétaro </option>
                                    <option value="QUINTANA ROO">Quintana Roo </option>
                                    <option value="SAN LUIS POTOSI">San Luis Potosí </option>
                                    <option value="SINALOA">Sinaloa </option>
                                    <option value="SONORA">Sonora </option>
                                    <option value="TABASCO">Tabasco </option>
                                    <option value="TAMAULIPAS">Tamaulipas </option>
                                    <option value="TLAXCALA">Tlaxcala </option>
                                    <option value="VERACURZ">Veracruz </option>
                                    <option value="YUCATAN">Yucatán </option>
                                    <option value="ZACATECAS">Zacatecas</option>
                                </select>
                              </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="tarjeta">Tarjet de crédito</label>
                          <input type="text" class="form-control" id="tarjeta" placeholder="VISA/MASTER CARD">
                        </div>
                        
                        <div class="form-row">
                          
                          <div class="form-group col-md-4">
                            <label for="referencia">Referencia</label>
                            <select id="referencia" class="form-control">
                              <option value="" selected>Seleccionar...</option>
                            </select>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                    
                </div>
              </div>
            </div>
            
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Ecopulse 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
    <!-- Modal -->
    <div class="modal" id="esperaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Procesando</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
    </div>
    
    <!--modal error-->
    <div class="modal fade" id="errorModal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tituloModal"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="mesnsaje">
                  <span id="mensaje"></span>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/scripts.js"></script>

</body>

</html>
