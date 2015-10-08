
<body>

<!--Header-->
<header id="header" class="acceso">
    <div class="container">
      <div class="row">

        <div class="col-xs-3 col col_1">
          <a class="logo" href="/">
            <h1>Admin</h1>
          </a>
        </div>

      </div>
    </div>
</header>
<!--End Header-->






<!--Body-->
<section id="#a_body">
	<article>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 frame">
          
          <div class="box_login">
            <div class="box_login_border">
              
              <form action="/admin/login" method="POST" name="login" id="login_form">
                <h4 class="text-center">¡Bienvenido!</h4>

                <!--Error form-->
                <p class="bg-warning"><?php echo $this->session->flashdata('error'); ?></p>
                <!--End error form-->

                <p class="text1">Ingrese la información de acceso para entrar al panel de administración.</p>
              
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Nombre de usuario">
                </div>
 
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Contraseña">
                </div>
              
                <button type="submit" name="login" class="btn btn-primary">Ingresar</button>
      

              </form>

            </div>
          </div><!--End box_login-->

        </div>
      </div>
    </div>
  </article><!--End article-->  
</section>
<!--End body-->




<!--Footer-->
<footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div id="copy">
            <p>Diseño y desarrollo exclusivo <a href="http://www.tb.com.ve" target="_blank">www.tb.com.ve</a></p>
            <p>© 2013 - Todos los derechos reservados</p>
          </div>
        </div>
      </div>
    </div>
</footer>
<!--End Footer-->


<!--Libraries-->
<script src="/assets/backend/js/jquery-2.1.3.min.js"></script>
<script src="/assets/backend/js/bootstrap.min.js"></script>
<script src="/assets/backend/js/script.js"></script>
<script src="/assets/backend/lib/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/backend/lib/datatable/js/dataTables.bootstrap.js"></script>
<script src="/assets/backend/lib/formvalidation/js/formValidation.min.js"></script>
<script src="/assets/backend/lib/formvalidation/js/framework/bootstrap.min.js"></script>



<script type="text/javascript">

//Star validation
$(document).ready(function() {
    $('#login_form').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'Obligatorio! Ingrese su nombre de usuario'
                    },
                    stringLength: {
                        min: 5,
                        max: 16,
                        message: 'Ingrese entre 5 y 16 carácteres.'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Obligatorio! Ingrese su contraseña.'
                    },
                    stringLength: {
                        min: 6,
                        message: 'Ingrese al menos 6 caráteres.'
                    }
                }
            }
        }
    });
});
</script>

</body>
</html>

