

<!--Body-->
<section id="#a_body">
  <article>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 frame">
          
          <div class="boxes">

            <div class="boxes_head">
              <h1>Agregar nueva oferta</h1>

              <!--Breadcrumbs-->
              <ol class="breadcrumb">
                <li>
                  <a href="/backend">Inicio</a>
                </li>
                <li>
                  <a href="/backend">backend</a>
                </li>
                <li class="active">Agregar nueva oferta</li>
              </ol>
              <!--End Breadcrumbs-->
              </div><!--End boxes_head-->

            <div class="boxes_body">

              <form action="/backend/ofertas/add_ofertas" method="POST" class="form-horizontal"id="form" role="form" enctype="multipart/form-data">

              <table id="table_id" class="table_form table table-striped table-bordered table-hover table-condensed display">
                <tbody>

                  <tr>
                    <td><span>Categoría:</span></td>
                    <td>
                      <div class="form-group">
                        <select name="category" id="category" class="form-control">
                          <option value="">Seleccione la categoría</option>
                          <?php foreach($category as $row): ?>
                          <option value="<?php echo $row->id. "-" .$row->name; ?>"><?php echo $row->name; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Tags:</span></td>
                    <td>
                      <div class="checkbox">
                        <div class="form-group">
                          <ul>
                            <li class="text2"><input type="checkbox" name="tags[]" value="all">all</li> 
                            <li class="text1"><input type="checkbox" name="tags[]" value="compras">Compras</li>
                            <li class="text2"><input type="checkbox" name="tags[]" value="otros">Otros</li>
                            <li class="text2"><input type="checkbox" name="tags[]" value="viajes">Viajes</li> 
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  
                  <tr>
                    <td><span>Compartir:</span></td>
                    <td>
                      <div class="checkbox">
                        <div class="form-group">
                          <ul>
                            <li class="text2"><input type="checkbox" name="share" value="1"></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr id="label_td">
                    <td><span>Label:</span></td>
                    <td>
                      <div class="form-group">
                        <select name="label" id="label" class="form-control">
                          <option value="">Seleccione</option>
                          <option value="">Ninguno (La oferta sin label)</option>
                          <?php foreach($label as $row): ?>
                          <option value="<?php echo $row->image; ?>"><?php echo $row->title; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Titulo:</span></td>
                    <td>
                      <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Ingrese titulo de la oferta">
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Resumen:</span></td>
                    <td>
                      <div class="form-group">
                        <textarea name="resumen" id="resumen"  class="form-control" cols="30" rows="3" maxlength="200"></textarea>
                        <div id="contador"></div>
                      </div>
                      <div class="alert alert-danger"><strong>Nota: </strong>Si este campo lo deja en blanco, el resumen de esta oferta no se mostrará sobre la imagén.</div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Descripción:</span></td>
                    <td>
                      <div class="form-group">
                        <textarea name="description" id="description"  class="form-control" cols="30" rows="10"></textarea>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Imagen:</span></td>
                    <td>
                      <div class="form-group">
                        <input type="file" name="image" id="image">
                        <div id="image_msj" class="alert alert-warning oculto"></div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Anuncio:</span></td>
                    <td>
                      <div class="form-group">
                        <select name="type_anuncio" id="type_anuncio" class="form-control">
                          <option value="" selected >No seleccionar</option>
                          <option value="standart">Estandar (1 Columna)</option>
                          <option value="special">Especial (2 Columnas)</option>
                          <option value="slider">Slider (Banner principal)</option>
                        </select>
                        <div class="alert alert-danger">
                        <strong>Importante:</strong> No modificar esta opción, usted debe seleccionar una categoría en el inicio de este formulario y el sistema selecionará automáticamente algunas de estas opciones.
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Fechas:</span></td>
                    <td>
                      <div class="row">
                        <div class='col-xs-6'>
                          <div class="form-group">
                            <div class='input-group date' id='create'>
                              <input type='text' class="form-control" name="create" placeholder="Fecha de creación" />
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class='col-xs-6'>
                          <div class="form-group">
                            <div class='input-group date' id='expira'>
                              <input type='text' class="form-control" name="expira" placeholder="Fecha de finalización" />
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Términos&nbsp;y&nbsp;condiciones:</span></td>
                    <td>
                      <div class="form-group">
                        <textarea name="terms" id="terms"  class="form-control" cols="30" rows="10"></textarea>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td><span>Enlace externo:</span></td>
                    <td>
                      <div class="form-group">
                        <input type="text" class="form-control" id="external_link" name="external_link" placeholder="Ingrese el enlace externo de la oferta">
                      </div>
                      <div class="alert alert-danger"><strong>Nota: </strong> Debe ingresar el enlace externo completo, ejemplo: https://www.pagina.com/oferta/ejemplo/link.php?completo=1</div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <span>Oferta: <span class="label label-info">BARRA LATERAL #1</span></span>                      
                    </td>
                    <td>
                      <p>Titulo:</p>
                      <p>
                        <div class="form-group">
                          <input type="text" value="" class="form-control" id="bar_offert_title" name="bar_offert_title" placeholder="Ingrese titulo de la oferta">
                        </div>
                      </p>
                        
                      <p>Detalle:</p>
                      <p>
                        <div class="form-group">
                          <textarea name="bar_offert_description" id="bar_offert_description" class="form-control" cols="30" rows="5" maxlength="200"></textarea>
                        </div>
                      </p>
                    </td>
                  </tr>

                  <tr>
                    <td><span></span></td>
                    <td>
                      <button type="submit" name="agregar" class="btn btn-primary">Agregar anuncio</button>&nbsp;
                      <a href="javascript:history.back();" class="btn btn-default">Cancelar</a>
                    </td>
                  </tr>

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
<script src="/assets/backend/js/moment.min.js"></script>
<script src="/assets/backend/js/bootstrap-datetimepicker.js"></script>



