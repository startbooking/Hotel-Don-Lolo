    <div class="content-wrapper" style="margin-bottom: 50px"> 
      <section class="content" style="padding:0">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="usuarios">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-user-circle-o"></i> Usuarios </h3>
              </div>
              <div class="col-lg-6" align="right">
                <a 
                  data-toggle="modal" 
                  style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarUsuario">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Usuario</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="container-fluid" style="padding:0"> 
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning">
                    <td>Usuario</td>
                    <td>Apellidos</td>
                    <td>Nombre</td>
                    <td>Correo</td>
                    <td>Celular</td>
                    <td>Tipo</td>
                    <td>Estado</td>
                    <td>Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($usuarios as $usuario) { ?>
                    <tr style='font-size:12px'>
                      <td width="22px"><?php echo $usuario['usuario']; ?></td>
                      <td><?php echo $usuario['apellidos']; ?></td>
                      <td><?php echo $usuario['nombres']; ?></td>
                      <td><?php echo $usuario['celular']; ?></td>
                      <td style="width: 20%"><?php echo $usuario['correo']; ?></td>
                      <td align="left" style="width: 10%"><?php echo tipoUsuario($usuario['tipo']); ?></td>
                      <td align="left"><?php echo estadoUsuario($usuario['estado']); ?></td>
                      <td style="padding:3px;width: 11%">
                        <div class="btn-toolbar" role="toolbar" aria-label="...">
                          <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-success btn-xs" 
                              data-toggle         ="modal" 
                              data-id             ="<?php echo $usuario['usuario_id']?>" 
                              data-usuario        ="<?php echo $usuario['usuario']?>" 
                              data-apellidos      ="<?php echo $usuario['apellidos']?>" 
                              data-nombres        ="<?php echo $usuario['nombres']?>" 
                              data-identificacion ="<?php echo $usuario['identificacion']?>" 
                              data-correo         ="<?php echo $usuario['correo']?>" 
                              data-estado         ="<?php echo $usuario['estado']?>" 
                              data-telefono       ="<?php echo $usuario['telefono']?>" 
                              data-celular        ="<?php echo $usuario['celular']?>" 
                              data-tipo           ="<?php echo $usuario['tipo']?>" 
                              data-foto           ="<?php echo $usuario['foto_usuario']?>" 
                              data-pos            ="<?php echo $usuario['pos']?>" 
                              data-pms            ="<?php echo $usuario['pms']?>" 
                              data-inv            ="<?php echo $usuario['inv']?>" 
                              href                ="#myModalActualizaUsuario"
                              title               ="Modificar El Usuario Actual" >
                              <i class="fa fa-address-card-o" aria-hidden="true"></i>
                            </button>
                            <button 
                              type           ="button" 
                              class          ="btn btn-info btn-xs" 
                              data-toggle    ="modal" 
                              data-id        ="<?php echo $usuario['usuario_id']?>" 
                              data-apellidos ="<?php echo $usuario['apellidos']?>" 
                              data-nombres   ="<?php echo $usuario['nombres']?>" 
                              data-usuario   ="<?php echo $usuario['usuario']?>" 
                              href           ="#myModalAsignaClave"
                              title          ="Asigna Contraseña al Usuario Actual" >
                              <i class="fa fa-key" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" 
                              data-toggle    ="modal" 
                              data-id        ="<?php echo $usuario['usuario_id']?>" 
                              data-apellidos ="<?php echo $usuario['apellidos']?>" 
                              data-nombres   ="<?php echo $usuario['nombres']?>" 
                              data-usuario   ="<?php echo $usuario['usuario']?>" 
                              data-estado    ="<?php echo $usuario['estado']?>" 
                              href           ="#myModalReabrirUsuario"
                              title          ="Re-Abre Cajero actual" >
                              <i class="fa fa-unlock" aria-hidden="true"></i>
                            </button>                          
                          </div>
                          <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-danger btn-xs" 
                              data-toggle    ="modal" 
                              data-id        ="<?php echo $usuario['usuario_id']?>" 
                              data-apellidos ="<?php echo $usuario['apellidos']?>" 
                              data-nombres   ="<?php echo $usuario['nombres']?>" 
                              data-usuario   ="<?php echo $usuario['usuario']?>" 
                              data-estado    ="<?php echo $usuario['estado']?>" 
                              href           ="#myModalBloquearUsuario"
                              title          ="Bloquea El Usuario Actual" >
                              <i style="font-size:16px" class="fa fa-ban" aria-hidden="true"></i>
                            </button>                          
                          </div>                            
                        </div>
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
