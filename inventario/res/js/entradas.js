var manageOrderTable;

$(document).ready(function () {
  var divRequest = $(".div-request").text();
  $("#navOrder").addClass("active");
  if (divRequest == "add") {
    $("#topNavAddOrder").addClass("active");
    $("#orderDate").datepicker();
    $("#createOrderForm")
      .unbind("submit")
      .bind("submit", function () {
        var form = $(this);

        $(".form-group").removeClass("has-error").removeClass("has-success");
        $(".text-danger").remove();

        var orderDate = $("#orderDate").val();
        var clientName = $("#clientName").val();
        var clientContact = $("#clientContact").val();
        var paid = $("#paid").val();
        var discount = $("#discount").val();
        var paymentType = $("#paymentType").val();
        var paymentStatus = $("#paymentStatus").val();

        // form validation
        if (orderDate == "") {
          $("#orderDate").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#orderDate").closest(".form-group").addClass("has-error");
        } else {
          $("#orderDate").closest(".form-group").addClass("has-success");
        } // /else

        if (clientName == "") {
          $("#clientName").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#clientName").closest(".form-group").addClass("has-error");
        } else {
          $("#clientName").closest(".form-group").addClass("has-success");
        } // /else

        if (clientContact == "") {
          $("#clientContact").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#clientContact").closest(".form-group").addClass("has-error");
        } else {
          $("#clientContact").closest(".form-group").addClass("has-success");
        } // /else

        if (paid == "") {
          $("#paid").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#paid").closest(".form-group").addClass("has-error");
        } else {
          $("#paid").closest(".form-group").addClass("has-success");
        } // /else

        if (discount == "") {
          $("#discount").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#discount").closest(".form-group").addClass("has-error");
        } else {
          $("#discount").closest(".form-group").addClass("has-success");
        } // /else

        if (paymentType == "") {
          $("#paymentType").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#paymentType").closest(".form-group").addClass("has-error");
        } else {
          $("#paymentType").closest(".form-group").addClass("has-success");
        } // /else

        if (paymentStatus == "") {
          $("#paymentStatus").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#paymentStatus").closest(".form-group").addClass("has-error");
        } else {
          $("#paymentStatus").closest(".form-group").addClass("has-success");
        } // /else

        // array validation
        var productName = document.getElementsByName("productName[]");
        var validateProduct;
        for (var x = 0; x < productName.length; x++) {
          var productNameId = productName[x].id;
          if (productName[x].value == "") {
            $("#" + productNameId + "").after(
              '<p class="text-danger"> Este campo es obligatorio </p>'
            );
            $("#" + productNameId + "")
              .closest(".form-group")
              .addClass("has-error");
          } else {
            $("#" + productNameId + "")
              .closest(".form-group")
              .addClass("has-success");
          }
        } // for

        for (var x = 0; x < productName.length; x++) {
          if (productName[x].value) {
            validateProduct = true;
          } else {
            validateProduct = false;
          }
        } // for

        var quantity = document.getElementsByName("quantity[]");
        var validateQuantity;
        for (var x = 0; x < quantity.length; x++) {
          var quantityId = quantity[x].id;
          if (quantity[x].value == "") {
            $("#" + quantityId + "").after(
              '<p class="text-danger"> Este campo es obligatorio </p>'
            );
            $("#" + quantityId + "")
              .closest(".form-group")
              .addClass("has-error");
          } else {
            $("#" + quantityId + "")
              .closest(".form-group")
              .addClass("has-success");
          }
        } // for

        for (var x = 0; x < quantity.length; x++) {
          if (quantity[x].value) {
            validateQuantity = true;
          } else {
            validateQuantity = false;
          }
        } // for

        if (
          orderDate &&
          clientName &&
          clientContact &&
          paid &&
          discount &&
          paymentType &&
          paymentStatus
        ) {
          if (validateProduct == true && validateQuantity == true) {
            // create order button
            // $("#createOrderBtn").button('loading');

            $.ajax({
              url: form.attr("action"),
              type: form.attr("method"),
              data: form.serialize(),
              dataType: "json",
              success: function (response) {
                console.log(response);
                // reset button
                $("#createOrderBtn").button("reset");

                $(".text-danger").remove();
                $(".form-group")
                  .removeClass("has-error")
                  .removeClass("has-success");

                if (response.success == true) {
                  // create order button
                  $(".success-messages").html(
                    '<div class="alert alert-success">' +
                      '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                      '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' +
                      response.messages +
                      ' <br /> <br /> <a type="button" onclick="printOrder(' +
                      response.order_id +
                      ')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Imprimier </a>' +
                      '<a href="orders.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar nueva orden </a>' +
                      "</div>"
                  );

                  $("html, body, div.panel, div.pane-body").animate(
                    { scrollTop: "0px" },
                    100
                  );

                  // disabled te modal footer button
                  $(".submitButtonFooter").addClass("div-hide");
                  // remove the product row
                  $(".removeProductRowBtn").addClass("div-hide");
                } else {
                  alert(response.messages);
                }
              }, // /response
            }); // /ajax
          } // if array validate is true
        } // /if field validate is true

        return false;
      }); // /create order form function
  } else if (divRequest == "manord") {
    // top nav child bar
    manageOrderTable = $("#manageOrderTable").DataTable({
      ajax: "../code/code_fetchorder.php",
      order: [],
    });
  } else if (divRequest == "editOrd") {
    $("#orderDate").datepicker();

    // edit order form function
    $("#editOrderForm")
      .unbind("submit")
      .bind("submit", function () {
        // alert('ok');
        var form = $(this);

        $(".form-group").removeClass("has-error").removeClass("has-success");
        $(".text-danger").remove();

        var orderDate = $("#orderDate").val();
        var clientName = $("#clientName").val();
        var clientContact = $("#clientContact").val();
        var paid = $("#paid").val();
        var discount = $("#discount").val();
        var paymentType = $("#paymentType").val();
        var paymentStatus = $("#paymentStatus").val();

        // form validation
        if (orderDate == "") {
          $("#orderDate").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#orderDate").closest(".form-group").addClass("has-error");
        } else {
          $("#orderDate").closest(".form-group").addClass("has-success");
        } // /else

        if (clientName == "") {
          $("#clientName").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#clientName").closest(".form-group").addClass("has-error");
        } else {
          $("#clientName").closest(".form-group").addClass("has-success");
        } // /else

        if (clientContact == "") {
          $("#clientContact").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#clientContact").closest(".form-group").addClass("has-error");
        } else {
          $("#clientContact").closest(".form-group").addClass("has-success");
        } // /else

        if (paid == "") {
          $("#paid").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#paid").closest(".form-group").addClass("has-error");
        } else {
          $("#paid").closest(".form-group").addClass("has-success");
        } // /else

        if (discount == "") {
          $("#discount").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#discount").closest(".form-group").addClass("has-error");
        } else {
          $("#discount").closest(".form-group").addClass("has-success");
        } // /else

        if (paymentType == "") {
          $("#paymentType").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#paymentType").closest(".form-group").addClass("has-error");
        } else {
          $("#paymentType").closest(".form-group").addClass("has-success");
        } // /else

        if (paymentStatus == "") {
          $("#paymentStatus").after(
            '<p class="text-danger"> Este campo es obligatorio </p>'
          );
          $("#paymentStatus").closest(".form-group").addClass("has-error");
        } else {
          $("#paymentStatus").closest(".form-group").addClass("has-success");
        } // /else

        // array validation
        var productName = document.getElementsByName("productName[]");
        var validateProduct;
        for (var x = 0; x < productName.length; x++) {
          var productNameId = productName[x].id;
          if (productName[x].value == "") {
            $("#" + productNameId + "").after(
              '<p class="text-danger"> Este campo es obligatorio </p>'
            );
            $("#" + productNameId + "")
              .closest(".form-group")
              .addClass("has-error");
          } else {
            $("#" + productNameId + "")
              .closest(".form-group")
              .addClass("has-success");
          }
        } // for

        for (var x = 0; x < productName.length; x++) {
          if (productName[x].value) {
            validateProduct = true;
          } else {
            validateProduct = false;
          }
        } // for

        var quantity = document.getElementsByName("quantity[]");
        var validateQuantity;
        for (var x = 0; x < quantity.length; x++) {
          var quantityId = quantity[x].id;
          if (quantity[x].value == "") {
            $("#" + quantityId + "").after(
              '<p class="text-danger"> Este campo es obligatorio </p>'
            );
            $("#" + quantityId + "")
              .closest(".form-group")
              .addClass("has-error");
          } else {
            $("#" + quantityId + "")
              .closest(".form-group")
              .addClass("has-success");
          }
        } // for

        for (var x = 0; x < quantity.length; x++) {
          if (quantity[x].value) {
            validateQuantity = true;
          } else {
            validateQuantity = false;
          }
        } // for

        if (
          orderDate &&
          clientName &&
          clientContact &&
          paid &&
          discount &&
          paymentType &&
          paymentStatus
        ) {
          if (validateProduct == true && validateQuantity == true) {
            // create order button
            // $("#createOrderBtn").button('loading');

            $.ajax({
              url: form.attr("action"),
              type: form.attr("method"),
              data: form.serialize(),
              dataType: "json",
              success: function (response) {
                console.log(response);
                // reset button
                $("#editOrderBtn").button("reset");

                $(".text-danger").remove();
                $(".form-group")
                  .removeClass("has-error")
                  .removeClass("has-success");

                if (response.success == true) {
                  // create order button
                  $(".success-messages").html(
                    '<div class="alert alert-success">' +
                      '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                      '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' +
                      response.messages +
                      "</div>"
                  );

                  $("html, body, div.panel, div.pane-body").animate(
                    { scrollTop: "0px" },
                    100
                  );

                  // disabled te modal footer button
                  $(".editButtonFooter").addClass("div-hide");
                  // remove the product row
                  $(".removeProductRowBtn").addClass("div-hide");
                } else {
                  alert(response.messages);
                }
              }, // /response
            }); // /ajax
          } // if array validate is true
        } // /if field validate is true

        return false;
      }); // /edit order form function
  }
}); // /documernt

