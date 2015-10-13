

<div class="head_3">
	<div class="container">
    	<div class="row">
			 <div class="col-xs-12">
             	<h1>Ofertas para particulares American Express</h1>
                
                <div class="ctn">
                
                	<div class="row">
                    	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 xs580Max_width_100 xs580Max_center">
                        	<ul class="media-boxes-filter" id="filter">
                                <li class="xs580Max_center">
                                    <a id="filter-1" class="selected" href="#" data-filter="*">
                                    <i><img src="/assets/images/icon/menu-icon-offers.png" width="34" height="30"></i>Todas las ofertas</a>
                                </li>
                                <li class="xs580Max_center">
                                    <a id="filter-2" href="#" data-filter=".viajes">
                                    <i><img src="/assets/images/icon/menu-icon-travel-2-.png" width="34" height="30"></i>Viajes</a>
                                </li>
                                <li class="xs580Max_center">
                                    <a id="filter-3" href="#" data-filter=".compras">
                                    <i><img src="/assets/images/icon/menu-icon-shopping-2-.png" width="34" height="30"></i>Compras</a>
                                </li>
                                <li class="xs580Max_center">
                                    <a id="filter-4" href="#" data-filter=".otros">
                                    <i><img src="/assets/images/icon/menu-icon-dining-2-.png" width="34" height="30"></i>Otros</a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 xs580Max_width_100">
                        	<input type="text" id="search" class="form-control" placeholder="Buscar..."
                                value="<?php echo !empty($_GET['q']) ? $_GET['q'] : '' ?>">
                        </div>
                    </div>
                    
                            
                </div>
                
                <div class="arrowHead_3">
                	<i class="fa fa-caret-down"></i>
                </div>
                
             </div>
        </div><!--End row-->     
    </div><!--End container-->
</div><!--End head_3-->







<section class="ctnBody">
	<div class="container">
    	<div class="row">
			 <div class="col-xs-12">


              <div id="grid"> 


                  <?php if($slider !== FALSE): ?>
                  <!--Slider-->
                  <div id="item-tags" class="media-box" data-columns="2">
                      <div href="#" class="ctn">
                        <div id="bannerHome" class="carousel slide" data-ride="carousel" data-interval="false">
                        
                          <!-- Wrapper for slides -->
                          <div class="carousel-inner">
                            
                            <?php 
                              foreach( $slider as $row ): 
                              $url  = "/ofertas/";
                              $url .= $row->name_category . "/";
                              $url .= $row->id;
                            
                              /**
                               * Eliminamos las comas del los tags 
                               * Los asignamos a item-tags
                               * Jquery se lo pasamos al item principal para filtrarlo en el buscador
                               */
                              $tags = str_replace(',', '', $row->tags);

                              /**
                               * Mostramos ofertas filtradas
                               * Entre fechas válidas 
                               */
                              date_default_timezone_set('GMT');
                              $actual = time();
                              $create = $row->create_strtotime;
                              $expira = $row->expira_strtotime;
                              if($actual >= $create && $actual <= $expira):
                            ?>
                            <div class="item itemTagsJquery" item-tags="<?php echo $tags; ?>">
                            	<a href="<?php echo $url; ?>">
                                    <img src="/assets/images/banner/ofertas/<?php echo $row->image; ?>" class="img-responsive">
                                    
                                    <?php if( !empty( $row->resumen ) ): ?>
                                    <div class="infoAdvert">
                                        <h2 class="titleGlobal"><?php echo $row->title; ?></h2>
                                        <p><?php echo  character_limiter($row->resumen, 200); ?></p>
                                    </div>
                                   <?php endif; ?>

                                </a>
                            </div>
                              <?php endif; ?>                         
                            <?php endforeach; ?> 

                          </div>
                        
                          <!-- Controls -->
                          <span class="left carousel-control" href="#bannerHome" role="button" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                          </span>
                          <span class="right carousel-control" href="#bannerHome" role="button" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                          </span>
                        </div>
                      </div>
                  </div>
                  <!--End Slider-->
                  <?php endif; ?>




                  <?php if($ofertas !== FALSE): ?>
                    <?php 
                      foreach($ofertas as $row): 
                      
                      //Definimos la URL
                      $url  = "/ofertas/";
                      $url .= $row->name_category . "/";
                      $url .= $row->id;

                      //Quitamos las comas de los Tags
                      $tags = str_replace(',', ' ', trim($row->tags) );

                      //Cantidad de columnas anuncio horiontal (special)
                      switch ($row->type) {
                        case 'special':
                          $col = 'data-columns="2"';
                          break;
                        
                        default:
                          $col = "";
                          break;
                      }

                      /**
                       * Mostramos ofertas filtradas
                       * Entre fechas válidas 
                       */
                      $actual = strtotime( date('Y-m-d H:i:s') );
                      $create = $row->create_strtotime;
                      $expira = $row->expira_strtotime;
                      if( $actual >= $create && $actual <= $expira ):
                    ?> 
                    <div class="media-box <?php echo $tags; ?>" <?php echo $col; ?>>

                        <?php if( empty( $row->external_link ) ): ?>
                          <a href="<?php echo $url; ?>" class="ctn">
                        <?php else: ?>
                          <a href="<?php echo $row->external_link; ?>" target="_blank" class="ctn">
                        <?php endif; ?>

                        <?php if( !empty($row->label_image) ): ?>
                        <div class="label">
                          <img src="/assets/images/label/<?php echo $row->label_image; ?>">
                        </div>
                        <?php endif; ?>

                        	<img src="/assets/images/banner/ofertas/<?php echo $row->image; ?>" class="img-responsive">
                            
                          <?php if( !empty( $row->resumen ) ): ?>
                          <div class="infoAdvert">
                              <h2 class="titleGlobal"><?php echo $row->title; ?></h2>
                            <p><?php echo  character_limiter($row->resumen, 80); ?></p>
                          </div>
                         <?php endif; ?>

                        </a>
                    </div>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>

              </div>


             </div>
        </div><!--End row-->     
    </div><!--End container-->
</section><!--End head_3-->