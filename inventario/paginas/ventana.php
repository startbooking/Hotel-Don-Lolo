<div id="a<?php echo $row['ID_PROD'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form name="form2" method="post" action="">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Actualizar Producto</h3>
      </div>
      <div class="modal-body">
        <div class="row-fluid">
          <div class="span6">
            <strong>Documento</strong><br>
            <input type="text" name="doc" autocomplete="off" readonly value="<?php echo $row['doc']; ?>"><br>
            <strong>Nombre del Profesor</strong><br>
            <input type="text" name="nom" autocomplete="off" required value="<?php echo $row['nom']; ?>"><br>
            <strong>Apellidos del Profesor</strong><br>
            <input type="text" name="ape" autocomplete="off" required value="<?php echo $row['ape']; ?>"><br>
            <strong>Especialidades</strong><br>
            <input type="text" name="especialidad" autocomplete="off" required value="<?php echo $row['especialidad'];?>"><br>
            <strong>Correo</strong><br>
            <input type="email" name="correo" autocomplete="off" required value="<?php echo $row['correo']; ?>"><br>
            <strong>Tipo de Usuario</strong><br>
            <select name="tipo">
              <option value="p" <?php if($row['tipo']=='p'){ echo 'selected'; } ?>>Profesor</option>
              <option value="a" <?php if($row['tipo']=='a'){ echo 'selected'; } ?>>Administrador</option>
            </select>
          </div>
          <div class="span6">
            <strong>Direccion</strong><br>
            <input type="text" name="dir" autocomplete="off" required value="<?php echo $row['dir']; ?>"><br>
            <strong>Telefonos</strong><br>
            <input type="text" name="tel" autocomplete="off" value="<?php echo $row['tel']; ?>"><br>
            <strong>Celulares</strong><br>
            <input type="text" name="cel" autocomplete="off" required value="<?php echo $row['cel']; ?>"><br>
            <strong>Fecha de Nacimiento</strong><br>
            <input type="date" name="fecha" autocomplete="off" required value="<?php echo $row['fecha']; ?>"><br>
            <strong>Estado</strong><br>
            <select name="estado">
              <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>Activo</option>
              <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>No Activo</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
      </div>
  </form>
</div>
