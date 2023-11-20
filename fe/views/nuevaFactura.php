<div class="content-wrapper" style="min-height: 555px;">
  <!-- **********************MODALS***************** -->
  <div class="modal fade " id="customer-modal" tabindex="-1">
    <form action="https://pos.creatantech.com/index.php/#" class="" id="customer-form" method="post" accept-charset="utf-8">
      <input type="hidden" name="csrf_test_name" value="fb042f964c4050226497c097563df028">      
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header header-custom">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title text-center">Agregar Cliente</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="customer_name">Nombre del cliente*</label>
                    <span id="customer_name_msg" class="text-danger text-right pull-right"></span>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="mobile">Móvil</label>
                    <span id="mobile_msg" class="text-danger text-right pull-right"></span>
                    <input type="tel" class="form-control no_special_char_no_space " id="mobile" name="mobile" placeholder="">
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <span id="phone_msg" class="text-danger text-right pull-right"></span>
                    <input type="tel" maxlength="10" class="form-control maxlength no_special_char_no_space " id="phone" name="phone" placeholder="">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <span id="email_msg" class="text-danger text-right pull-right"></span>
                    <input type="email" class="form-control " id="email" name="email" placeholder="">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="opening_balance"></label>
                    <span id="opening_balance_msg" class="text-danger text-right pull-right"></span>
                    <input type="text" class="form-control" id="opening_balance" name="opening_balance" placeholder="">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="gstin_msg">Identificacion</label>
                    <span id="gstin_msg" class="text-danger text-right pull-right"></span>
                    <input type="text" class="form-control maxlength  " id="gstin" name="gstin" placeholder="">
                  </div>
                </div>
              </div>

              <!-- <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="tax_number">TAX Número</label>
                    <span id="tax_number_msg" class="text-danger text-right pull-right"></span>
                    <input type="text" class="form-control maxlength  " id="tax_number" name="tax_number" placeholder="">
                  </div>
                </div>
              </div> -->
              <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="country">Tipo Documento</label>
                    <span id="country_msg" class="text-danger text-right pull-right"></span>
                    <select class="form-control select2 select2-hidden-accessible" id="country" name="country" style="width: 100%;" onkeyup="shift_cursor(event,'state')" value="" tabindex="-1" aria-hidden="true">
                      <option value="1">India</option>
                      <option value="2">USA</option>                                        
                    </select>
                    <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                      <span class="selection">
                        <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-country-container">
                          <span class="select2-selection__rendered" id="select2-country-container" title="India">India</span>
                          <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                        </span>
                      </span>
                      <span class="dropdown-wrapper" aria-hidden="true"></span>
                    </span>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="state">Estado</label>
                    <span id="state_msg" class="text-danger text-right pull-right"></span>
                    <select class="form-control" id="state" name="state" style="width: 100%;" onkeyup="shift_cursor(event,'state_code')">
                      <option value="">-Select-</option><option value="23">Karnataka</option><option value="24">Maharashtra</option><option value="25">Andhra Pradesh</option><option value="26">Arunachal Pradesh</option><option value="27">Assam</option><option value="28">Bihar</option><option value="29">Chhattisgarh</option><option value="30">Goa</option><option value="31">Gujarat</option><option value="32">Haryana</option><option value="33">Himachal Pradesh</option><option value="34">Jammu and Kashmir</option><option value="35">Jharkhand</option><option value="36">Kerala</option><option value="37">Madhya Pradesh</option><option value="38">Manipur</option><option value="39">Meghalaya</option><option value="40">Mizoram</option><option value="41">Nagaland</option><option value="42">Odisha</option><option value="43">Punjab</option><option value="44">Rajasthan</option><option value="45">Sikkim</option><option value="46">Tamil Nadu</option><option value="47">Telangana</option><option value="48">Tripura</option><option value="49">Uttar Pradesh</option><option value="50">Uttarakhand</option><option value="51">West Bengal</option><option value="52">New York</option><option value="53">Delhi</option>                                        </select>
                  </div>
                </div>
              </div> -->
              <!-- <div class="col-md-4">
                <div class="box-body">
                  <div class="form-group">
                    <label for="city">Ciudad</label>
                    <span id="city_msg" class="text-danger text-right pull-right"></span>
                    <input type="text" class="form-control" id="city" name="city" placeholder="">
                  </div>
                </div>
              </div> -->
            <!-- <div class="col-md-4">
              <div class="box-body">
                <div class="form-group">
                  <label for="postcode">Código postal</label>
                  <span id="postcode_msg" class="text-danger text-right pull-right"></span>
                  <input type="text" class="form-control" id="postcode" name="postcode" placeholder="">
                </div>
              </div>
            </div> -->
            <!-- <div class="col-md-4">
              <div class="box-body">
                <div class="form-group">
                  <label for="address">Dirección</label>
                  <span id="address_msg" class="text-danger text-right pull-right"></span>
                  <textarea type="text" class="form-control" id="address" name="address" placeholder=""></textarea>
                </div>
              </div>
            </div> -->
          </div>                       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_customer">Save</button>
        </div>
      </div>
        <!-- /.modal-content -->
      </div>
              <!-- /.modal-dialog -->
    </form>              
  </div>
              <!-- /.modal -->    
  <div class="sales_item_modal">
    <div class="modal fade in" id="sales_item" tabindex="-1">
      <div class="modal-dialog ">
         <div class="modal-content">
            <div class="modal-header header-custom">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span></button>
               <h4 class="modal-title text-center">Gestionar artículo de venta</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                    <div class="row invoice-info">
                      <div class="col-sm-6 invoice-col">
                        <b>Nombre del árticulo : </b> 
                        <span id="popup_item_name">
                          <span></span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                     <div>                        
                        <div class="col-md-12 ">
                           <div class="box box-solid bg-gray">
                              <div class="box-body">
                                 <div class="row">
                                    
                                    <div class="col-md-6 block">
                                        <div class="form-group">
                                          <label for="popup_tax_type">Tipo de impuesto</label>
                                        <select class="form-control" id="popup_tax_type" name="popup_tax_id" style="width: 100%;">
                                          <option value="Exclusive">Exclusive</option>
                                          <option value="Inclusive">Inclusive</option>
                                          </select>
                                        </div>                                  
                                    </div>

                                    <div class="col-md-6 block">
                                        <div class="form-group">
                                          <label for="popup_tax_id">Impuesto</label>
                                         <select class="form-control" id="popup_tax_id" name="popup_tax_id" style="width: 100%;">
                                            <option value="">-Select-</option><option data-tax="5.00" data-tax-value="Vat 5%" value="4">Vat 5%</option><option data-tax="10.00" data-tax-value="Tax 10%" value="5">Tax 10%</option><option data-tax="18.00" data-tax-value="Tax 18%" value="6">Tax 18%</option><option data-tax="4.50" data-tax-value="IGST 4.5%" value="7">IGST 4.5%</option><option data-tax="4.50" data-tax-value="SGST 4.5%" value="8">SGST 4.5%</option><option data-tax="9.00" data-tax-value="GST 9%" value="9">GST 9%</option><option data-tax="9.00" data-tax-value="ISGT 9%" value="10">ISGT 9%</option><option data-tax="9.00" data-tax-value="SGST 9%" value="11">SGST 9%</option><option data-tax="18.00" data-tax-value="GST 18%" value="12">GST 18%</option><option data-tax="0.00" data-tax-value="None" value="13">None</option>                                                  </select>
                                        </div>
                                   
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="item_discount_type"></label>
                                         <select class="form-control" id="item_discount_type" name="item_discount_type" style="width: 100%;">
                                          <option value="Percentage">Percentage(%)</option>
                                          <option value="Fixed">Fixed()</option>
                                          </select>
                                        </div>
                                   
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="item_discount_input">Descuento</label>
                                        <input type="text" class="form-control only_currency" id="item_discount_input" name="item_discount_input" placeholder="" value="0">
                                      </div>                                   
                                    </div>                                   
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="popup_tax_type">Descripción</label>
                                         <textarea type="text" class="form-control" id="popup_description" placeholder=""></textarea>
                                        </div>
                                   
                                    </div>

                                    <!-- <div class="col-md-6">
                                       <div class="">
                                          <label for="popup_tax_amt">Tax Amount</label>
                                          <input type="text" class="form-control text-right paid_amt" id="popup_tax_amt" name="popup_tax_amt" readonly>
                                          <span id="popup_tax_amt_msg"  style="display:none" class="text-danger"></span>
                                       </div>
                                    </div> -->

                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- col-md-12 -->
                     </div>
                  </div>
                  <!-- col-md-9 -->
                  <!-- RIGHT HAND -->
               </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" id="popup_row_id">
               <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
               <button type="button" onclick="set_info()" class="btn bg-green btn-lg place_order btn-lg">Set<i class="fa  fa-check "></i></button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
