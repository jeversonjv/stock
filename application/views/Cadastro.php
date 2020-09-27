<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Stock - Cadastro</title>

  <!-- Custom fonts for this template-->
  <link href="/assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/assets/template/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center" style="height: 100vh;">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: url('/assets/template/img/undraw_online_collaboration_7pfp.svg'); background-position: center; background-size: cover;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Crie sua conta gratuitamente!</h1>
                  </div>
                  <form class="user" id="formulario_cadastro">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="nome" aria-describedby="emailHelp" placeholder="Nome">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="senha" placeholder="Senha">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="confirmar_senha" placeholder="Confirmar Senha">
                    </div>
                    <button id="cadastrar" type="button" class="btn btn-primary btn-user btn-block">
                        Criar Conta
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="/login">Já possui conta? Entre aqui</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/assets/template/vendor/jquery/jquery.min.js"></script>
  <script src="/assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/assets/template/js/sb-admin-2.min.js"></script>
  <script src="/assets/scripts/auth.js"></script>

</body>

</html>