// print order function
function printOrder(orderId = null) {
  if (orderId) {
    $.ajax({
      url: "php_action/printOrder.php",
      type: "post",
      data: { orderId: orderId },
      dataType: "text",
      success: function (response) {
        var mywindow = window.open(
          "",
          "Stock Management System",
          "height=400,width=600"
        );
        mywindow.document.write("<html><head><title>Order Invoice</title>");
        mywindow.document.write("</head><body>");
        mywindow.document.write(response);
        mywindow.document.write("</body></html>");

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();
      }, // /success function
    }); // /ajax function to fetch the printable order
  } // /if orderId
} // /print order function

function addRow() {
  $("#addRowBtn").button("loading");

  var tableLength = $("#productTable tbody tr").length;
  var tableRow;
  var arrayNumber;
  var count;

  if (tableLength > 0) {
    tableRow = $("#productTable tbody tr:last").attr("id");
    arrayNumber = $("#productTable tbody tr:last").attr("class");
    count = tableRow.substring(3);
    count = Number(count) + 1;
    arrayNumber = Number(arrayNumber) + 1;
  } else {
    // no table row
    count = 1;
    arrayNumber = 0;
  }

  $.ajax({
    url: "php_action/fetchProductData.php",
    type: "post",
    dataType: "json",
    success: function (response) {
      $("#addRowBtn").button("reset");

      var tr =
        '<tr id="row' +
        count +
        '" class="' +
        arrayNumber +
        '">' +
        "<td>" +
        '<div class="form-group">' +
        '<select class="form-control" name="productName[]" id="productName' +
        count +
        '" onchange="getProductData(' +
        count +
        ')" >' +
        '<option value="">~~SELECT~~</option>';
      // console.log(response);
      $.each(response, function (index, value) {
        tr += '<option value="' + value[0] + '">' + value[1] + "</option>";
      });

      tr +=
        "</select>" +
        "</div>" +
        "</td>" +
        '<td style="padding-left:20px;"">' +
        '<input type="text" name="rate[]" id="rate' +
        count +
        '" autocomplete="off" disabled="true" class="form-control" />' +
        '<input type="hidden" name="rateValue[]" id="rateValue' +
        count +
        '" autocomplete="off" class="form-control" />' +
        '</td style="padding-left:20px;">' +
        '<td style="padding-left:20px;">' +
        '<div class="form-group">' +
        '<input type="number" name="quantity[]" id="quantity' +
        count +
        '" onkeyup="getTotal(' +
        count +
        ')" autocomplete="off" class="form-control" min="1" />' +
        "</div>" +
        "</td>" +
        '<td style="padding-left:20px;">' +
        '<input type="text" name="total[]" id="total' +
        count +
        '" autocomplete="off" class="form-control" disabled="true" />' +
        '<input type="hidden" name="totalValue[]" id="totalValue' +
        count +
        '" autocomplete="off" class="form-control" />' +
        "</td>" +
        "<td>" +
        '<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow(' +
        count +
        ')"><i class="glyphicon glyphicon-trash"></i></button>' +
        "</td>" +
        "</tr>";
      if (tableLength > 0) {
        $("#productTable tbody tr:last").after(tr);
      } else {
        $("#productTable tbody").append(tr);
      }
    }, // /success
  }); // get the product data
} // /add row

