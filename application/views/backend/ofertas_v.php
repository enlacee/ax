
<!--Body-->
<section id="#a_body">
  <article>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 frame">
          
          <div class="boxes">

            <div class="boxes_head">
              <h1>Todas las ofertas
                <span class="btn_right">
                  <a href="/backend/ofertas/add_ofertas" class="btn btn-success">
                  <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Agregar nueva oferta</a>
                </span>
              </h1>

              <!--Breadcrumbs-->
              <ol class="breadcrumb">
                <li>
                  <a href="/backend">Inicio</a>
                </li>
                <li>
                  <a href="/backend">backend</a>
                </li>
                <li class="active">listado de ofertas</li>
              </ol>
              <!--End Breadcrumbs-->
              </div><!--End boxes_head-->

            <div class="boxes_body">
              <form action="" method="POST" id="form_eliminar">
                <table id="table_id" class="table table-striped table-bordered table-hover table-condensed display">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Titulo</th>
                      <th>Categoria</th>
                      <th>Fecha</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_ofertas as $row): ?>
                    <tr id="<?php echo $row->id; ?>">                  
                      <td><?php echo $row->id; ?></td>
                      <td><?php echo $row->title; ?></td>
                      <td><?php echo $row->name_category; ?></td>
                      <td>
                      <?php  
                        $fecha = $row->create;
                        $fecha = explode(" ", $fecha);
                        $fecha = explode("-", $fecha[0]);
                        echo $fecha[2] .'-'. $fecha[1] .'-'. $fecha[0];
                      ?>
                      </td>
                      <td>
                        <a href="backend/ofertas/update_ofertas/<?php echo $row->id; ?>" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i>&nbsp;Editar</a>&nbsp;
                        <a href="javascript:void()" id-user-to-remove="<?php echo $row->id; ?>" class="eliminar btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>&nbsp;Eliminar</a>&nbsp;
                      </td>
                    </tr>
                    <?php endforeach; ?>

                  </tbody>
                </table>
              </form>
            </div><!--End boxesBody-->


          </div><!--End boxes-->

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



<!--Ventana modal para eliminar registros-->
<div class="modal fade" id="eliminar_registros_modal" id-user-modal="">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">¡Eliminar registro! <i class="fa fa-cog fa-spin cargador oculto"></i></h4>
      </div>
      <div class="modal-body">

        <div class="msj">
          <p>¿ESTAS SEGURO QUE DESEAS ELIMINAR ESTE REGISTRO?</p>
          <p><strong>Nota:</strong> Este registro se eliminará permanentemente de la base de datos.</p>
        </div>

        <div class="msj_status"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="eliminar_btn">Confirmar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">

$(function () {


    /**
     * Eliminar registros
     */
    $('.eliminar').on('click', this, function(){

      /**
       * Obtenenmos el ID del registro a eliminar
       * Asignamos el ID que obtuvimos al la ventana modal
       */
      var id_user = $(this).attr('id-user-to-remove');
      $('#eliminar_registros_modal').attr('id-user-modal', id_user);

      //Abrimos modal
      $('#eliminar_registros_modal').modal({
        keyboard: false
      });
    });
    //AJAX delete record
    $('#eliminar_btn').on('click', function(event) {

      var str = $('#eliminar_registros_modal').attr('id-user-modal');

      $.ajax({
        beforeSend: function(){
          //Despues de enviar mostamos el preloader
          $('.cargador').fadeIn('fast');
        },
        cache: false,
        type:"POST",
        dataType:"json",
        url:"/backend/ofertas/delete_oferta/",
        data: "&id_user="+str+"&reservar&id=" + Math.random(),
        success: function(response){
          
          if(response.respuesta == true) {
            //Ocultamos preloader
            $('.cargador').fadeOut('fast');
            //Removemos la fila de la tabla eliminada
            $('#table_id tbody tr#'+str).remove();

            //Mostramos los mensajes
            $('.msj').fadeOut('fast');
            $('.msj_status').html(response.mensaje);//Respuesta del servidor

            //Mensajes y Cerramos la ventana modal 
            setTimeout(function(){
              //Mostramos los mensajes
              $('#eliminar_registros_modal').modal('hide');
              $('.msj_status').html('');
              $('.msj').fadeIn('fast');
            }, 1000);
            
          } 

          if(response.respuesta == false) {
            //Ocultamos preloader
            $('.cargador').fadeOut('fast');
            //Cerramos la ventana modal
            $('#eliminar_registros_modal').modal('hide');
            //Mostramos el mensaje
            alert(response.mensaje);
          }
          
        },
        error:function(){
          alert('ERROR GENERAL DEL SISTEMA, INTENTELO MAS TARDE');  
        }
      });

    });
      

    
    /**
     * Start table data
     * Add styles & custom
     */
    $('#table_id').DataTable({
      paging: true,
      scrollY: 400,
      searching: true,
      ordering:  true,

      "language": {
        "search": "Buscar:",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No hay registros!",
        searchPlaceholder: "Ingrese palabra clave",
        "info": "Página _PAGE_ de _PAGES_",
        
          "paginate": {
            "previous": "Anterior",
            "first": "Primera página",
            "last": "Última página",
            "next": "Siguiente"
          }
      }
    });
} );

</script>

</body>
</html>