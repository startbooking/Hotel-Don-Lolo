<?php 
require '../../res/php/app_topPos.php';

?>

<section class="coid_antent" style="padding:10px;">
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="row producto">
				<div class="col-lg-6 col-xs-12">
					<input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_POS; ?>">
					<input type="hidden" name="ubicacion" id="ubicacion" value="margenProductos">
          <h3 class="text-center">Análisis de Costos Recetas Estandar</h3>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="container-fluid" style="padding:0">
        <div class="container">
          <div class="selection-section">
            <label for="recetas_estandar" class="col-lg-3">Seleccione la Receta Estandar:</label>
            <div class="form-group col-lg-4">
              <select class="form-control" id="recetas_estandar" onchange="cargarDatosAnalisis()" required>
                </select>
              </div>
          </div>
        </div>
        <div class="container">
          <div id="analisis_area" style="display: none;">
            <fieldset class="summary-box">
              <legend>Resumen de Rentabilidad</legend>
              <div class="summary-grid">
                <div class="kpi">
                  <span class="label">Precio de Venta Sugerido (PVS)</span>
                  <span id="pvs" class="value price">$ 0.00</span>
                  <span class="unit-label">por unidad</span>
                </div>
                <div class="kpi">
                  <span class="label">Costo Total Estándar</span>
                  <span id="costo_total" class="value cost">$ 0.00</span>
                  <span class="unit-label">por unidad</span>
                </div>
                <div class="kpi margin-kpi">
                  <span class="label">Margen Bruto Unitario</span>
                  <span id="margen_unitario" class="value">$ 0.00</span>
                  <span class="unit-label">PVS - Costo Total</span>
                </div>
                <div class="kpi margin-kpi">
                  <span class="label">Margen %</span>
                  <span id="margen_porcentaje" class="value percentage">0.00%</span>
                  <span class="unit-label">((PVS - Costo) / PVS) * 100</span>
                </div>
              </div>
            </fieldset>
        
            <fieldset class="cost-breakdown">
              <legend>Desglose del Costo Estándar</legend>
              <table id="costoTable">
                <thead>
                  <tr>
                    <th>Concepto de Costo</th>
                    <th>Unidad de Medida</th>
                    <th>Cantidad Estándar</th>
                    <th>Costo Unitario Estándar</th>
                    <th>Costo Total por Unidad de PT</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr class="total-row">
                    <td colspan="4">Costo Total de Producción (Suma)</td>
                    <td id="footer_costo_total">$ 0.00</td>
                  </tr>
                </tfoot>
              </table>
            </fieldset>
          </div>
        </div>
			</div>
		</div>
	</div>
</section>