function removeProductRow(row = null) {
  if (row) {
    $("#row" + row).remove();
    subAmount();
  } else {
    alert("error! Refresh the page again");
  }
}

// select on product data
function getProductData(row = null) {
  if (row) {
    var productId = $("#productName" + row).val();

    if (productId == "") {
      $("#rate" + row).val("");

      $("#quantity" + row).val("");
      $("#total" + row).val("");

      // remove check if product name is selected
      // var tableProductLength = $("#productTable tbody tr").length;
      // for(x = 0; x < tableProductLength; x++) {
      // 	var tr = $("#productTable tbody tr")[x];
      // 	var count = $(tr).attr('id');
      // 	count = count.substring(3);

      // 	var productValue = $("#productName"+row).val()

      // 	if($("#productName"+count).val() == "") {
      // 		$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');
      // 		console.log("#changeProduct"+count);
      // 	}
      // } // /for
    } else {
      $.ajax({
        url: "php_action/fetchSelectedProduct.php",
        type: "post",
        data: { productId: productId },
        dataType: "json",
        success: function (response) {
          // setting the rate value into the rate input field

          $("#rate" + row).val(response.rate);
          $("#rateValue" + row).val(response.rate);

          $("#quantity" + row).val(1);

          var total = Number(response.rate) * 1;
          total = total.toFixed(2);
          $("#total" + row).val(total);
          $("#totalValue" + row).val(total);

          // check if product name is selected
          // var tableProductLength = $("#productTable tbody tr").length;
          // for(x = 0; x < tableProductLength; x++) {
          // 	var tr = $("#productTable tbody tr")[x];
          // 	var count = $(tr).attr('id');
          // 	count = count.substring(3);

          // 	var productValue = $("#productName"+row).val()

          // 	if($("#productName"+count).val() != productValue) {
          // 		// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');
          // 		$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');
          // 		console.log("#changeProduct"+count);
          // 	}
          // } // /for

          subAmount();
        }, // /success
      }); // /ajax function to fetch the product data
    }
  } else {
    alert("no row! please refresh the page");
  }
} // /select on product data