</div>
  <!-- **********************MODALS END***************** -->
  <!-- Main content -->
  <section class="container-fluid pd5" style="padding: 0 5px 0 0;">
    <div class="row mr0">   
      <!-- left column -->
      <div class="col-md-7" > 
        <!-- general form elements -->
        <div class="box box-primary">
          <!-- form start -->
          <form class="form-horizontal" id="pos-form">
            <div class="box-header with-border" style="padding-bottom: 0px;">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <h3 class="box-title"><i class="fa fa-shopping-cart"></i> Factura de Ventas</h3>
                  </div>                                                  
                </div>
              </div>            
            </div>
            <!-- 
            <input type="hidden" name="csrf_test_name" value="fb042f964c4050226497c097563df028">
            <input type="hidden" value="0" id="hidden_rowcount" name="hidden_rowcount">
            <input type="hidden" value="" id="hidden_invoice_id" name="hidden_invoice_id">
            <input type="hidden" id="base_url" value="https://pos.creatantech.com/">
            <input type="hidden" value="" id="temp_customer_id" name="temp_customer_id"> -->              
            <!-- **********************MODALS***************** -->
            <div class="modal fade" id="multiple-payments-modal" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header header-custom">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title text-center">Pagos</h4>
                  </div>
                  <div class="modal-body">          
                    <div class="row">
                      <div class="col-md-8"><div>
                        <input type="hidden" data-var="inside_else" name="payment_row_count" id="payment_row_count" value="1">
                        <div class="col-md-12  payments_div">
                          <div class="box box-solid bg-gray">
                            <div class="box-body">
                              <div class="row">        
                                <div class="col-md-6">
                                  <div class="">
                                    <label for="amount_1">Cantidad</label>
                                    <input type="text" class="form-control text-right payment" id="amount_1" name="amount_1" placeholder="" onkeyup="calculate_payments()">
                                    <span id="amount_1_msg" style="display:none" class="text-danger"></span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="">
                                    <label for="payment_type_1">Formas de Pago</label>
                                    <select class="form-control" id="payment_type_1" name="payment_type_1">
                                      <option value="Cash">Cash</option>
                                      <option value="Card">Card</option>
                                      <option value="Paytm">Paytm</option>
                                      <option value="Finance">Finance</option>
                                    </select>
                                    <span id="payment_type_1_msg" style="display:none" class="text-danger"></span>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                              </div>  
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="">
                                    <label for="payment_note_1">Notas</label>
                                    <textarea type="text" class="form-control" id="payment_note_1" name="payment_note_1" placeholder=""></textarea>
                                    <span id="payment_note_1_msg" style="display:none" class="text-danger"></span>
                                  </div>
                                </div>                
                                <div class="clearfix"></div>
                              </div>   
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-block" id="add_payment_row">Agregar Forma de Pago</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="col-md-12">
                      <div class="box box-solid bg-blue">
                        <div class="box-body">
                          <div class="row ">
                            <div class="col-md-12 border-custom-bottom">
                              <span class="col-md-6 text-right text-bold ">Items:</span>
                              <span class="col-md-6 text-right text-bold  custom-font-size sales_div_tot_qty">0.00</span>
                            </div>
                          </div>
                          <div class="row ">
                            <div class="col-md-12 border-custom-bottom">
                              <span class="col-md-6 text-right text-bold ">Total:</span>
                              <span class="col-md-6 text-right text-bold  custom-font-size sales_div_tot_amt">0.00</span>
                            </div>
                          </div>
                          <div class="row ">
                            <div class="col-md-12 border-custom-bottom">
                              <span class="col-md-6 text-right text-bold ">Descuentos(-):</span>
                              <span class="col-md-6 text-right text-bold  custom-font-size sales_div_tot_discount">0.00</span>
                            </div>
                          </div>
                          <div class="row bg-red">
                            <div class="col-md-12 border-custom-bottom">
                              <span class="col-md-6 text-right text-bold ">Total a Pagar:</span>
                              <span class="col-md-6 text-right text-bold  custom-font-size sales_div_tot_payble">0.00</span>
                            </div>
                          </div>
                          <div class="row ">
                            <div class="col-md-12 border-custom-bottom">
                              <span class="col-md-6 text-right text-bold ">Total Paying:</span>
                              <span class="col-md-6 text-right text-bold  custom-font-size sales_div_tot_paid">0.00</span>
                            </div>
                          </div>
                          <div class="row ">
                            <div class="col-md-12 border-custom-bottom">
                              <span class="col-md-6 text-right text-bold ">Balance:</span>
                              <span class="col-md-6 text-right text-bold  custom-font-size sales_div_tot_balance">0.00</span>
                            </div>
                          </div>
                          <div class="row ">
                            <div class="col-md-12 bg-orange">
                              <span class="col-md-6 text-right text-bold ">Vueltas</span>
                              <span class="col-md-6 text-right text-bold  custom-font-size sales_div_change_return">0.00</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>        
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn bg-maroon btn-lg make_sale btn-lg" onclick="save()"><i class="fa  fa-save "></i> Guardar</button>
                <button type="button" class="btn btn-success btn-lg make_sale btn-lg" onclick="save(true)"><i class="fa  fa-print "></i> Guardar &amp; Imprimir</button>
              </div>
            </div>
            <!-- /.modal-content -->
            </div>
            </div>              
            <!-- **********************MODALS END***************** -->
            <!-- **********************MODALS***************** -->
            <div class="modal fade" id="discount-modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Set Discount</h4>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="discount_input">Discount</label>
                              <input type="text" class="form-control" id="discount_input" name="discount_input" placeholder="" value="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="discount_type">Discount Type</label>
                              <select class="form-control" id="discount_type" name="discount_type">
                                <option value="in_percentage">Per%</option>
                                <option value="in_fixed">Fixed</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary discount_update">Update</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- **********************MODALS END***************** -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon" title="Customer"><i class="fa fa-user"></i></span>
                    <select class="form-control select2" id="customer_id" name="customer_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <option value="1" selected="">Ventas Mostrador</option>
                    </select>
                    <span class="input-group-addon pointer" data-toggle="modal" data-target="#customer-modal" title="New Customer?"><i class="fa fa-user-plus text-primary fa-lg"></i></span>
                  </div>
                  <span class="customer_points text-success" style="display: none;"></span>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon" title="Select Items"><i class="fa fa-barcode"></i></span>
                    <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                    <input type="text" class="form-control" placeholder="Item name/Barcode/Itemcode [Ctrl+Shift+S]" id="item_search" autocomplete="off">
                  </div>
                </div>                
              </div><!-- row end -->
              <div class="row mt10">
                <div class="col-md-12">
                  <div class="form-group" style="margin:0px;" >
                    <div class="col-sm-12 pd0 prdTable">
                      <table class="table table-condensed table-bordered table-striped table-responsive items_table" style="">
                        <thead class="bg-primary">
                          <tr>
                            <th width="30%">Nombre del árticulo</th>
                            <th width="25%">Cantidad</th>
                            <th width="15%">Precio</th>
                            <th width="10%">Descuento</th>
                            <th width="10%" class="block">Impuesto</th>
                            <th width="15%">SubTotal</th>
                            <th width="5%"><i class="fa fa-close"></i></th>
                          </tr>
                        </thead>
                        <tbody id="pos-form-tbody" style="font-size: 16px;font-weight: bold;overflow: scroll;">
                        </tbody>        
                        <tfoot>
                        </tfoot>              
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 ">
                  <div class="col-md-6">
                    <!-- <div class="checkbox icheck">
                      <div class="icheckbox_square-blue checked" style="position: relative;" aria-checked="false" aria-disabled="false">
                        <input type="checkbox" checked="" class="form-control" id="send_sms" name="send_sms" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                        <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                      </div>                             
                      <label for="sales_discount" class=" control-label">
                        <label for="send_sms">Enviar SMS al cliente</label>
                        <i class="hover-q " data-container="body" data-toggle="popover" data-placement="top" data-content="If checkbox is Disabled! You need to enable it from SMS -> SMS API <b>Note:<i>Walk-in Customer will not receive SMS!</i></b>" data-html="true" data-trigger="hover" data-original-title="Do you wants to send SMS ?" title="">
                          <i class="fa fa-info-circle text-maroon text-black hover-q"></i>
                        </i>
                      </label>
                    </div> -->
                  </div>
                  <div class="col-md-6 pr0">
                    <div class="form-group">
                      <label for="other_charges" class="col-sm-6 control-label">Otros cargos</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control text-right" id="other_charges" name="other_charges" placeholder="0.00" value="">
                        <span id="other_charges_msg" style="display:none" class="text-danger"></span>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>         
            </div>
            <!-- /.box-body -->

            <div class="box-footer bg-info">
              <div class="row">
                <div class="col-xs-3 text-right">
                  <label> Cantidad:</label>
                  <span class="text-bold tot_qty">0</span>
                </div>
                <div class="col-xs-3 text-right">
                  <label>Cantidad total:</label>
                  <span style="font-size: 19px;" class="tot_amt text-bold">0.00</span>
                </div>
                <div class="col-xs-3 text-right">
                  <label>Descuento total:<a class="fa fa-pencil-square-o cursor-pointer" data-toggle="modal" data-target="#discount-modal"></a></label>
                  <span style="font-size: 19px;" class="tot_disc text-bold">0.00</span>                  
                </div>
                <div class="col-xs-3 text-right">
                  <label>Gran total:</label>
                  <span style="font-size: 19px;" class="tot_grand text-bold">0.00</span>                  
                </div>
              </div>
             
              <div class="row">                             
                <div class="col-md-12 text-right">
                  <div class="col-sm-3">
                    <button type="button" id="hold_invoice" name="" class="btn bg-maroon btn-block btn-flat btn-lg" title="Hold Invoice [Ctrl+Shift+H]">
                      <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
                       Hold
                    </button>
                  </div>
                  <div class="col-sm-3">
                    <button type="button" id="" name="" class="btn btn-primary btn-block btn-flat btn-lg show_payments_modal" title="Multiple Payments [Ctrl+Shift+M]">
                      <i class="fa fa-credit-card" aria-hidden="true"></i>Multiple
                    </button>
                  </div>
                  <div class="col-sm-3">
                    <button type="button" id="show_cash_modal" name="" class="btn btn-success btn-block btn-flat btn-lg shift_c" title="By Cash &amp; Save [Ctrl+Shift+C]">
                      <i class="fa fa-money" aria-hidden="true"></i>Cash
                    </button>
                  </div>
                  <div class="col-sm-3">
                    <button type="button" id="pay_all" name="" class="btn bg-purple btn-block btn-flat btn-lg shift_a" title="By Cash &amp; Save [Ctrl+Shift+A]">
                      <i class="fa fa-money" aria-hidden="true"></i>Pay All</button>
                  </div>
                  

                        
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-5" style="padding: 0 0 0 5px;">
        <div class="box box-info">
          <div class="box-body">                
            <div class="row">
              <div class="col-md-6">
                <div class="input-group input-group-md">
                  <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option value="">Categorias</option>
                    <!-- <option value="6">Jeans</option>
                    <option value="10">Casual Shirts</option>
                    <option value="11">Formal Shirts</option>
                    <option value="12">T-Shirts</option>
                    <option value="13">Jackets</option>
                    <option value="14">Men Wears</option>
                    <option value="15">Books</option>
                    <option value="16">Computers</option>
                    <option value="17">Shoes</option>
                    <option value="18">Health Care</option>
                    <option value="19">Watches</option>
                    <option value="20">Mobiles</option>
                    <option value="21">Accessories</option>
                    <option value="22">cctv</option>  -->                   
                  </select>
                  <span class="dropdown-wrapper" aria-hidden="true"></span>
                </span>
                <span class="input-group-btn">
                  <button type="button" class="btn text-blue btn-flat reset_categories" title="" data-toggle="tooltip" data-placement="top" data-original-title="Reset Brand">
                    <i class="fa fa-undo"></i>
                  </button>
                </span>
              </div>
            </div>  
          </div>
              
          <div class="row">  
            <div class="col-md-12">
              <div class="input-group input-group-md">                   
                <input type="text" class="form-control" data-toggle="tooltip" title="" placeholder="Item Name" id="item_name" name="item_name" data-original-title="Enter Item Name">
                <span class="input-group-btn">
                  <button type="button" class="btn text-blue btn-flat reset_item_name" title="" data-toggle="tooltip" data-placement="top" data-original-title="Reset Item Name">
                    <i class="fa fa-undo"></i>
                  </button>
                </span>
              </div>
            </div>               
          </div>
          <div class="row">
            <div class="col-md-12">
              <section class="content" style="height: 500px;">
                <div class="row search_div" style="overflow-y: scroll;min-height: 100px;height: 500px;">
                  <div class="col-md-3 col-xs-4 " id="item_parent_0" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Lee Shirts">
                    <div class="panel">
                      <div class="panel-title">
                      </div>
                      <div class="panel-body">
                        <center>
                          <img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559021522_thumb.jpg" alt="Item picture">
                        </center>
                      </div>
                      <div class="panel-footer">
                        <label class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_0">Lee Shirts
                          <span class="" style="font-family: sans-serif;font-size:150%; "> 600.00</span>
                        </label>
                      </div>
                    </div>
                    <!-- <div class="row" id="div_1" onclick="addrow(1)" data-item-id="1" data-item-name="Lee Shirts" data-item-available-qty="5.00" data-item-sales-price="600.00" data-item-cost="550.00" data-item-tax-id="5" data-item-tax-type="Exclusive" data-item-tax-value="10.00" data-item-tax-name="Tax 10%" data-item-tax-amt="60.00" data-purchase_price="550.00" data-discount_type="Percentage" data-discount="0.00">
      	              <div class="box-body box-profile">
      	              </div>
    	              </div>
      	              -->
  	              </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_1" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Signature Jeans">
	          <div class="box box-default item_box" id="div_2" onclick="addrow(2)" data-item-id="2" data-item-name="Signature Jeans" data-item-available-qty="9.00" data-item-sales-price="1100.00" data-item-cost="1100.00" data-item-tax-id="5" data-item-tax-type="Exclusive" data-item-tax-value="10.00" data-item-tax-name="Tax 10%" data-item-tax-amt="110.00" data-purchase_price="1100.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="9.00 Quantity in Stock">Qty: 9.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559021569_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_1">Signature Jeans
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 1,100.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_2" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Lee Jacket">
	          <div class="box box-default item_box" id="div_3" onclick="addrow(3)" data-item-id="3" data-item-name="Lee Jacket" data-item-available-qty="6.00" data-item-sales-price="1100.00" data-item-cost="1000.00" data-item-tax-id="5" data-item-tax-type="Inclusive" data-item-tax-value="10.00" data-item-tax-name="Tax 10%" data-item-tax-amt="100.00" data-purchase_price="1000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="6.00 Quantity in Stock">Qty: 6.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559021603_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_2">Lee Jacket
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 1,100.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_3" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Suits">
	          <div class="box box-default item_box" id="div_4" onclick="addrow(4)" data-item-id="4" data-item-name="Suits" data-item-available-qty="5.00" data-item-sales-price="1100.00" data-item-cost="1100.00" data-item-tax-id="5" data-item-tax-type="Exclusive" data-item-tax-value="10.00" data-item-tax-name="Tax 10%" data-item-tax-amt="110.00" data-purchase_price="1100.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="5.00 Quantity in Stock">Qty: 5.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559021815_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_3">Suits
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 1,100.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_4" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Rd Shoes">
	          <div class="box box-default item_box" id="div_5" onclick="addrow(5)" data-item-id="5" data-item-name="Rd Shoes" data-item-available-qty="6.00" data-item-sales-price="1100.00" data-item-cost="1000.00" data-item-tax-id="6" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="Tax 18%" data-item-tax-amt="93.22" data-purchase_price="1000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="6.00 Quantity in Stock">Qty: 6.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559022339_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_4">Rd Shoes
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 1,100.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_5" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="VP Shoes">
	          <div class="box box-default item_box" id="div_6" onclick="addrow(6)" data-item-id="6" data-item-name="VP Shoes" data-item-available-qty="5.00" data-item-sales-price="1100.00" data-item-cost="1000.00" data-item-tax-id="5" data-item-tax-type="Inclusive" data-item-tax-value="10.00" data-item-tax-name="Tax 10%" data-item-tax-amt="100.00" data-purchase_price="1000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="5.00 Quantity in Stock">Qty: 5.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559022396_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_5">VP Shoes
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 1,100.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_6" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="WM Shoes">
	        <div class="box box-default item_box" id="div_7" onclick="addrow(7)" data-item-id="7" data-item-name="WM Shoes" data-item-available-qty="7.00" data-item-sales-price="1100.00" data-item-cost="1000.00" data-item-tax-id="6" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="Tax 18%" data-item-tax-amt="93.22" data-purchase_price="1000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="7.00 Quantity in Stock">Qty: 7.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559022495_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_6">WM Shoes
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 1,100.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_7" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="How to Analyze People">
	          <div class="box box-default item_box" id="div_8" onclick="addrow(8)" data-item-id="8" data-item-name="How to Analyze People" data-item-available-qty="9.00" data-item-sales-price="550.00" data-item-cost="500.00" data-item-tax-id="6" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="Tax 18%" data-item-tax-amt="46.61" data-purchase_price="500.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="9.00 Quantity in Stock">Qty: 9.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559022700_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_7">How to Analyze People
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 550.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_8" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="I Do What I Do">
	          <div class="box box-default item_box" id="div_9" onclick="addrow(9)" data-item-id="9" data-item-name="I Do What I Do" data-item-available-qty="15.00" data-item-sales-price="660.00" data-item-cost="600.00" data-item-tax-id="6" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="Tax 18%" data-item-tax-amt="55.93" data-purchase_price="600.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="15.00 Quantity in Stock">Qty: 15.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559022768_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_8">I Do What I Do
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 660.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_9" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Apple PC">
	          <div class="box box-default item_box" id="div_10" onclick="addrow(10)" data-item-id="10" data-item-name="Apple PC" data-item-available-qty="13.00" data-item-sales-price="11000.00" data-item-cost="10000.00" data-item-tax-id="6" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="Tax 18%" data-item-tax-amt="932.20" data-purchase_price="10000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="13.00 Quantity in Stock">Qty: 13.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559022862_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_9">Apple PC
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 11,000.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_10" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Apple Laptop">
	          <div class="box box-default item_box" id="div_11" onclick="addrow(11)" data-item-id="11" data-item-name="Apple Laptop" data-item-available-qty="16.00" data-item-sales-price="1100.00" data-item-cost="1000.00" data-item-tax-id="5" data-item-tax-type="Inclusive" data-item-tax-value="10.00" data-item-tax-name="Tax 10%" data-item-tax-amt="100.00" data-purchase_price="1000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="16.00 Quantity in Stock">Qty: 16.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559022944_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_10">Apple Laptop
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 1,100.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_11" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Povery shoe">
	          <div class="box box-default item_box" id="div_12" onclick="addrow(12)" data-item-id="12" data-item-name="Povery shoe" data-item-available-qty="21.00" data-item-sales-price="550.00" data-item-cost="500.00" data-item-tax-id="6" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="Tax 18%" data-item-tax-amt="46.61" data-purchase_price="500.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="21.00 Quantity in Stock">Qty: 21.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559026084_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_11">Povery shoe
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 550.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_12" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Ramayana">
	          <div class="box box-default item_box" id="div_13" onclick="addrow(13)" data-item-id="13" data-item-name="Ramayana" data-item-available-qty="28.00" data-item-sales-price="357.50" data-item-cost="325.00" data-item-tax-id="5" data-item-tax-type="Inclusive" data-item-tax-value="10.00" data-item-tax-name="Tax 10%" data-item-tax-amt="32.50" data-purchase_price="325.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="28.00 Quantity in Stock">Qty: 28.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1559547347_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_12">Ramayana
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 357.50
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_13" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Armany jacket">
	          <div class="box box-default item_box" id="div_14" onclick="addrow(14)" data-item-id="14" data-item-name="Armany jacket" data-item-available-qty="24.00" data-item-sales-price="2750.00" data-item-cost="2500.00" data-item-tax-id="4" data-item-tax-type="Inclusive" data-item-tax-value="5.00" data-item-tax-name="Vat 5%" data-item-tax-amt="261.90" data-purchase_price="2500.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="24.00 Quantity in Stock">Qty: 24.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1566110017_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_13">Armany jacket
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 2,750.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_14" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Colgate">
	          <div class="box box-default item_box" id="div_15" onclick="addrow(15)" data-item-id="15" data-item-name="Colgate" data-item-available-qty="28.00" data-item-sales-price="85.80" data-item-cost="78.00" data-item-tax-id="4" data-item-tax-type="Inclusive" data-item-tax-value="5.00" data-item-tax-name="Vat 5%" data-item-tax-amt="8.17" data-purchase_price="78.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="28.00 Quantity in Stock">Qty: 28.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1566111586_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_14">Colgate
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 85.80
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_15" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Rolex">
	          <div class="box box-default item_box" id="div_16" onclick="addrow(16)" data-item-id="16" data-item-name="Rolex" data-item-available-qty="34.00" data-item-sales-price="16500.00" data-item-cost="15000.00" data-item-tax-id="6" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="Tax 18%" data-item-tax-amt="1398.31" data-purchase_price="15000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="34.00 Quantity in Stock">Qty: 34.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1566111847_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_15">Rolex
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 16,500.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_16" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Rado Watch">
	          <div class="box box-default item_box" id="div_17" onclick="addrow(17)" data-item-id="17" data-item-name="Rado Watch" data-item-available-qty="53.00" data-item-sales-price="20768.00" data-item-cost="16000.00" data-item-tax-id="6" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="Tax 18%" data-item-tax-amt="1760.00" data-purchase_price="16000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="53.00 Quantity in Stock">Qty: 53.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1566111944_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_16">Rado Watch
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 20,768.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_17" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Mysore Sandal Soap">
	          <div class="box box-default item_box" id="div_18" onclick="addrow(18)" data-item-id="18" data-item-name="Mysore Sandal Soap" data-item-available-qty="34.00" data-item-sales-price="132.00" data-item-cost="120.00" data-item-tax-id="4" data-item-tax-type="Inclusive" data-item-tax-value="5.00" data-item-tax-name="Vat 5%" data-item-tax-amt="12.57" data-purchase_price="120.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="34.00 Quantity in Stock">Qty: 34.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/theme/images/no_image.png" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_17">Mysore Sandal Soap
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 132.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_18" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Lifebuoy">
	          <div class="box box-default item_box" id="div_19" onclick="addrow(19)" data-item-id="19" data-item-name="Lifebuoy" data-item-available-qty="45.00" data-item-sales-price="55.00" data-item-cost="50.00" data-item-tax-id="4" data-item-tax-type="Inclusive" data-item-tax-value="5.00" data-item-tax-name="Vat 5%" data-item-tax-amt="5.24" data-purchase_price="50.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="45.00 Quantity in Stock">Qty: 45.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1566112161_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_18">Lifebuoy
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 55.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_19" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Redmi Pro 7 Mobile">
	          <div class="box box-default item_box" id="div_20" onclick="addrow(20)" data-item-id="20" data-item-name="Redmi Pro 7 Mobile" data-item-available-qty="20.00" data-item-sales-price="11000.00" data-item-cost="10000.00" data-item-tax-id="12" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="GST 18%" data-item-tax-amt="932.20" data-purchase_price="10000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="20.00 Quantity in Stock">Qty: 20.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1572508347_thumb.jpeg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_19">Redmi Pro 7 Mobile
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 11,000.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_20" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="iPhone 11">
	          <div class="box box-default item_box" id="div_21" onclick="addrow(21)" data-item-id="21" data-item-name="iPhone 11" data-item-available-qty="9.00" data-item-sales-price="115500.00" data-item-cost="105000.00" data-item-tax-id="12" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="GST 18%" data-item-tax-amt="9788.14" data-purchase_price="105000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="9.00 Quantity in Stock">Qty: 9.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1572508454_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_20">iPhone 11
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 115,500.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_21" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="Apple Earpods">
	          <div class="box box-default item_box" id="div_22" onclick="addrow(22)" data-item-id="22" data-item-name="Apple Earpods" data-item-available-qty="18.00" data-item-sales-price="13200.00" data-item-cost="12000.00" data-item-tax-id="12" data-item-tax-type="Inclusive" data-item-tax-value="18.00" data-item-tax-name="GST 18%" data-item-tax-amt="1118.64" data-purchase_price="12000.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="18.00 Quantity in Stock">Qty: 18.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/uploads/items/1572508505_thumb.jpg" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_21">Apple Earpods
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 13,200.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_22" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="sdfadfawdfsdf">
	          <div class="box box-default item_box" id="div_23" onclick="addrow(23)" data-item-id="23" data-item-name="sdfadfawdfsdf" data-item-available-qty="7.00" data-item-sales-price="119.00" data-item-cost="118.00" data-item-tax-id="12" data-item-tax-type="Exclusive" data-item-tax-value="18.00" data-item-tax-name="GST 18%" data-item-tax-amt="21.42" data-purchase_price="118.00" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="7.00 Quantity in Stock">Qty: 7.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/theme/images/no_image.png" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_22">sdfadfawdfsdf
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 119.00
	              </span>
	            </lable></div>
	          </div>
	        </div>
	        <div class="col-md-3 col-xs-4 " id="item_parent_23" disabled="disabled" data-toggle="tooltip" title="" style="padding-left:5px;padding-right:5px;" data-original-title="καμερα">
	          <div class="box box-default item_box" id="div_24" onclick="addrow(24)" data-item-id="24" data-item-name="καμερα" data-item-available-qty="8.00" data-item-sales-price="10.00" data-item-cost="11.80" data-item-tax-id="12" data-item-tax-type="Exclusive" data-item-tax-value="18.00" data-item-tax-name="GST 18%" data-item-tax-amt="1.80" data-purchase_price="11.80" data-discount_type="Percentage" data-discount="0.00" style="max-height: 150px;min-height: 150px;cursor: pointer;background-color:#a1db75">
	           	<span class="label label-danger push-right" style="font-weight: bold;font-family: sans-serif;" data-toggle="tooltip" title="" data-original-title="8.00 Quantity in Stock">Qty: 8.00</span>
	            <div class="box-body box-profile">
	            	<center>
	            	<img class=" img-responsive item_image" style="border: 1px solid gray;" src="https://pos.creatantech.com/theme/images/no_image.png" alt="Item picture">
	              </center>
	              <lable class="text-center search_item" style="font-weight: bold;font-family: sans-serif;" id="item_23">καμερα
	              <span class="" style="font-family: sans-serif;font-size:150%; "> 10.00
	              </span>
	            </lable></div>
	          </div>
	        </div><input type="hidden" class="last_id" id="24"></div>
        </section>
        <!-- <div class="ajax-load text-center" style="display: none;">
          <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
            <i class="fa fa-spin fa-refresh"></i>&nbsp; Loading More Data
          </button>
        </div> -->
      </div>
    </div>
  </div>
            <!-- /.box-body -->

            
         
        </div>
        <!-- /.box -->
        
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>