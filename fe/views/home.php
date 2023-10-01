<div class="content-wrapper"> 
  <section class="content">
    <h1 style="font-size:34px;font-weight: bold;">
    Panel de Control <br>
      <small class="badge btn btn-success" style="padding:5px;font-weight: bold;">Facturacion Electronica </small>
    </h1>


    <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">FACTURACION ELECTRONICA </h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
   <!-- /.content-header -->


  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <h2>Daskboard </h2>    
      <div class="row centrar">
        <div class="col-lg-4 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <!-- <?php
              /* $contador_de_usuarios = 0;
              foreach ($usuarios_datos as $usuarios_dato){
              $contador_de_usuarios = $contador_de_usuarios + 1;
              } */
              ?> -->
              <h3><?php echo '3';?></h3>
              <p>Facturacion Electronica</p>
              <a href="facturas">
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
              </a>
            </div>
            <a href="facturas" class="small-box-footer"> Más Informacion <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


             <div class="col-lg-4 col-6">
                 <div class="small-box bg-info">
                     <div class="inner">
                         <!-- <?php
                         /* $contador_de_roles = 0;
                         foreach ($roles_datos as $roles_dato){
                             $contador_de_roles = $contador_de_roles + 1;
                         } */
                         ?> -->
                         <h3><?php echo '12';?></h3>
                         <p>Documento Soporte</p>
                     </div>
                     <a href="roles/create.php">
                         <div class="icon">
                             <i class="fas fa-address-card"></i>
                         </div>
                     </a>
                     <a href="docSoporte" class="small-box-footer">
                         Más Informacion <i class="fas fa-arrow-circle-right"></i>
                     </a>
                 </div>
             </div>


             <div class="col-lg-4 col-6">
                 <div class="small-box bg-success">
                     <div class="inner">
                         <!-- <?php
                         /* $contador_de_categorias = 0;
                         foreach ($categorias_datos as $categorias_dato){
                             $contador_de_categorias = $contador_de_categorias + 1;
                         } */
                         ?> -->
                         <h3><?php echo '8';?></h3>
                         <p>Proveedores</p>
                     </div>
                     <a href="proveedores">
                         <div class="icon">
                             <i class="fas fa-tags"></i>
                         </div>
                     </a>
                     <a href="proveedores" class="small-box-footer">
                         Más Informacion <i class="fas fa-arrow-circle-right"></i>
                     </a>
                 </div>
             </div>


            <!-- <div class="col-lg-3 col-6">
                 <div class="small-box bg-primary">
                     <div class="inner">
                         <?php
                         /* $contador_de_productos = 0;
                         foreach ($productos_datos as $productos_dato){
                             $contador_de_productos = $contador_de_productos + 1;
                         } */
                         ?>
                         <h3><?php echo $contador_de_productos;?></h3>
                         <p>Productos Registrados</p>
                     </div>
                     <a href="<?php echo $URL;?>/almacen/create.php">
                         <div class="icon">
                             <i class="fas fa-list"></i>
                         </div>
                     </a>
                     <a href="<?php echo $URL;?>/almacen" class="small-box-footer">
                         Más detalle <i class="fas fa-arrow-circle-right"></i>
                     </a>
                 </div>
             </div> -->





            <!-- <div class="col-lg-3 col-6">
                 <div class="small-box bg-dark">
                     <div class="inner">
                         <?php
                         /* $contador_de_proveedores = 0;
                         foreach ($proveedores_datos as $proveedores_dato){
                             $contador_de_proveedores = $contador_de_proveedores + 1;
                         } */
                         ?>
                         <h3><?php echo $contador_de_proveedores;?></h3>
                         <p>Proveedores Registrados</p>
                     </div>
                     <a href="<?php echo $URL;?>/proveedores">
                         <div class="icon">
                             <i class="fas fa-car"></i>
                         </div>
                     </a>
                     <a href="<?php echo $URL;?>/proveedores" class="small-box-footer">
                         Más detalle <i class="fas fa-arrow-circle-right"></i>
                     </a>
                 </div>
             </div> -->



         </div>

         <!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content -->
</div>


    <!-- <div class="content">
      <div class="row moduloCentrar">
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3></h3>
              <p>Entradas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="entradas" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $requisiciones; ?><sup style="font-size: 20px"></sup></h3>
              <p>Requisiciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="requisiciones" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $pedidos; ?></h3>
              <p>Pedidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="pedidos" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $salidas; ?></h3>
              <p>Salidas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="salidas" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row" ></div>
    </div> -->
    <!-- <section class="container-fluid" style="margin-top:0px;margin-bottom: 5px;">
        <div class="container-fluid">
          </div> 
    </section> -->
  </section>
</div>