// table total
function getTotal(row = null) {
  if (row) {
    var total =
      Number($("#rate" + row).val()) * Number($("#quantity" + row).val());
    total = total.toFixed(2);
    $("#total" + row).val(total);
    $("#totalValue" + row).val(total);

    subAmount();
  } else {
    alert("no row !! please refresh the page");
  }
}

function subAmount() {
  var tableProductLength = $("#productTable tbody tr").length;
  var totalSubAmount = 0;
  for (x = 0; x < tableProductLength; x++) {
    var tr = $("#productTable tbody tr")[x];
    var count = $(tr).attr("id");
    count = count.substring(3);

    totalSubAmount = Number(totalSubAmount) + Number($("#total" + count).val());
  } // /for

  totalSubAmount = totalSubAmount.toFixed(2);

  // sub total
  $("#subTotal").val(totalSubAmount);
  $("#subTotalValue").val(totalSubAmount);

  // vat
  var vat = (Number($("#subTotal").val()) / 100) * 13;
  vat = vat.toFixed(2);
  $("#vat").val(vat);
  $("#vatValue").val(vat);

  // total amount
  var totalAmount = Number($("#subTotal").val()) + Number($("#vat").val());
  totalAmount = totalAmount.toFixed(2);
  $("#totalAmount").val(totalAmount);
  $("#totalAmountValue").val(totalAmount);

  var discount = $("#discount").val();
  if (discount) {
    var grandTotal = Number($("#totalAmount").val()) - Number(discount);
    grandTotal = grandTotal.toFixed(2);
    $("#grandTotal").val(grandTotal);
    $("#grandTotalValue").val(grandTotal);
  } else {
    $("#grandTotal").val(totalAmount);
    $("#grandTotalValue").val(totalAmount);
  } // /else discount

  var paidAmount = $("#paid").val();
  if (paidAmount) {
    paidAmount = Number($("#grandTotal").val()) - Number(paidAmount);
    paidAmount = paidAmount.toFixed(2);
    $("#due").val(paidAmount);
    $("#dueValue").val(paidAmount);
  } else {
    $("#due").val($("#grandTotal").val());
    $("#dueValue").val($("#grandTotal").val());
  } // else
} // /sub total amount

