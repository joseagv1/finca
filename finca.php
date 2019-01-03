
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/open-iconic-bootstrap.css" rel="stylesheet">
    
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Unidades
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" onclick="$('#nueva_unidad').modal('show');">Crear</a>
              <a class="dropdown-item" href="#">Consultar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Costos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="finca.php?action=compra">Nueva Costo</a>
              <a class="dropdown-item" href="finca.php?action=listacompra">Consultar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Despacho
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="finca.php?action=despacho">Nuevo Despacho</a>
              <a class="dropdown-item" href="finca.php?action=listacompra">Consultar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menu
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="finca.php?action=menu">Nuevo Menu</a>
              <a class="dropdown-item" href="finca.php?action=listacompra">Consultar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Comedor
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="finca.php?action=comedor">Nuevo Comedor</a>
              <a class="dropdown-item" href="finca.php?action=listacompra">Consultar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Porductos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item disabled" href="#">Productos</a>
              <a class="dropdown-item" href="javascript:void(0);" onclick="showproductomodal()">Nuevo Producto</a>
              <a class="dropdown-item" href="#">Consultar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item disabled" href="#">Categorias</a>
              <a class="dropdown-item" href="#" onclick="showcategoriamodal()">Nueva Categoria</a>
              <a class="dropdown-item" href="#">Consultar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item disabled" href="#">Empaque</a>
              <a class="dropdown-item" href="#" onclick="showempaquemodal()">Nuevo Empaque</a>
              <a class="dropdown-item" href="#">Consultar</a>
              <a class="dropdown-item" href="#" onclick="$('#nuevo_tipo_empa').modal('show');">Nueva Tipo Empaque</a>
              <a class="dropdown-item" href="#">Consultar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Monedas
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item disabled" href="#">Monedas</a>
              <a class="dropdown-item" href="#" onclick="showCrearMonedaModal();">Nueva Moneda</a>
              <a class="dropdown-item" href="#">Consultar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item disabled" href="#">Tasas</a>
              <a class="dropdown-item" href="#" onclick="showTasaCambioModal()">Nueva Tasa de Cambio</a>
              <a class="dropdown-item" href="#">Consultar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Reportes
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="finca.php?action=reporte_comedor">Comedor</a>
              <a class="dropdown-item" href="finca.php?action=reporte_centro_costos">Centro de Costos</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item disabled" href="#">Tasas</a>
              <a class="dropdown-item" href="#" onclick="showTasaCambioModal()">Nueva Tasa de Cambio</a>
              <a class="dropdown-item" href="#">Consultar</a>
            </div>
          </li>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>

    <main role="main" class="container">
    
      <div class="starter-template">

        <!-- <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p> -->
        <?php
          /*if (isset($_GET["action"]) && $_GET["action"] == "compra"){
            include_once "compra.php";
          };
        
          if (isset($_GET["action"]) && $_GET["action"] == "listacompra"){
            include_once "listacompra.php"; 
          };

          if (isset($_GET["action"]) && $_GET["action"] == "despacho"){
            include_once "listacompra.php"; 
          };*/

          if (isset($_GET["action"])){
            switch ($_GET["action"]) {
              case "compra":  
                include_once "compra.php";
              break;
              case "listacompra":  
                include_once "listacompra.php"; 
              break;
              case "despacho":  
                include_once "despacho.php"; 
              break;
              case "menu":  
                include_once "menu.php"; 
              break;
              case "comedor":  
                include_once "comedor.php"; 
              break;
              case "reporte_comedor":  
                include_once "reporte_comedor.php"; 
              break;
              case "reporte_centro_costos":
              include_once "reporte_centro_costos.php"; 
              break;
            }
          }
        ?>
      </div>

    </main><!-- /.container -->
    <!-- Modal producto -->
    <div id="nuevo_prod" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Crear Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
            <label for="prodLabel">Nombre</label>
            <input type="text" class="form-control" id="prod_name" placeholder="Ingrese Nombre Producto">
            <label for="prodLabel">Descripcion</label>
            <input type="text" class="form-control" id="prod_desc" placeholder="Ingrese Descripcion del Producto">
            <label for="prodLabel">Categoria</label>
            <div class="input-group mb-3">
              <select class="custom-select" id="producto_categoria">
                <option selected>Seleccione...</option>
              </select>
            </div>
            <label for="prodLabel">Empaque</label>
            <div class="input-group mb-3">
              <select class="custom-select" id="producto_empaque">
                <option selected>Seleccione...</option>
              </select>
            </div>
            <label for="prodLabel">Cantidad por persona</label>
            <input type="text" class="form-control" id="cant_percapita" placeholder="Ingrese de Producto por persona">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="createProd()">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Empaque -->
    <div id="nuevo_empa" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Crear Empaque</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
            <label for="prodLabel">Nombre</label>
            <input type="text" class="form-control" id="emp_nomb" placeholder="Ingrese Tipo de Empaque" required>
            <label for="prodLabel">Cantidad por empaque</label>
            <input type="text" class="form-control" id="emp_cant" placeholder="Ingrese Tipo de Empaque" required>
            <label for="prodLabel">Tipo de empaque</label>
            <div class="input-group mb-3">
              <select class="custom-select" id="emp_tipo">
              </select>
            </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="createEmpaque()">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Tipo Empaque -->
    <div id="nuevo_tipo_empa" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Crear Tipo de Empaque</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
            <label for="prodLabel">Nombre</label>
            <input type="text" class="form-control" id="empaq_nomb" placeholder="Ingrese Tipo de Empaque" required>
            <label for="prodLabel">Descripcion</label>
            <input type="text" class="form-control" id="empaq_desc" placeholder="Ingrese Descripcion">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="createEmpType()">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Tipo Categoria -->
    <div id="nueva_categoria" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Crear Tipo de Categoria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
            <label for="prodLabel">Nombre</label>
            <input type="text" class="form-control" id="category_nomb" placeholder="Ingrese Nombre Categoria" required>
            <label for="prodLabel">Descripcion</label>
            <input type="text" class="form-control" id="category_desc" placeholder="Ingrese Descripcion">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="createCategory()">Guardar</button>
          </div>
        </div>
      </div>      
    </div>
    <!-- Modal Nueva Moneda -->
    <div id="nueva_moneda" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Crear Nueva Moneda</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
            <label for="prodLabel">Nombre</label>
            <input type="text" class="form-control" id="moneda_nomb" placeholder="Ingrese Tipo de Empaque" required>            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="createMoneda()">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>  
    
    <!-- Modal Nueva Tasa Cambio -->
    <div id="nuevaTasaCambio" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Nueva Tasa Cambio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">                 
              <label for="prodLabel">Moneda 1</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="select_moneda1">
                </select>
              </div>
              <label for="prodLabel">Tasa De Cambio</label>
              <input type="text" class="form-control" id="tasacambio" placeholder="Ingrese Tasa" required>
              <label for="prodLabel">Moneda 2</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="select_moneda2">
                </select>
              </div> 
              <label for="prodLabel">Fecha</label>
              <input type="date" class="form-control" id="fecha_tasa" required>          
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" onclick="createTasaCambio()">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Nueva Tasa Cambio -->
    <div id="nuevaTasaCambio" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Nueva Tasa Cambio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">                 
              <label for="prodLabel">Moneda 1</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="select_moneda1">
                </select>
              </div>
              <label for="prodLabel">Tasa De Cambio</label>
              <input type="text" class="form-control" id="tasacambio" placeholder="Ingrese Tasa" required>
              <label for="prodLabel">Moneda 2</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="select_moneda2">
                </select>
              </div> 
              <label for="prodLabel">Fecha</label>
              <input type="date" class="form-control" id="fecha_tasa" required>          
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" onclick="createTasaCambio()">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Nueva Unidad -->
    <div id="nueva_unidad" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Crear Nueva Unidad de Produccion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
            <label for="prodLabel">Nombre</label>
            <input type="text" class="form-control" id="unidad_nomb" placeholder="Nombre Unidad de Produccion" required>            
          </div>
          <div class="form-group">
            <label for="prodLabel"># Empleados</label>
            <input type="text" class="form-control" id="unidad_empleados" placeholder="# Empleados" required>            
          </div>
          <div class="form-group">
            <label for="prodLabel">Notas</label>
            <input type="text" class="form-control" id="unidad_descripcion" placeholder="Notas" required>            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="createUnidad()">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>  
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js" ></script>
    
 
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.js"></script>
    <script type="text/javascript" src="js/interact-1.2.4.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