<script type="text/javascript" src="/assets/backend/lib/tinymce/tinymce.min.js"></script>
<script type="text/javascript">

//Star validation
$(function() {

    //Start editor HTLM
    tinymce.init({
        selector: "#description",
        plugins: "link",
     });

    //Start editor HTLM
    tinymce.init({
        selector: "#terms",
        plugins: "link",
     });

     //Start editor HTLM
    tinymce.init({
        selector: "#bar_offert_description",
        plugins: "link",
     });

    //Cambias opciones dinamicas según la categoría seleccionada
    $('#category').on('change', function() {
      var seleccion = this.value;

      switch(seleccion) {

        case '5-slider'://Categoría principal
          $("#label_td").fadeOut('fast');
          $('#type_anuncio').val('slider');//Select anuncio
          $('#image_msj').removeClass('oculto').text('El slider (Banner principal) las caracteristicas de la imagen deben ser: (Ancho: 625px) - (Alto: 451px) ');
          break;

        case '6-special'://Categoría principal
          $("#label_td").fadeIn('fast');
          $('#type_anuncio').val('special');//Select anuncio
          $('#image_msj').removeClass('oculto').text('El Banner (special 2 columnas) las caracteristicas de la imagen deben ser: (Ancho: 625px) - (Alto: 214px) ');
          break;

        default :
          $("#label_td").fadeIn('fast');
          $('#type_anuncio').val('standart');//Select anuncio
          $('#image_msj').removeClass('oculto').text('El Banner (estandar 1 columnas) las caracteristicas de la imagen deben ser: (Ancho: 625px) - (Alto: 445px) ');
          break;
      }
    });


    //Sistema de fechas
    $('#create').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss'
    });
    $('#expira').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss'
    });
    $("#create").on("dp.change", function (e) {
        $('#expira').data("DateTimePicker").minDate(e.date);
    });
    $("#expira").on("dp.change", function (e) {
        $('#create').data("DateTimePicker").maxDate(e.date);
    });

    //Contador de caracteres
    var text_max = 200;
    $('#contador').html(text_max + ' caracteres restantes.');
    
    $('#resumen').keyup(function() {
        var text_length = $('#resumen').val().length;
        var text_remaining = text_max - text_length;
        
        $('#contador').html(text_remaining + ' caracteres restantes.');
    });


    

    //Star validation
    $('#form').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            category: {
                validators: {
                    notEmpty: {
                        message: 'Obligatorio!'
                    }
                }
            },
            'tags[]': {
                validators: {
                    notEmpty: {
                        message: 'Obligatorio'
                    },
                    choice: {
                        min: 1,
                        max: 4,
                        message: 'Seleccione una opción'
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                        message: 'Obligatorio!'
                    },
                    stringLength: {
                        min: 6,
                        max: 120,
                        message: 'Ingrese entre 6 y 120 carácteres.'
                    }
                }
            },
            resumen: {
                validators: {
                    stringLength: {
                        max: 200,
                        message: 'Ingrese entre 150 y 200 carácteres.'
                    }
                }
            },
            image: {
                validators: {
                    notEmpty: {
                      message: 'Obligatorio!'
                    },
                    file: {
                        extension: 'jpg,jpeg,png,gif',
                        type: 'image/jpg,image/jpeg,image/png,image/gif',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'La imagen no es válida.'
                    }
                }
            },
            type_anuncio: {
                validators: {
                    notEmpty: {
                        message: 'Obligatorio!'
                    }
                }
            },
            create: {
                validators: {
                    notEmpty: {
                        message: 'Obligatorio!'
                    }
                }
            },
            expira: {
                validators: {
                    notEmpty: {
                        message: 'Obligatorio!'
                    }
                }
            }
        }
    });
});

</script>

</body>
</html>