function discountFunc() {
  var discount = $("#discount").val();
  var totalAmount = Number($("#totalAmount").val());
  totalAmount = totalAmount.toFixed(2);

  var grandTotal;
  if (totalAmount) {
    grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
    grandTotal = grandTotal.toFixed(2);

    $("#grandTotal").val(grandTotal);
    $("#grandTotalValue").val(grandTotal);
  } else {
  }

  var paid = $("#paid").val();

  var dueAmount;
  if (paid) {
    dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
    dueAmount = dueAmount.toFixed(2);

    $("#due").val(dueAmount);
    $("#dueValue").val(dueAmount);
  } else {
    $("#due").val($("#grandTotal").val());
    $("#dueValue").val($("#grandTotal").val());
  }
} // /discount function

function paidAmount() {
  var grandTotal = $("#grandTotal").val();

  if (grandTotal) {
    var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
    dueAmount = dueAmount.toFixed(2);
    $("#due").val(dueAmount);
    $("#dueValue").val(dueAmount);
  } // /if
} // /paid amoutn function

function resetOrderForm() {
  // reset the input field
  $("#createOrderForm")[0].reset();
  // remove remove text danger
  $(".text-danger").remove();
  // remove form group error
  $(".form-group").removeClass("has-success").removeClass("has-error");
} // /reset order form

// remove order from server
function removeOrder(orderId = null) {
  if (orderId) {
    $("#removeOrderBtn")
      .unbind("click")
      .bind("click", function () {
        $("#removeOrderBtn").button("loading");

        $.ajax({
          url: "php_action/removeOrder.php",
          type: "post",
          data: { orderId: orderId },
          dataType: "json",
          success: function (response) {
            $("#removeOrderBtn").button("reset");

            if (response.success == true) {
              manageOrderTable.ajax.reload(null, false);
              // hide modal
              $("#removeOrderModal").modal("hide");
              // success messages
              $("#success-messages").html(
                '<div class="alert alert-success">' +
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                  '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' +
                  response.messages +
                  "</div>"
              );

              // remove the mesages
              $(".alert-success")
                .delay(500)
                .show(10, function () {
                  $(this)
                    .delay(3000)
                    .hide(10, function () {
                      $(this).remove();
                    });
                }); // /.alert
            } else {
              // error messages
              $(".removeOrderMessages").html(
                '<div class="alert alert-warning">' +
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                  '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' +
                  response.messages +
                  "</div>"
              );

              // remove the mesages
              $(".alert-success")
                .delay(500)
                .show(10, function () {
                  $(this)
                    .delay(3000)
                    .hide(10, function () {
                      $(this).remove();
                    });
                }); // /.alert
            } // /else
          }, // /success
        }); // /ajax function to remove the order
      }); // /remove order button clicked
  } else {
    alert("error! refresh the page again");
  }
}
// /remove order from server

