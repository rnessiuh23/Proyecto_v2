<?php 

// Base de Datos
require '../includes/config/database.php'; 
$db = conectarDB();


$resultado = $_GET['resultado'] ?? null;

// ELIMINAR DEPENDENCIA
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if($id) {
    $query = "DELETE FROM Dependencias WHERE idDependencias = $id";

    $resultadoEliminar = mysqli_query($db, $query);

    if($resultadoEliminar) {
      header('location: ../listas/listaDependencias.php');
    }
  }
  
}


// CONSULTA DE TABLA DEPENDENCIAS
$query_Dependencias = "SELECT Dependencias.idDependencias, Dependencias.nombreDep, Dependencias.correoDep, Dependencias.telefonoDep, Dependencias.jefe, Dependencias.sector, Dependencias.denominacion FROM Dependencias";

$resultado_Dependencia = mysqli_query($db, $query_Dependencias);

$dependencias = array();
while ($fila = mysqli_fetch_array($resultado_Dependencia)) {
    $dependencias[] = $fila;
}

mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Logo_de_la_UAEMex.svg/1200px-Logo_de_la_UAEMex.svg.png">
  <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Logo_de_la_UAEMex.svg/1200px-Logo_de_la_UAEMex.svg.png">
  <title>
     Dependencias
  </title>
  <?php include '../recursos/recursos.php' ?>
</head>

<body class="g-sidenav-show bg-gray-100">
  <?php include '../templates/Menu/menu.php' ?>

  <?php if(intval($resultado) === 2 ): ?>
    <script>
  Swal.fire({
    title: 'Registro actualizado correctamente!',
    // text: 'You clicked the button!',
    icon: 'success',
    confirmButtonText: 'Aceptar',
    confirmButtonColor: '#65a30d',
    iconColor: '#65a30d',
    allowOutsideClick: false,
  }).then((result) => {
  window.location.href = "../listas/listaDependencias.php";
      const url = window.location.href.replace("?resultado=2", "");
      window.history.replaceState({path: url}, "", url);
})

document.addEventListener('keydown', function(event) {
  const key = event.key;
  if (key === "Enter") {
    Swal.close();
  }
});
</script>
  <?php endif ?>
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Formularios</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dependencias</li>
          </ol>
          <h6 class="text-white font-weight-bolder ms-2">Dependencias</h6>
        </nav>
        <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Cerrar sesión</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 pe-0 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                  </div>
                </a>
              </a>
            </li>
              </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/fondoAlumnos.jpg'); background-position-y: 95%;">
        <span class="mask bg-gradient-primary opacity-7"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="https://img.icons8.com/color/512/add-user-male-skin-type-7.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                Lista de dependencias
              </h5>
            </div>
            <a href="../formularios/registrarDependencias.php" class="btn btn-icon btn-3 btn-primary" type="button">
              <span class="btn-inner--icon"><i class="fas fa-user-plus"></i></span>
              <span class="btn-inner--text"> Agregar dependencia</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">

        <div class="col-12 mt-4">
          <div class="card mb-4">
             <div class="card-header pb-0 p-3">
            </div>
            
<div class="card">
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
      <thead class="">
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Acción</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre y Id</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Correo</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jefe</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sector</th>
          <!-- <th class="text-secondary opacity-7"></th> -->
        </tr>
      </thead>
      <tbody>
      <?php if (empty($dependencias)): ?>
        <tr>
          <td colspan="10" class="text-center">No se encontraron registros.</td>
        </tr>
      <?php else: ?>
      <?php foreach ($dependencias as $dependencia): ?>
        <tr>
          <td>
            <div class="d-flex px-2 py-1 justify-content-center">
              <div style="display: flex;">
                <a href="../formularios/actualizarDependencias.php?id=<?php echo $dependencia['idDependencias']; ?>" class="btn btn-icon btn-2 avatar avatar-sm me-3 btn-edit" type="button">
                  <span class="btn-inner--icon"><i class="las la-edit icon-edit"></i></span>
                </a>
                <form method="POST">
                  <input type="hidden" name="id" value="<?php echo $dependencia['idDependencias']; ?>">
                <button type="submit" class="btn btn-icon btn-2 btn-delete avatar avatar-sm me-3">
                  <span class="btn-inner--icon"><i class="las la-trash-alt icon-delete"></i></span>
                </button>
                </form>
                
              </div>
            </div>
          </td>
          <td>
          <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-xs text-uppercase"><?= $dependencia['nombreDep'] ?></h6>
                <p class="text-xs text-secondary mb-0"><?= $dependencia['idDependencias'] ?></p>
              </div>
          </td>
          <td>
            <p class="text-xs font-weight-bold mb-0"><?= $dependencia['correoDep'] ?></p>
          </td>
        
          <td class="align-middle text-center">
            <a href="tel:<?php $dependencia['telefonoDep'] ?>" class="text-xs font-weight-bold mb-0"><?= $dependencia['telefonoDep'] ?></a>
          </td>

          <td class="align-middle text-center">
          <p class="text-xs font-weight-bold mb-0"><?= $dependencia['denominacion'] . ' ' . $dependencia['jefe'] ?></p>
          </td>

          <td>
          <p class="text-xs font-weight-bold mb-0"><?= $dependencia['sector'] ?></p>
          </td>

          
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>

      </tbody>
      </table>

  </div>
</div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-beetwen">
            <div class="col-lg-12 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                <script>
                  document.write(new Date().getFullYear())
                </script>,
                Software creado por
                <a href="#" class="font-weight-bold">ICO y LIA</a>
                
              </div>
        </div>
      
    </div>
  </div>
</footer>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
  <!-- Incluye SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
</body>

</html>