// Payment ORDER
function paymentOrder(orderId = null) {
  if (orderId) {
    $("#orderDate").datepicker();

    $.ajax({
      url: "../code/fetchorderData.php",
      type: "post",
      data: { orderId: orderId },
      dataType: "json",
      success: function (response) {
        // due
        $("#due").val(response.order[10]);

        // pay amount
        $("#payAmount").val(response.order[10]);

        var paidAmount = response.order[9];
        var dueAmount = response.order[10];
        var grandTotal = response.order[8];

        // update payment
        $("#updatePaymentOrderBtn")
          .unbind("click")
          .bind("click", function () {
            var payAmount = $("#payAmount").val();
            var paymentType = $("#paymentType").val();
            var paymentStatus = $("#paymentStatus").val();

            if (payAmount == "") {
              $("#payAmount").after(
                '<p class="text-danger">Este campo es obligatorio</p>'
              );
              $("#payAmount").closest(".form-group").addClass("has-error");
            } else {
              $("#payAmount").closest(".form-group").addClass("has-success");
            }

            if (paymentType == "") {
              $("#paymentType").after(
                '<p class="text-danger">Este campo es obligatorio</p>'
              );
              $("#paymentType").closest(".form-group").addClass("has-error");
            } else {
              $("#paymentType").closest(".form-group").addClass("has-success");
            }

            if (paymentStatus == "") {
              $("#paymentStatus").after(
                '<p class="text-danger">Este campo es obligatorio</p>'
              );
              $("#paymentStatus").closest(".form-group").addClass("has-error");
            } else {
              $("#paymentStatus")
                .closest(".form-group")
                .addClass("has-success");
            }

            if (payAmount && paymentType && paymentStatus) {
              $("#updatePaymentOrderBtn").button("loading");
              $.ajax({
                url: "php_action/editPayment.php",
                type: "post",
                data: {
                  orderId: orderId,
                  payAmount: payAmount,
                  paymentType: paymentType,
                  paymentStatus: paymentStatus,
                  paidAmount: paidAmount,
                  grandTotal: grandTotal,
                },
                dataType: "json",
                success: function (response) {
                  $("#updatePaymentOrderBtn").button("loading");

                  // remove error
                  $(".text-danger").remove();
                  $(".form-group")
                    .removeClass("has-error")
                    .removeClass("has-success");

                  $("#paymentOrderModal").modal("hide");

                  $("#success-messages").html(
                    '<div class="alert alert-success">' +
                      '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                      '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' +
                      response.messages +
                      "</div>"
                  );

                  // remove the mesages
                  $(".alert-success")
                    .delay(500)
                    .show(10, function () {
                      $(this)
                        .delay(3000)
                        .hide(10, function () {
                          $(this).remove();
                        });
                    }); // /.alert

                  // refresh the manage order table
                  manageOrderTable.ajax.reload(null, false);
                }, //
              });
            } // /if

            return false;
          }); // /update payment
      }, // /success
    }); // fetch order data
  } else {
    alert("Error ! Refresh the page again");
  }
}

function lista_entradas() {
  var codigo = $("#mov_entradas").val();
  var parametros = { almacen: codigo };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/code_lista_entradas.php",
    type: "post",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader2").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $(".almacen").html(data).fadeIn("slow");
      $("#nuevo_mov").attr("disabled", false);
      $("#loader2").html("");
    },
  });
}

function pone_almacen(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_almacen_movimientos.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $(".entradas").html(data).fadeIn("slow");
      $("#loader").html("");
      $("#nuevo_mov").attr("disabled", true);
    },
  });
}

$("#ModalDetalleMovimiento").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var numero = button.data("numero"); // Extraer la información de atributos de datos
  var almacen = button.data("almacen"); // Extraer la información de atributos de datos
  var tipomov = button.data("tipmov"); // Extraer la información de atributos de datos
  var tipo = button.data("tipo"); // Extraer la información de atributos de datos
  var action = "ajax";
  var modal = $(this);
  modal.find(".modal-title").text("Detalle Movimiento Numero: " + numero);
  $(".alert").hide(); //Oculto alert
  $("#cargador").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "../code/code_cargar_movimientos.php",
    data:
      "bodega=" +
      almacen +
      "&numero=" +
      numero +
      "&action=" +
      action +
      "&tipo=" +
      tipo +
      "&tipomov=" +
      tipomov,
    beforeSend: function (objeto) {
      $("#cargador").html('<img src="../../img/loader.gif"> Cargando ...');
    },
    success: function (data) {
      $(".outer_div1").html(data).fadeIn("slow");
      $("#cargador").html("");
    },
  });
});

$("#ModalAnulaMovimiento").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var numero = button.data("numero"); // Extraer la información de atributos de datos
  var almacen = button.data("almacen"); // Extraer la información de atributos de datos
  var tipomov = button.data("tipmov"); // Extraer la información de atributos de datos
  var tipo = button.data("tipo"); // Extraer la información de atributos de datos
  var modal = $(this);

  modal.find("#numero").val(numero);
  modal.find("#almacen").val(almacen);
  modal.find("#tipo").val(tipo);
  modal.find("#tipomov").val(tipomov);
});

$("#AnulaDatosMovimiento").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../code/code_anula_movimiento.php",
    data: parametros,
    beforeSend: function (objeto) {
      $(".datos_ajax_delete").html("Anulando Movimiento ...");
    },
    success: function (datos) {
      $(".datos_ajax_delete").html(datos);
      $("#ModalAnulaMovimiento").modal("hide");
      lista_entradas();
    },
  });
  event.preventDefault();
});

function pone_tipo_movimiento(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_tipo_movimiento.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_tipo_movi").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function pone_proveedor(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_proveedor.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_proveedor").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function pone_producto(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_producto.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_producto").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function pone_impuesto(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_impuesto.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_impuesto").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function pone_unidad(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_unidad.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_unidad").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function busca_producto(codigo) {
  $.ajax({
    beforeSend: function () {},
    url: "../code/busca_productos.php",
    type: "POST",
    dataType: "json",
    data: "codigo=" + $("#producto").val(),
    success: function (x) {
      $("#codigo").val(x.cod_prod);
      $("#costo").val(x.pco_prod);
      $("#unidad").val(x.uco_prod);
      $("#descripcion").val(x.nom_prod);
      $("#cantidad").val(0);
      $("#costo").attr("disabled", false);
      $("#cantidad").attr("disabled", false);
      $("#costo").select();
      $("#costo").focus();
    },
  });
  /* $(document).ready(function(){
    }) */
}

function activa_botones_mov() {
  $("#btn-add-article").attr("disabled", false);
  $("#btn-cancel-article").attr("disabled", false);
}

function pone_por_impto() {
  var imp = $("#impuesto").val();
  $.ajax({
    beforeSend: function () {},
    url: "../code/busca_porc_impto.php",
    type: "POST",
    dataType: "json",
    data: "codigo=" + $("#impuesto").val(),
    success: function (x) {
      if ("x" == 0) {
        $("#porc_impto").val(0);
      } else {
        $("#porc_impto").val(x.mpo_impu);
      }
    },
  });
  /* $(document).ready(function(){
	  }) */
}

function cancela_add() {
  $("#tipo_movi").attr("disabled", true);
  $("#proveedor").attr("disabled", true);
  $("#fecha").attr("disabled", true);
  $("#factura").attr("disabled", true);
  $("#codigo").val("");
  $("#descripcion").val("");
  $("#producto").val("");
  $("#porc_impto").val("");
  $("#impuesto").val("");
  $("#unidad").val("");
  $("#costo").val(0);
  $("#cantidad").val(0);
  $("#costo").attr("disabled", true);
  $("#cantidad").attr("disabled", true);
  $("#btn-add-article").attr("disabled", true);
  $("#btn-cancel-article").attr("disabled", true);
  $("#producto").focus();
}

function resumen() {
  var total = 0.0;
  var sutot = 0.0;
  var impue = 0.0;
  var produ = 0.0;
  $("#tabla_articulos > tbody > tr").each(function () {
    var impto = parseFloat($(this).find("td").eq(5).html());
    var total = parseFloat($(this).find("td").eq(6).html());
    ar += parseFloat($(this).find("td").eq(3).html());
    totales = totales + total;
    imptos = imptos + impto;
    //de = de+descs;
    //t=t+(montoss-descs);
  });
  alert(totales);
  alert(imptos);
  $("#net").val("$ " + totales.toFixed(2));
  $("#imp").val("$ " + imptos.toFixed(2));
  //var im=$("#impuesto").val();
  //var impuesto_moneda=t*(im/100);
  //$("#tot").val("$ "+(t+impuesto_moneda).toFixed(2));
  $("#arts").val(ar.toFixed(2));
  if (total > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  }
}

function actualiza_entrada_temp(codigo) {
  var art = codigo;
  $.ajax({
    beforeSend: function () {},
    url: "update_articulos_en_tempentrada.php",
    type: "POST",
    data: "articulo=" + art,
    success: function (t) {},
    error: function (jqXHR, estado, error) {},
  });
}
