function calcularDigitoVerificacion(myNit) {
    var vpri,
        x,
        y,
        z;

    // Se limpia el Nit
    myNit = myNit.replace(/\s/g, ""); // Espacios
    myNit = myNit.replace(/,/g, ""); // Comas
    myNit = myNit.replace(/\./g, ""); // Puntos
    myNit = myNit.replace(/-/g, ""); // Guiones

    // Se valida el nit
    if (isNaN(myNit)) {
        console.log("El nit/cÃ©dula '" + myNit + "' no es vÃ¡lido(a).");
        return "";
    };

    // Procedimiento
    vpri = new Array(16);
    z = myNit.length;

    vpri[1] = 3;
    vpri[2] = 7;
    vpri[3] = 13;
    vpri[4] = 17;
    vpri[5] = 19;
    vpri[6] = 23;
    vpri[7] = 29;
    vpri[8] = 37;
    vpri[9] = 41;
    vpri[10] = 43;
    vpri[11] = 47;
    vpri[12] = 53;
    vpri[13] = 59;
    vpri[14] = 67;
    vpri[15] = 71;

    x = 0;
    y = 0;
    for (var i = 0; i < z; i++) {
        y = (myNit.substr(i, 1));
        // console.log ( y + "x" + vpri[z-i] + ":" ) ;

        x += (y * vpri[z - i]);
        // console.log ( x ) ;    
    }

    y = x % 11;
    // console.log ( y ) ;

    return (y > 1) ? 11 - y : y;
}

// Calcular
function calcular(inputNit, outputDv) {

    // Verificar que haya un numero
    let nit = document.getElementById(inputNit).value;
    let isNitValid = nit >>> 0 === parseFloat(nit) ? true : false; // Validate a positive integer

    // Si es un nÃºmero se calcula el DÃ­gito de VerificaciÃ³n
    if (isNitValid) {
        let inputDigVerificacion = document.getElementById(outputDv);
        inputDigVerificacion.value = calcularDigitoVerificacion(nit);
    }
}

//   No Disabled Button Cancel
const NoDesabledButton = () => {
    if (document.querySelector('.swal2-cancel') !== null) {
        document.querySelector('.swal2-cancel').removeAttribute('disabled')
    }
}
const numbers = document.querySelectorAll('.numbers')
numbers.forEach(element => {
    function validarTextoEntrada(input, patron) {
        let texto = input.value
        let letras = texto.split("")
        for (let x in letras) {
            let letra = letras[x]
            if (!(new RegExp(patron, "i")).test(letra)) {
                letras[x] = ""
            }
        }
        input.value = letras.join("")
    }
    element.addEventListener("input", function (event) {
        validarTextoEntrada(this, "[0-9]")
    })
});
const ShowPassword = () => {
    let i = document.querySelectorAll('.password');
    for (let a = 0; a < i.length; a++) {
        if (i[a].type == "password") {
            i[a].type = "text";
        } else {
            i[a].type = "password";
        }
    }
}
const LoadRowDatatable = (element, table, showmodals = true) => {
    const button = document.getElementById(element)
    let datatable = $('#' + table).DataTable({
        scrollY: "350px",
        scrollX: true,
        paging: true,
        processing: false,
        searching: true,
        bDestroy: true,
        sortable: false,
        // dom: "<'row'<'col-md-6'B><'col-md-6'f>>t<'row'<'col-md-6 mt-2 text-center'i><'col-md-6 text-center'p>>",       
        "drawCallback": function (settings) {
            $('ul.pagination').addClass("pagination-sm");
        },
        "language": {
            "url": `../leng/Spanish.json`
        }
    })
    let row = datatable.data().toArray().filter((data) => data)
    if (button.dataset.modal !== null && showmodals === true) {
        $('#' + button.dataset.modal).modal('show');
    }
    return row;
}
const ValidateXML = async (element) => {
    const file = document.getElementById(element)
    const FileName = file.files[0].name
    var allowedExtensions = /(.xml)$/i;
    if (!allowedExtensions.exec(file.value)) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: `El archivo seleccionado no es un XML, intente nuevamente!`
        })
        return;
    }
    return true;
}
const CleanerInputs = () => {
    const Inputs = document.querySelectorAll('.cleaner-input');
    if (Inputs.length > 0) {
        Inputs.forEach(element => {
            element.value = null
        });
    }
}
const click = (element) => {
    const button = document.getElementById(element)
    button.click()
}
const GetFilesToBase64 = async (InputFile) => {
    const Type = InputFile
    InputFile = document.querySelector('#' + InputFile)
    const FileName = InputFile.files[0].name
    var allowedExtensions = /(.pdf)$/i;
    if (!allowedExtensions.exec(InputFile.value)) {
        return Notifications(null, 'Solo se admiten archivos del tipo PDF', 'error', true,
            'Seleccione un documento valido!',
            false,
            false)
    }
    const base64FileAnnexess = await toBase64(InputFile.files[0])
    const map = {
        'base64_document': 'DI_',
        'base64_rut': 'RUT_',
        'base64_camara': 'CAMARA_',
        'base64_payment': 'PAYMENT_',
        'base64_document_file': 'DI_',
        'base64_rut_file': 'RUT_',
        'base64_camara_file': 'CAMARA_',
        'base64_payment_file': 'PAYMENT_',
    }
    if (Annexes.length > 0) {
        Annexes.forEach((element, index) => {
            if (element['name'] == map[Type]) {
                Annexes.splice(index, 1)
            }
        });
    }
    Annexes.push({
        'document': (base64FileAnnexess).slice(28),
        'name': map[Type],
        'extension': 'pdf',
    })
    console.log({
        Annexes
    })
}
const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve((reader.result));
    reader.onerror = error => reject(`No fue posible procesar el archivo: ${error}`);
});

const ValidateFormat = (file, format) => {
    const element = document.getElementById(file)
    let allowedExtensions;
    if (format == 'xls' || format == 'xlsx') {
        allowedExtensions = /(.xlsx|.xls)$/i;
    } else if (format == 'zip') {
        allowedExtensions = /(.zip)$/i;
    } else if (format == 'xml') {
        allowedExtensions = /(.xml)$/i;
    } else if (format == 'pdf') {
        allowedExtensions = /(.pdf)$/i;
    } else if (format == 'p12' || format == 'pfx') {
        allowedExtensions = /(.p12|.pfx|)$/i;
    }
    // const allowedExtensions = /(.pdf|.xml|.p12|.pfx|.zip|.xlsx|.xls)$/i;
    if (!allowedExtensions.exec(element.value)) {
        element.value = null
        // return ToastR(`El archivo seleccionado no corresponde al tipo ${format}`, 'error')
        return ToastR({ message: `El archivo seleccionado no corresponde al tipo ${format}`, icon: 'error' });
    }
    return true;
}
const Notifications = (element, title, icon = 'info', isHtml, html, IsReload = null, position = 'center',
    Isallback = false, callback) => {
    Swal.fire({
        title: title,
        position: position,
        icon: `${icon}`,
        html: `${html}`,
        showCloseButton: false,
        showCancelButton: false,
        focusConfirm: false,
        cancelButtonAriaLabel: 'Thumbs down'
    }).then(resultado => {
        if (resultado.value) {
            if (IsReload == true) {
                window.location.reload()
            }
        }
    });
}


const MinToast = ({ message, icon, time = 3000, clean = false, title }) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: true,
        timer: time,
        timerProgressBar: true,
        grow: 'row',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimere)
        }
    })
    Toast.fire({
        icon: icon,
        title: title,
        html: message
    })
    if (clean == true) return CleanerInputs()
}

const RequestComponent = async ({ url, method, bodyRequest, headers, typeResponse, noSession = false }) => {
    if (noSession !== true) {
        const csrf = document.querySelector('input[name="_token"]').value;
        const session = await fetch(masterUrl + '/session', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            method: 'post'
        })
        const { id } = await session.json();
        if (id == null || id == undefined) {
            ToastR({ message: 'Â¡Su sesiÃ³n ha vencido. Por favor ingrese nuevamente!', icon: 'error' });
            setTimeout(function () {
                window.location.href = '/';
                return;
            }, 2000);
        }
    }
    if (url == null || method == null || headers == null) ToastR({ message: 'Â¡La informaciÃ³n enviada es invalida! Complete los datos!', icon: 'error' });
    try {
        spinner.removeAttribute('hidden');
        FullOptionsRequest = null
        const optionsRequest = {
            method: method,
            credentials: "same-origin",
            contentType: "application/json; charset=UTF-8",
            headers: headers,
        }
        if (method == 'POST' || method == 'PUT') {
            FullOptionsRequest = Object.assign(optionsRequest, {
                body: bodyRequest
            })
        } else {
            FullOptionsRequest = optionsRequest
        }
        const RequestComponent = await fetch(url, FullOptionsRequest)
        ToastR({ message: 'Procesando, por favor espere..!', icon: 'info' })
        spinner.setAttribute('hidden', '');
        if (RequestComponent.status == 401) return ToastR({ message: 'Â¡El usuario no se encuentra registrado en la API o el Token es incorrecto..!', icon: 'info' });
        // ToastR({ message:' 'Â¡Procesando, por favor espere..!', icon: 'info' });        
        let ResponseComponent = null
        if (typeResponse == 'json') return ResponseComponent = await RequestComponent.json()
        if (typeResponse == 'text') return ResponseComponent = await RequestComponent.text()
        if (typeResponse == 'blob') return ResponseComponent = await RequestComponent.blob()
        return ResponseComponent.json()
    } catch (error) {
        spinner.setAttribute('hidden', '');
        return ToastR({ message: 'Â¡Se ha producido un error en la peticiÃ³n! Intente nuevamente..!', icon: 'info' });
    }
}


const spinner = document.getElementById("spinner");
const Today = new Date();
const TodayFull = Today.getFullYear() + "-" + (Today.getMonth() + 1) + "-" + Today.getDate() + " 00:00"
const TodayFullLast = Today.getFullYear() + "-" + (Today.getMonth() + 1) + "-" + Today.getDate() + " 23:59"
// console.log(TodayFull)
flatpickr(".datetimepicker", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    // maxDate: "month",
    mode: "range",
    defaultDate: [TodayFull, TodayFullLast],
    defaultHour: 00
});

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
const date = new Date();
const year = date.getFullYear();
const month = String(date.getMonth() + 1).padStart(2, '0');
const day = String(date.getDate()).padStart(2, '0');
const formattedDate = `${year}-${month}-${day}`;
const templates = [
    invoice = {
        "number": 990000000,
        "type_document_id": 1,
        "date": `${formattedDate}`,
        "time": "08:30:12",
        "resolution_number": "18760000001",
        "prefix": "SETP",
        "sendmail": false,
        "customer": {
            "identification_number": 901249232,
            "dv": 0,
            "name": "Bercode SAS",
            "phone": "3017882489",
            "address": "CLL 18A # 11 - 20",
            "email": "bercodelorica@gmail.com",
            "merchant_registration": "00000000",
            "type_document_identification_id": 6,
            "type_organization_id": 1,
            "municipality_id": 439,
            "type_regime_id": 1
        },
        "payment_form": {
            "payment_form_id": 2,
            "payment_method_id": 30,
            "payment_due_date": `${formattedDate}`,
            "duration_measure": "0"
        },
        "allowance_charges": [
            {
                "discount_id": 1,
                "charge_indicator": false,
                "allowance_charge_reason": "DESCUENTO GENERAL",
                "amount": "0.00",
                "base_amount": "840336.13"
            }
        ],
        "legal_monetary_totals": {
            "line_extension_amount": "840336.13",
            "tax_exclusive_amount": "840336.13",
            "tax_inclusive_amount": "1000000.00",
            "allowance_total_amount": "0.00",
            "charge_total_amount": "0.00",
            "payable_amount": "1000000.00"
        },
        "tax_totals": [
            {
                "tax_id": 1,
                "tax_amount": "159663.86",
                "percent": "19",
                "taxable_amount": "840336.13"
            }
        ],
        "invoice_lines": [
            {
                "unit_measure_id": 70,
                "invoiced_quantity": "1",
                "line_extension_amount": "840336.13",
                "free_of_charge_indicator": false,
                "allowance_charges": [
                    {
                        "charge_indicator": false,
                        "allowance_charge_reason": "DESCUENTO GENERAL",
                        "amount": "0.00",
                        "base_amount": "1000000.00"
                    }
                ],
                "tax_totals": [
                    {
                        "tax_id": 1,
                        "tax_amount": "159663.86",
                        "taxable_amount": "840336.13",
                        "percent": "19.00"
                    }
                ],
                "description": "COMISION POR SERVICIOS",
                "code": "COMISION",
                "type_item_identification_id": 4,
                "price_amount": "840336.13",
                "base_quantity": "1"
            }
        ]
    },
    nc = {
        "billing_reference": {
            "number": null,
            "uuid": null,
            "issue_date": `${formattedDate}`
        },
        "discrepancyresponsecode": 2,
        "discrepancyresponsedescription": "PRUEBA DE MOTIVO NOTA CREDITO",
        "number": 1,
        "type_document_id": 4,
        "prefix": "NC",
        "date": `${formattedDate}`,
        "time": "14:43:13",
        "customer": {
            "identification_number": 901249232,
            "dv": 0,
            "name": "Bercode SAS",
            "phone": 3106031839,
            "address": "CLL 18A # 11 - 20",
            "email": "bercodelorica@gmail.com",
            "merchant_registration": "00000000",
            "type_document_identification_id": 6,
            "type_organization_id": 1,
            "municipality_id": 439,
            "type_regime_id": 1
        },
        "tax_totals": [
            {
                "tax_id": 1,
                "tax_amount": "0.00",
                "taxable_amount": "0.00",
                "percent": "0.00"
            }
        ],
        "legal_monetary_totals": {
            "line_extension_amount": "45000.00",
            "tax_exclusive_amount": "0",
            "tax_inclusive_amount": "45000.00",
            "allowance_total_amount": "0",
            "charge_total_amount": "0.00",
            "payable_amount": "45000.00"
        },
        "credit_note_lines":
            [
                {
                    "unit_measure_id": 70,
                    "invoiced_quantity": "1",
                    "line_extension_amount": "45000.00",
                    "free_of_charge_indicator": false,
                    "allowance_charges": [{
                        "charge_indicator": false,
                        "allowance_charge_reason": "DESCUENTO GENERAL",
                        "amount": "0.00",
                        "base_amount": "45000.00"
                    }
                    ],
                    "tax_totals": [
                        {
                            "tax_id": 1,
                            "tax_amount": "0.00",
                            "taxable_amount": "0.00",
                            "percent": "0.00"
                        }
                    ],
                    "description": "PRUEBA NOTA CONTABLE ELECTRONICA",
                    "code": "001NOTA",
                    "type_item_identification_id": 4,
                    "price_amount": "45000",
                    "base_quantity": "1"
                }
            ]
    },
    nd = {
        "billing_reference": {
            "number": null,
            "uuid": null,
            "issue_date": `${formattedDate}`
        },
        "discrepancyresponsecode": 3,
        "discrepancyresponsedescription": "PRUEBA DE MOTIVO NOTA DEBITO",
        "notes": "PRUEBA DE NOTA DEBITO",
        "number": 1,
        "prefix": "ND",
        "type_document_id": 5,
        "date": `${formattedDate}`,
        "time": "06:00:13",
        "sendmail": false,
        "sendmailtome": false,
        "head_note": "",
        "foot_note": "",
        "customer": {
            "identification_number": 901249232,
            "dv": 0,
            "name": "Bercode SAS",
            "phone": 3106031839,
            "address": "CLL 18A # 11 - 20",
            "email": "bercodelorica@gmail.com",
            "merchant_registration": "00000000",
            "type_document_identification_id": 6,
            "type_organization_id": 1,
            "municipality_id": 439,
            "type_regime_id": 1
        },
        "allowance_charges": [
            {
                "discount_id": 1,
                "charge_indicator": false,
                "allowance_charge_reason": "DESCUENTO GENERAL",
                "amount": "50000.00",
                "base_amount": "1000000.00"
            }
        ],
        "requested_monetary_totals": {
            "line_extension_amount": "840336.134",
            "tax_exclusive_amount": "840336.134",
            "tax_inclusive_amount": "1000000.00",
            "allowance_total_amount": "50000.00",
            "payable_amount": "950000.00"
        },
        "tax_totals":
            [
                {
                    "tax_id": 1,
                    "tax_amount": "159663.865",
                    "percent": "19",
                    "taxable_amount": "840336.134"
                }
            ],
        "debit_note_lines":
            [
                {
                    "unit_measure_id": 70,
                    "invoiced_quantity": "1",
                    "line_extension_amount": "840336.134",
                    "free_of_charge_indicator": false,
                    "tax_totals": [
                        {
                            "tax_id": 1,
                            "tax_amount": "159663.865",
                            "taxable_amount": "840336.134",
                            "percent": "19.00"
                        }
                    ],
                    "description": "COMISION POR SERVICIOS",
                    "notes": "ESTA ES UNA PRUEBA DE NOTA DE DETALLE DE LINEA.",
                    "code": "COMISION",
                    "type_item_identification_id": 4,
                    "price_amount": "1000000.00",
                    "base_quantity": "1"
                }
            ]
    },
    payroll = {
        "notes": "PRUEBA DE ENVIO DE NOMINA ELECTRONICA",
        "period": {
            "issue_date": "2021-07-28",
            "worked_time": "785.00",
            "admision_date": "2018-10-10",
            "settlement_end_date": "2021-07-31",
            "settlement_start_date": "2021-07-01"
        },
        "prefix": null,
        "worker": {
            "salary": "1500000.00",
            "address": "CLL 1 CRA 1 # 1",
            "surname": "DEMO",
            "first_name": "EMPLOY",
            "middle_name": null,
            "second_surname": "DEMO",
            "type_worker_id": 1,
            "municipality_id": 822,
            "type_contract_id": 1,
            "high_risk_pension": false,
            "integral_salarary": false,
            "sub_type_worker_id": 1,
            "identification_number": 12345678,
            "payroll_type_document_identification_id": 3
        },
        "accrued": {
            "salary": "750000.00",
            "worked_days": 30,
            "accrued_total": "859000.00",
            "transportation_allowance": "115000.00"
        },
        "novelty": {
            "novelty": false,
            "uuidnov": null
        },
        "payment": {
            "bank_name": "BANCO DAVIVIENDA",
            "account_type": "AHORROS",
            "account_number": "126070603280",
            "payment_method_id": 10
        },
        "sendmail": false,
        "deductions": {
            "eps_deduction": "60000.00",
            "deductions_total": "120000.00",
            "pension_deduction": "60000.00",
            "eps_type_law_deductions_id": 1,
            "pension_type_law_deductions_id": 5
        },
        "consecutive": 0,
        "worker_code": "12345678",
        "sendmailtome": false,
        "payment_dates": [{
            "payment_date": "2021-03-10"
        }
        ],
        "type_document_id": 9,
        "payroll_period_id": 4
    }
    ,
    payrollNA = {
        "type_document_id": 10,
        "predecessor": {
            "predecessor_number": null,
            "predecessor_cune": null,
            "predecessor_issue_date": `${formattedDate}`
        },
        "period": {
            "admision_date": "2018-10-10",
            "settlement_start_date": "2021-07-01",
            "settlement_end_date": "2021-07-15",
            "worked_time": "15.00",
            "issue_date": "2021-07-28"
        },
        "type_note": 2,
        "prefix": null,
        "consecutive": 1,
        "payroll_period_id": 4,
        "notes": "PRUEBA DE ENVIO DE NOMINA DE AJUSTE ELECTRONICA - ELIMINAR"
    }
    ,
]
const CreatePagination = async ({ ul, span, data, params }) => {
    const ulElement = document.querySelector(ul)
    const spanElement = document.querySelector(span)
    ulElement.textContent = null
    if (data['links'] !== undefined) {
        data['links'].forEach(element => {
            const li = document.createElement("li")
            li.classList.add('page-item')
            const a = document.createElement("a")
            let label = `${element.label}`
            let url = `${element.url}` !== "null" ? `${element.url}` : "#"
            let pageLink = `${url.split("?")[1]}`
            // console.log(page)
            if (label == "&laquo; Anterior") a.innerHTML = `${element.label.split(" ")[0]}`
            if (label == "Siguiente &raquo;") a.innerHTML = `${element.label.split(" ")[1]}`
            if (label !== "Siguiente &raquo;" && label !== "&laquo; Anterior") a.innerHTML = `${element.label}`
            a.setAttribute('href', `#`)
            if (url !== "#") {
                params['params']['page'] = pageLink
                a.setAttribute('onclick', `${params['callback']}(${JSON.stringify(params['params'])})`)
            }
            if (element.active == true) {
                a.classList.add('page-link', 'active', 'btn', 'btn-sm')
            } else {
                a.classList.add('page-link', 'btn', 'btn-sm')
            }
            li.appendChild(a)
            ulElement.appendChild(li);
        });
        spanElement.textContent = `Mostrando registros del ${data['from']} al ${data['to']} de un total de ${data['total']} registros`
    }
}
const ToastR = ({ message, icon = 'info', time = 3000, clean = false, title = '' }) => {
    const icons = {
        success: 'ico-success',
        info: 'ico-info',
        warning: 'ico-warning',
        error: 'ico-error',
        question: 'ico-question',
    }
    const colors = {
        success: 'green',
        info: 'blue',
        warning: 'yelow',
        error: 'red',
    }
    const class_name = {
        success: 'bg-success',
        info: 'bg-info',
        warning: 'bg-warning',
        error: 'bg-danger',
        question: 'bg-secondary',
    }
    const maxWidth = {
        success: null,
        info: null,
        warning: null,
        error: 80,
    }
    iziToast.show({
        id: null,
        class: class_name[icon],
        title: title,
        titleColor: '',
        titleSize: '',
        titleLineHeight: '',
        message: message,
        messageColor: "#FFFF",
        messageSize: '',
        messageLineHeight: '',
        backgroundColor: '',
        theme: 'light', // dark
        color: colors[icon],
        icon: icons[icon],
        iconText: '',
        iconColor: "#FFFF",
        iconUrl: null,
        image: '',
        imageWidth: 50,
        maxWidth: null,
        zindex: null,
        layout: 1,
        balloon: false,
        close: true,
        closeOnEscape: false,
        closeOnClick: false,
        displayMode: 0, // once, replace
        position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
        target: '',
        targetFirst: true,
        timeout: time,
        rtl: false,
        animateInside: true,
        drag: true,
        pauseOnHover: true,
        resetOnHover: false,
        progressBar: true,
        progressBarColor: '#FFFF',
        progressBarEasing: 'linear',
        overlay: false,
        overlayClose: false,
        overlayColor: 'rgba(0, 0, 0, 0.6)',
        transitionIn: 'fadeInUp',
        transitionOut: 'fadeOut',
        transitionInMobile: 'fadeInUp',
        transitionOutMobile: 'fadeOutDown',
        buttons: {},
        inputs: {},
        onOpening: function () { },
        onOpened: function () { },
        onClosing: function () { },
        onClosed: function () { }
    });
}
const CopyClipboard = async (element) => {
    const input = document.querySelector(element);
    input.select();
    document.execCommand('copy');
    ToastR({ message: 'Â¡Contenido copiado con Ã©xito!', icon: 'success' })
}

$(window).on("load", function () {
    const selec_companies = document.getElementById("companies-select")
    if (selec_companies !== null) {
        selec_companies.addEventListener("change", function () {
            const values = document.querySelector('#companies-select')
            const ResolutionsApi = $('#ResolutionsApi').DataTable();
            const ResolutionsDian = $('#ResolutionsDian').DataTable();

            console.log(values)
            document.querySelector("#api_token").value = (values.value).split('/')[0] !== undefined ? (values.value)
                .split('/')[0] : ""
            document.querySelector("#id_software").value = (values.value).split('/')[1] !== undefined ? (values
                .value).split('/')[1] : ""
            document.querySelector("#id_software_payroll").value = (values.value).split('/')[2] !== undefined ? (
                values.value).split('/')[2] : ""
            document.querySelector("#pin_software").value = (values.value).split('/')[3] !== undefined ? (values
                .value).split('/')[3] : ""
            document.querySelector("#pin_software_payroll").value = (values.value).split('/')[4] !== undefined ? (
                values.value).split('/')[4] : ""
            document.querySelector("#identification_number").value = (values.value).split('/')[5] !== undefined ? (
                values.value).split('/')[5] : ""
            document.querySelector("#type_environment_id").textContent = (values.value).split('/')[6] == 1 ?
                'ProducciÃ³n' : 'Pruebas'
            document.querySelector("#payroll_type_environment_id").textContent = (values.value).split('/')[7] == 1 ?
                'ProducciÃ³n' : 'Pruebas'

            document.querySelector('#prefix').destroy();
            VirtualSelect.init({
                ele: '#prefix',
                multiple: true,
                search: false,
                showValueAsTags: false, // Permite ver los nombre de los option selected                    
            });
            document.querySelector('#identification_number_get_user').value = (values.value).split('/')[5] !== undefined ? (values.value).split('/')[5] : ""
            ResolutionsDian.clear().draw();
            ResolutionsApi.clear().draw();
        });
    }
});


const token = 'M2ZjZDgzNjRhZjYwZTczYThjYmNhOTllYTNjZjU3YzI3OTM1MGUxMDhlMzlkNjkzYWE3NGU5ZDJhODQ3NjkxOA=='          

    window.addEventListener("DOMContentLoaded", (event) => {
        click('navbar-toggler-humburger-icon')
    });

        const masterUrl = 'https://apps2.nextpyme.plus';
        VirtualSelect.init({
            ele: '.select_search_box',
            search: true,
            maxWidth: "400px",
            hasOptionDescription: true
        });
        VirtualSelect.init({
            ele: '.select_search_box_multiple',
            multiple: true,
            search: false,
            showValueAsTags: false, // Permite ver los nombre de los option selected
        });

        const LogoutUser = async () => {
            const RequestLogout = await fetch('https://apps2.nextpyme.plus/Logout', {
                method: 'post',
                credentials: "same-origin",
                contentType: "application/json; charset=UTF-8",
                body: JSON.stringify({}),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // "X-CSRF-Token": "unx9k1vRSDce2xgTJ16qnBqCaAQsEXTNj4YgR5Kf",
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                }
            })
            const ResponseLogout = await RequestLogout.json()
            if (ResponseLogout.success === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Logout!',
                    text: ResponseLogout.message,
                    showConfirmButton: true,
                    timer: 2000
                })
                window.location.href = 'https://apps2.nextpyme.plus'
                return;
            } else {
                window.location.href = 'https://apps2.nextpyme.plus'
            }
        }
    
        
            // Change Password        
            const change_password_button = document.querySelector('#change_password_button')
            const validate_code_confirmation = document.querySelector('#validate_code_confirmation')
            const change_new_password = document.querySelector('#change_new_password')

            change_password_button.addEventListener('click', async function(event) {
                Swal.fire({
                    title: `Desea solicitar un código para cambiar la contraseña?`,
                    showCancelButton: true,
                    confirmButtonText: 'Continuar!',
                    showLoaderOnConfirm: true,
                    preConfirm: async (code) => {
                        const RequestSendEmailPassword = await fetch('https://apps2.nextpyme.plus/v1/sendemailpassword', {
                            method: 'post',
                            credentials: "same-origin",
                            contentType: "application/json; charset=UTF-8",
                            // body: JSON.stringify(DataContract),
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': 'Bearer 3fcd8364af60e73a8cbca99ea3cf57c279350e108e39d693aa74e9d2a8476918'
                            }
                        })
                        const ResponseSendEmailPassword = await RequestSendEmailPassword.json()
                        console.log({
                            ResponseSendEmailPassword
                        })
                        if (ResponseSendEmailPassword.success == true) {
                            return Notifications(null, 'Recuperación de contraseña', 'success', true,
                                ResponseSendEmailPassword
                                .message,
                                false)
                        }
                        return Notifications(null, 'Recuperación de contraseña', 'error', true,
                            ResponseSendEmailPassword
                            .message,
                            false)
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            })

            // Validar Código
            validate_code_confirmation.addEventListener('click', async function(event) {
                const RequestValidateCode = await fetch('https://apps2.nextpyme.plus/v1/validatecode', {
                    method: 'post',
                    credentials: "same-origin",
                    contentType: "application/json; charset=UTF-8",
                    body: JSON.stringify({
                        'confirmation_code': document.querySelector("#confirmation_code").value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer 3fcd8364af60e73a8cbca99ea3cf57c279350e108e39d693aa74e9d2a8476918'
                    }
                })
                const ResponseValidateCode = await RequestValidateCode.json()
                console.log({
                    ResponseValidateCode
                })
                if (ResponseValidateCode.success == true) {
                    const col_div = document.querySelector("#col_div")
                    col_div.textContent = null
                    const div = document.createElement('div');
                    div.innerHTML =
                        `<div class="d-flex"><div class="input-group mb-3"> <input type="password" id="password" class="form-control password" placeholder="Ingrese la nueva contraseña"> <input type="password" id="password_confirmation" class="form-control password" placeholder="confirme la nueva contraseña"> <button class="btn btn-outline-secondary" type="button" id="change_new_password" onclick="ShowPassword()"> <i class="fa fa-eye text-success"></i></button><button class="btn btn-outline-secondary" type="button" id="change_new_password" onclick="ChangePasswordApp()"> <i class="fa fa-key text-success"></i></button></div></div>`
                    col_div.appendChild(div)
                    return Notifications(null, 'Validacción de código', 'success', true, ResponseValidateCode
                        .message, false)

                }
                return Notifications(null, 'Validacción de código', 'error', true, ResponseValidateCode
                    .message,
                    false)
            })
            const ChangePasswordApp = async function() {
                const RequestChangePassword = await fetch('https://apps2.nextpyme.plus/v1/changepassword', {
                    method: 'post',
                    credentials: "same-origin",
                    contentType: "application/json; charset=UTF-8",
                    body: JSON.stringify({
                        'password': document.querySelector("#password").value,
                        'password_confirmation': document.querySelector("#password_confirmation").value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer 3fcd8364af60e73a8cbca99ea3cf57c279350e108e39d693aa74e9d2a8476918'
                    }
                })
                const ResponseChangePassword = await RequestChangePassword.json()
                console.log({
                    ResponseChangePassword
                })
                const {
                    success,
                    message,
                    errors
                } = ResponseChangePassword
                if (ResponseChangePassword.success == true) {
                    Notifications(null, 'Cambio de contraseña', 'success', true, ResponseChangePassword.message,
                        false)
                    location.reload()
                    return;
                } else {
                    if (errors !== undefined) {
                        return Notifications(null, ResponseChangePassword.message, 'error',
                            true, Object.values(errors), false)
                    }
                    return Notifications(null, 'Cambio de contraseña', 'error', true, ResponseChangePassword
                        .message,
                        false)
                }
            }
        
            

    // window.addEventListener("DOMContentLoaded", (event) => {
    //     click('navbar-toggler-humburger-icon')
    // });
    const SearchDocuments = async ({
        table,
        fields = null,
        typedocument = null,
        filter = false
    }) => {
        const type_document_id = document.querySelector("#type_document_id")
        const state_document_id = document.querySelector("#state_document_id")
        const start_date = document.querySelector("#start_date")
        const timepicker = document.querySelector('#timepicker_dates').value
        const prefix_search = document.querySelector('#prefix_search')
        const paginate_limit = document.querySelector('#paginate_limit')
        if (parseInt(paginate_limit.value) >= 50000) return ToastR({
            message: 'El máximo de registros por consulta es 50.000, por favor ajuste el valor.',
            icon: 'error'
        })
        $('#' + table).DataTable().clear().draw()
        const dataInvoice = {
            url: 'https://api.nextpyme.plus/api/ubl2.1/reports/documents',
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Authorization": 'Bearer ' + atob(token),
                "Accept": "application/json",
            },
            typeResponse: 'json',
            bodyRequest: JSON.stringify({
                type_document_id: type_document_id.value,
                state_document_id: state_document_id.value,
                start_date: timepicker.split('to')[0],
                end_date: timepicker.split('to')[1],
                number: number.value,
                prefix: prefix_search.value !== "" ? prefix_search.value : null,
                select_fileds: ["*"],
                filter: !!filter,
                paginate: paginate_limit.value !== "" ? paginate_limit.value : 100
            })
        }
        // return console.log(dataInvoice)
        if (timepicker.split('to')[0] == "") return ToastR({
            message: '¡Ingrese una fecha valida!',
            icon: 'info'
        })
        const {
            data,
            success,
            message,
            errors
        } = await RequestComponent(dataInvoice)
        if (message == "Server Error" || message == "Internal Server Error") return ToastR({
            message: 'Seleccione un rango de fechas menor.',
            icon: 'warning'
        })
        if (errors !== undefined) return Notifications(null, message, 'error', false, Object.values(errors))
        if (success == false) return ToastR({
            message,
            icon: 'error'
        });
        if (data['data'].length < 1) ToastR({
            message: 'No se encontrarón registros',
            icon: 'info'
        })
        if (data['data'].length > 0) ToastR({
            message,
            icon: 'success'
        })
        if (typedocument == 'Invoice') {
            // spinner.setAttribute('hidden', '');
            var CertificatesTable = $('#' + table).DataTable({
                scrollY: "350px",
                scrollX: true,
                scrollCollapse: true,
                paging: true,
                processing: true,
                searching: true,
                bDestroy: true,
                sortable: false,
                fixedColumns: {
                    left: 1,
                    right: 1
                },
                data: $.map(data['data'], function(value, key) {
                    return value;
                }),
                columns: [{
                        data: null
                    },
                    {
                        data: null
                    },
                    {
                        data: 'prefix'
                    },
                    {
                        data: 'number'
                    },
                    {
                        data: 'customer'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'state_document_id'
                    },
                    {
                        data: 'currency_id'
                    },
                    {
                        data: null
                    },
                    {
                        data: 'sale'
                    },
                    {
                        data: 'total_discount'
                    },
                    {
                        data: 'subtotal'
                    },
                    {
                        data: 'total_tax'
                    },
                    {
                        data: 'total'
                    },
                    {
                        data: 'cufe'
                    },
                    {
                        data: null
                    }
                ],
                columnDefs: [{
                        "targets": 0,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            return `<label class="colorinput mt-1"><input name="color" type="checkbox" value="primary" class="colorinput-input" data-check="${data['prefix']}-${data['number']}"><span class="colorinput-color bg-primary"></span></label>`
                        }
                    }, {
                        "targets": 1,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            if (full['type_document'] == null) {
                                return null;
                            }
                            return full['type_document']['name']
                        }
                    }, {
                        "targets": 2,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            if (full['prefix'] == null) {
                                return null;
                            }
                            return full['prefix']
                        }
                    }, {
                        "targets": 5,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            return full['client']['name']
                        }
                    },
                    {
                        "targets": 6,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            if (full['created_at'] === null) return null;
                            let date = full['created_at'].split(' ')
                            return `${date[0]}`
                        }
                    },
                    {
                        "targets": 7,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            if (full['state_document_id'] == 1)
                                return `<div class="badge badge-soft-success"><i class="fa fa-check"></i><span> Emitido</span></div>`
                            if (full['state_document_id'] == 0)
                                return `<div class="badge badge-soft-danger"><i class="fa fa-check"></i><span> No emitido</span>  </div> <a class="btn btn-xs btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver motivo de rechazo" onclick="event.preventDefault();ErrorDetails('${full['identification_number']}', '${full['type_document_id']}', '${full['prefix']}', '${full['number']}')"><i class="fas fa-eye"></i></i></a>`
                        }
                    },
                    {
                        "targets": 8,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            return full['currency']['code']
                        }
                    },
                    {
                        "targets": 9,
                        "sortable": false,
                        render: DataTable.render.number(",", ".", 2, '$')
                    },
                    {
                        targets: 10,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 11,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 12,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 13,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 15,
                        render: function(data, type, full, meta) {
                            if (full['state_document_id'] !== 0) {
                                return `<div class="btn-toolbar text-center justify-content-center" role="toolbar"
                                                aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="First group">
                                                    <a class="btn btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar el PDF" onclick="event.preventDefault();DonwloadFile('${full['pdf']}','${full['identification_number']}','pdf' ,'false')"><i class="fas fa-download"></i></a>
                                                    <a class="btn btn-success btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar el ZIP Attacheddocument" onclick="event.preventDefault();DonwloadFile('${full['xml']}','${full['identification_number']}','xml' ,'false')"><i class="fas fa-file-archive"></i></a>                                                                                       
                                                    <a class="btn btn-secondary btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Reenviar el correo" onclick="event.preventDefault();SendMail('${full['prefix']}','${full['number']}')"><i class="fas fa-paper-plane"></i></a>                                                                                       
                                                    <a class="btn btn-warning btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Validar en la DIAN" target="_blank" href="https://catalogo-vpfe.dian.gov.co/Document/ShowDocumentToPublic/${full['cufe']}"><i class="fas fa-eye"></i></a>                                                                                       
                                                    <a class="btn btn-info btn-xs"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver constancia de envio" target="_blank" onclick="ValidateEmail('${full['pdf']}', '${full['client']['email']}')"><i class="fas fa-envelope-open-text"></i></a>                                                                                       
                                                </div>                                                
                                            </div>`
                            }
                            return `--`
                        }
                    }
                ],
                dom: "<'row'<'col-md-6'B><'col-md-6'f>>t<'row'<'col-md-6 mt-2 text-center'i><'col-md-6 text-center'p>>",
                buttons: [{
                    extend: 'excel',
                    text: '<i class="far fa-file-excel"></i> <span>Exportar</span>',
                    className: 'btn-sm btn-success mt-1',
                    autoFilter: true,
                    sheetName: 'Documentos'
                }],
                "drawCallback": function(settings) {
                    $('ul.pagination').addClass("pagination-sm");
                },
                "language": {
                    "url": `https://apps2.nextpyme.plus/leng/Spanish.json`
                }
            });
        } else if (typedocument == 'Payroll') {
            // spinner.setAttribute('hidden', '');
            var CertificatesTable = $('#' + table).DataTable({
                scrollY: "350px",
                scrollX: true,
                scrollCollapse: true,
                paging: true,
                processing: true,
                searching: true,
                bDestroy: true,
                sortable: false,
                fixedColumns: {
                    left: 1,
                    right: 1
                },
                data: $.map(data['data'], function(value, key) {
                    return value;
                }),
                columns: [{
                        data: null
                    },
                    {
                        data: 'type_document_id'
                    },
                    {
                        data: 'prefix'
                    },
                    {
                        data: 'consecutive'
                    },
                    {
                        data: 'employee_id'
                    },
                    {
                        data: 'date_issue'
                    },
                    {
                        data: null
                    },
                    {
                        data: 'accrued_total'
                    },
                    {
                        data: 'deductions_total'
                    },
                    {
                        data: 'total_payroll'
                    },
                    {
                        data: 'cune'
                    },

                    {
                        data: null
                    }
                ],
                columnDefs: [{
                        "targets": 0,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            return `<label class="colorinput mt-1"><input name="color" type="checkbox" value="primary" class="colorinput-input" data-check="${data['prefix']}-${data['number']}"><span class="colorinput-color bg-primary"></span></label>`
                        }
                    }, {
                        "targets": 1,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            if (full['type_document'] == null) {
                                return null;
                            }
                            return full['type_document']['name']
                        }
                    }, {
                        "targets": 2,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            if (full['prefix'] == null) {
                                return null;
                            }
                            return full['prefix']
                        }
                    },
                    {
                        "targets": 5,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            if (full['created_at'] === null) return null;
                            let date = full['created_at'].split(' ')
                            return `${date[0]}`
                        }
                    },
                    {
                        "targets": 6,
                        "sortable": false,
                        render: function(data, type, full, meta) {
                            if (full['state_document_id'] == 1)
                                return `<div class="badge badge-soft-success"><i class="fa fa-check"></i><span> Emitido</span></div>`
                            if (full['state_document_id'] == 0)
                                return `<div class="badge badge-soft-danger"><i class="fa fa-check"></i><span> No emitido</span></div>`
                        }
                    },
                    {
                        targets: 7,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 8,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 9,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 11,
                        render: function(data, type, full, meta) {
                            if (full['state_document_id'] !== 0) {
                                return `<div class="btn-toolbar text-center justify-content-center" role="toolbar"
                                                aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="First group">
                                                    <a class="btn btn-danger btn-xs" message="Descargar PDF" onclick="event.preventDefault();DonwloadFile('${full['pdf']}','${full['identification_number']}','pdf' ,'false')"><i class="fas fa-download"></i></a>                                                    
                                                    <a class="btn btn-info btn-xs" message="Ver en la DIAN" target="_blank" href="https://catalogo-vpfe.dian.gov.co/Document/ShowDocumentToPublic/${full['cune']}"><i class="fas fa-eye"></i></a>                                                                                       
                                                </div>                                                
                                            </div>`
                            }
                            return `--`
                        }
                    }

                ],
                // dom: 'Bfrtip',
                dom: "<'row'<'col-md-6'B><'col-md-6'f>>t<'row'<'col-md-6 mt-2 text-center'i><'col-md-6 text-center'p>>",
                buttons: [{
                    extend: 'excel',
                    text: '<i class="far fa-file-excel"></i> <span>Exportar</span>',
                    className: 'btn-sm btn-success',
                    autoFilter: true,
                    sheetName: 'Documentos'
                }],
                "drawCallback": function(settings) {
                    $('ul.pagination').addClass("pagination-sm");
                },
                "language": {
                    "url": `https://apps2.nextpyme.plus/leng/Spanish.json`
                }
            });
        } else if (typedocument == 'Received') {
            // spinner.setAttribute('hidden', '');
            var CertificatesTable = $('#' + table).DataTable({
                scrollY: "350px",
                scrollX: true,
                scrollCollapse: true,
                paging: true,
                processing: true,
                searching: true,
                bDestroy: true,
                // sortable: false,
                order: [
                    [14, 'asc']
                ],
                fixedColumns: {
                    left: 0,
                    right: 5
                },
                data: $.map(data['data'], function(value, key) {
                    return value;
                }),
                columns: [{
                        data: 'identification_number'
                    },
                    {
                        data: 'name_seller'
                    },
                    {
                        data: 'prefix'
                    },
                    {
                        data: 'number'
                    },
                    {
                        data: 'customer'
                    },
                    {
                        data: 'date_issue'
                    },
                    {
                        data: 'sale'
                    },
                    {
                        data: 'subtotal'
                    },
                    {
                        data: 'total_discount'
                    },
                    {
                        data: 'total_tax'
                    },
                    {
                        data: 'total'
                    },

                    {
                        data: 'xml'
                    },
                    {
                        data: null
                    },
                    {
                        data: null
                    },
                    {
                        data: null
                    },
                    {
                        data: null
                    },
                    {
                        data: null
                    }
                ],
                columnDefs: [{
                        "targets": 2,
                        "sortable": true,
                        render: function(data, type, full, meta) {
                            if (full['prefix'] == null) {
                                return null;
                            }
                            return full['prefix']
                        }
                    },
                    {
                        "targets": 5,
                        "sortable": true,
                        render: function(data, type, full, meta) {
                            if (full['created_at'] === null) return null;
                            let date = full['created_at'].split(' ')
                            return `${date[0]}`
                        }
                    },

                    {
                        targets: 6,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 7,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 8,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 9,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        targets: 10,
                        render: DataTable.render.number(",", ".", 2, '$'),
                    },
                    {
                        "targets": 12,
                        "sortable": true,
                        render: function(data, type, full, meta) {
                            if (full['acu_recibo'] === 0 && full['request_api'] !== null) {
                                const array_1 = window.btoa(full['request_api'])
                                return `<button onclick="ResendEvent('1', '${array_1}')" class='btn btn-xs btn-secondary'><i class="fas fa-paper-plane"></i></button>`
                                return null
                            };
                            return `<div class="badge badge-soft-success"><i class="fa fa-check"></i><span> Registrado</span></div>`
                        }
                    },
                    {
                        "targets": 13,
                        "sortable": true,
                        render: function(data, type, full, meta) {
                            if (full['rec_bienes'] === 0 && full['request_api'] !== null) {
                                const array_3 = window.btoa(full['request_api'])
                                return `<button onclick="ResendEvent('3', '${array_3}')" class='btn btn-xs btn-info'><i class="fas fa-paper-plane"></i></button>`
                                return null
                            };
                            return `<div class="badge badge-soft-success"><i class="fa fa-check"></i><span> Registrado</span></div>`
                        }
                    },
                    {
                        "targets": 14,
                        "sortable": true,
                        render: function(data, type, full, meta) {
                            if (full['aceptacion'] === 0 && full['rechazo'] === 0 && full[
                                    'request_api'] !== null) {
                                const array_4 = window.btoa(full['request_api'])
                                return `<button onclick="ResendEvent('4', '${array_4}')" class='btn btn-xs btn-success'><i class="fas fa-paper-plane"></i></button>`
                            };
                            if (full['rechazo'] === 0 && full['aceptacion'] === 1) {
                                return `<div class="badge badge-soft-info"><i class="fa fa-check"></i><span> Aceptada</span></div>`
                            }
                            return '--'
                        }
                    },
                    {
                        "targets": 15,
                        "sortable": true,
                        render: function(data, type, full, meta) {
                            if (full['rechazo'] === 0 && full['aceptacion'] === 0 && full[
                                    'request_api'] !== null) {
                                // return null
                                const array_2 = window.btoa(full['request_api'])
                                return `<button onclick="ReyectDocumentButton('2', '${array_2}')" class='btn btn-xs btn-danger'><i class="fas fa-paper-plane"></i></button>`
                            } else if (full['rechazo'] === 1) {
                                return `<div class="badge badge-soft-danger"><i class="fa fa-check"></i><span> Rechazada</span></div>`
                            }
                            return null
                        }
                    },
                    {
                        targets: 16,
                        render: function(data, type, full, meta) {
                            return `<div class="btn-toolbar text-center justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group" role="group" aria-label="First group">                                                    
                                            <a class="btn btn-info btn-xs" message="Ver en la DIAN" target="_blank" href="https://catalogo-vpfe.dian.gov.co/Document/ShowDocumentToPublic/${full['cufe']}"><i class="fas fa-eye"></i></a>                                                                                                                                   
                                            <button class="btn btn-success btn-xs" onclick="DownloadEVS('${full['prefix']}', '${full['number']}', ${full['customer']})"><i class="fas fa-file-download"></i></button>
                                        </div>                                                
                            </div>`
                        }
                    }

                ],
                dom: "<'row'<'col-md-6'B><'col-md-6'f>>t<'row'<'col-md-6 mt-2 text-center'i><'col-md-6 text-center'p>>",
                buttons: [{
                    extend: 'excel',
                    text: '<i class="far fa-file-excel"></i> <span>Exportar</span>',
                    className: 'btn-sm btn-success',
                    autoFilter: true,
                    sheetName: 'Documentos'
                }],
                "drawCallback": function(settings) {
                    $('ul.pagination').addClass("pagination-sm");
                },
                "language": {
                    "url": `https://apps2.nextpyme.plus/leng/Spanish.json`
                }
            });
        }
        // CreatePagination({ul:'.pagination-certificates', span:'.totals-certificates', data:data, params: {params:{table:table,fields:fields,typedocument:typedocument,filter:filter,page:null,},callback: 'SearchDocuments'} })
    }
    const DonwloadFile = async (file, identification_number, typeFile, base64 = false) => {
        if (number != null || type != null || identification_number !== null) {
            let fileSystem = null
            if (typeFile == 'pdf') {
                fileSystem = file
            } else if (typeFile == 'xml') {
                fileSystem = "ZipAttachm-" + (file).slice(4)
            }
            console.log({
                typeFile
            }, {
                file
            }, fileSystem)
            try {
                const DataFiles = {
                    url: 'https://api.nextpyme.plus/api/ubl2.1/download' +
                        `/${identification_number}/${fileSystem}`,
                    method: 'get',
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": 'Bearer ' + atob(token),
                        "Accept": "application/json",
                    },
                    typeResponse: 'blob'
                }
                const ResponseAPIFiles = await RequestComponent(DataFiles)
                spinner.removeAttribute('hidden');
                if (ResponseAPIFiles['size'] <= 300) {
                    spinner.setAttribute('hidden', '');
                    return Notifications(null, 'Error al descargar el archivo', 'error', true,
                        'No es posible mostrar los documentos en este momento, por favor intente más tarde!',
                        false)
                }
                spinner.setAttribute('hidden', '');
                Notifications(null, 'Archivo descargado con éxito!', 'success', true,
                    'El archivo se abrirá automaticamente!',
                    false)
                var blob = new Blob([ResponseAPIFiles], {
                    type: ResponseAPIFiles['type'],
                });
                var url = URL.createObjectURL(blob);
                window.open(url);
            } catch (error) {
                return Notifications(null, 'Error al descargar el archivo', 'error', true,
                    'No es posible mostrar los documentos en este momento, por favor intente más tarde!',
                    false)
            }
        }
    }

    const ValidateEmail = async (documentNumber, email) => {

        const urlfe = 'https://api.nextpyme.plus/api/ubl2.1'
        let query_subject = null;
        const number = (documentNumber.split('-')[1]).slice(0, -4)
        const {
            value: formValues
        } = await Swal.fire({
            title: 'Estado del envio! <i class="fas fa-mail-bulk text-success"></i> ',
            html: `Se validará el envio del correo electrónico del siguiente <strong>documento</strong> <br> <input id="swal-input1" class="swal2-input" value="${email}"> <br> <input id="swal-input2" disabled class="swal2-input" value="${number}">`,
            focusConfirm: false,
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                try {
                    const dataValidateMail = {
                        url: `${urlfe.slice(0,-7)}/google_api/get_messages_by_receptor`,
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": 'Bearer ' + atob(token),
                            "Accept": "application/json",
                        },
                        typeResponse: 'json',
                        bodyRequest: JSON.stringify({
                            'to_email': email,
                            'query_subject': number
                        }),
                    }
                    const ResponseValidateMail = await RequestComponent(dataValidateMail)
                    // console.log(ResponseValidateMail)
                    if (ResponseValidateMail['resultSizeEstimate'] == 1) {
                        return Swal.fire({
                            title: `<strong>Mensaje No. ${ResponseValidateMail['Response']['id']}</strong>`,
                            icon: 'success',
                            html: `Correo electrónico enviado a <strong>${ResponseValidateMail['Response']['payload']['headers'][15]['value']}</strong> 
                        el día <strong>${ResponseValidateMail['Response']['payload']['headers'][12]['value']}</strong> con el asunto <strong>${ResponseValidateMail['Response']['payload']['headers'][13]['value']}</strong>, 
                        nombre del archivo ajunto <strong>${ResponseValidateMail['Response']['payload']['parts'][1]['filename']}</strong>`,
                            showCloseButton: true,
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonAriaLabel: 'Ok!',
                            cancelButtonAriaLabel: 'Thumbs down'
                        })
                    }
                    return Swal.fire({
                        title: `<strong>Mensaje No. ${ResponseValidateMail['Response']['id']}</strong>`,
                        icon: 'success',
                        html: `Correo electrónico enviado en ${ResponseValidateMail['resultSizeEstimate']} ocasiones al correo ${email}, para mayor detalle comuniquese con su proveedor de software!`,
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonAriaLabel: 'Ok!',
                        cancelButtonAriaLabel: 'Thumbs down'
                    })
                } catch (error) {
                    return Notifications(null, 'Error al consultar el estado del correo', 'error',
                        true,
                        error,
                        false)
                }
            }
        })
    }
    const SendMail = async (prefix, number) => {
        if (prefix == null || prefix == "") {
            return Notifications(null, 'Para reenviar un documento, este debe contar con un prefijo', 'error',
                true, error, false)
        }
        const {
            value: formValues
        } = await Swal.fire({
            title: 'Reenviar el correo electrónico <i class="fas fa-mail-bulk text-success"></i> ',
            html: `Ingrese el correo al que desea reenviar el documento <br> <input id="emailinput" type="email" class="swal2-input" value="">`,
            focusConfirm: false,
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                try {
                    const email = document.querySelector("#emailinput").value
                    const dataSendMail = {
                        url: `https://api.nextpyme.plus/api/ubl2.1/send-email`,
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": 'Bearer ' + atob(token),
                            "Accept": "application/json",
                        },
                        typeResponse: 'json',
                        bodyRequest: JSON.stringify({
                            'alternate_email': email,
                            'number': number,
                            'prefix': prefix,
                        }),
                    }
                    const {
                        success,
                        message
                    } = await RequestComponent(dataSendMail)
                    if (success == true) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: `${message} al correo electrónico ${email}`
                        })
                        return;
                    }
                    return Swal.fire({
                        title: `Error al enviar el correo`,
                        icon: 'error',
                        html: `${message}`,
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonAriaLabel: 'Ok!',
                        cancelButtonAriaLabel: 'Thumbs down'
                    })

                } catch (error) {
                    return Notifications(null, 'No fue posible reenviar el correo', 'error',
                        true,
                        error,
                        false)
                }
            }
        })
    }
    const UploadRadian = async () => {
        Swal.fire({
            title: 'Seleccione el modo de carga del RADIAN!',
            showDenyButton: true,
            showCancelButton: true,
            closeOnClickOutside: false,
            confirmButtonText: 'con el XML',
            denyButtonText: `Sin XML`,
        }).then(async (result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Seleccione el archivo XML!',
                    closeOnClickOutside: false,
                    confirmButtonText: 'Enviar <i class="fas fa-paper-plane"></i>',
                    html: `Por favor cargue el archivo XML <strong>Attacheddoment</strong> que recibio por correo. <br>
                    <input type="file"  name="avatar" accept="xml" class='form-control' id='InputFileXMLRadian' onChange="ValidateXML('InputFileXMLRadian')"> <br>
                    <label>Seleccione el evento</label>
                    <select name="event_select_radian" onchange="EnableTypeReyect('event_select_radian', 'type_reyect_id_xml')"  class="select_search_box form-control" placeholder="Native Select" id="event_select_radian"
                        data-search="true">     
                        <option value="0" selected>Seleccione un evento</option>                   
                        <option value="1" >Acuse de recibo de Factura Electrónica de Venta</option>
                        <option value="3" >Recibo del bien y/o prestación del servicio</option>
                        <option value="2" >Reclamo de la Factura Electrónica de Venta</option>
                        <option value="4">Aceptación expresa</option>
                        <option value="5">Aceptación Tácita</option>
                    </select>
                    
                        <label>Seleccione el motivo de reclamo</label>
                            <select name="type_reyect_id_xml" class="form-control" disabled placeholder="Native Select" id="type_reyect_id_xml"
                                                data-search="true">            
                                                <option value="" >Seleccione un motivo de rechazo</option>                                                            
                                                <option value="1" >Documento con inconsistencias</option>
                                                <option value="3" >Mercancía no entregada parcialmente</option>
                                                <option value="2" >Mercancía no entregada totalmente</option>
                                                <option value="4">Servicio no prestado</option>                
                                            </select>                        
                    `,
                    showCancelButton: true,
                    closeOnClickOutside: false,
                    allowEscapeKey: false,
                    confirmButtonText: 'Enviar <i class="fas fa-paper-plane"></i>',
                    showLoaderOnConfirm: true,
                    preConfirm: async (login) => {
                        const event_id = document.querySelector('#event_select_radian')
                            .value
                        const base64_attacheddocument_name = document.querySelector(
                            '#InputFileXMLRadian').files[0]
                        const base64_attacheddocument = await toBase64(
                            base64_attacheddocument_name)
                        const type_reyect_id = document.querySelector(
                            '#type_reyect_id_xml').value
                        console.log(await base64_attacheddocument)
                        const dataRadian = {
                            url: `https://api.nextpyme.plus/api/ubl2.1/send-event`,
                            method: 'POST',
                            headers: {
                                "Content-Type": "application/json",
                                "Authorization": 'Bearer ' + atob(token),
                                "Accept": "application/json",
                            },
                            typeResponse: 'json',
                            bodyRequest: JSON.stringify({
                                'event_id': event_id,
                                'type_rejection_id': type_reyect_id,
                                'base64_attacheddocument_name': base64_attacheddocument_name
                                    .name,
                                'base64_attacheddocument': (
                                    base64_attacheddocument).slice(21),
                                "resend_consecutive": false,
                                "allow_cash_documents": true,
                                "sendmail": true,
                            }),
                        }
                        const {
                            success,
                            message,
                            errors,
                            ResponseDian
                        } = await RequestComponent(dataRadian)
                        console.log({
                            success
                        }, {
                            message
                        }, {
                            errors
                        }, {
                            ResponseDian
                        })

                        if (errors !== undefined) {
                            return Notifications(null, 'Error al procesar el archivo',
                                'error', true, Object.values(errors), false)
                        } else if (success == false) {
                            return Notifications(null, 'Error al procesar el archivo',
                                'error', true, message, false)
                        }
                        try {

                            const StatusDescription = ResponseDian['Envelope'][
                                ['Body']
                            ]['SendEventUpdateStatusResponse'][
                                'SendEventUpdateStatusResult'
                            ][
                                'StatusDescription'
                            ]
                            const StatusMessage = ResponseDian['Envelope'][
                                ['Body']
                            ]['SendEventUpdateStatusResponse'][
                                'SendEventUpdateStatusResult'
                            ]['StatusMessage']
                            if (StatusDescription ==
                                "Documento con errores en campos mandatorios." ||
                                StatusMessage ==
                                "Validación contiene errores en campos mandatorios."
                            ) {
                                const ErrorsList = ResponseDian['Envelope'][
                                    'Body'
                                ][
                                    'SendEventUpdateStatusResponse'
                                ]['SendEventUpdateStatusResult'][
                                    'ErrorMessage'
                                ]['string']
                                return Notifications(null, ErrorsList, 'error',
                                    StatusMessage, true, false)
                            }
                            switch (parseInt(event_id)) {
                                case 1:
                                    Notifications(null, StatusMessage, 'success', false,
                                        StatusDescription, false);
                                    SearchDocuments({
                                        table: 'DocumentsTableApi',
                                        fields: null,
                                        typedocument: 'Received',
                                        filter: false
                                    })
                                    break
                                case 2:
                                    Notifications(null, StatusMessage, 'success',
                                        false, StatusDescription, false);
                                    SearchDocuments({
                                        table: 'DocumentsTableApi',
                                        fields: null,
                                        typedocument: 'Received',
                                        filter: false
                                    })
                                    break
                                case 3:
                                    Notifications(null, StatusMessage, 'success',
                                        false, StatusDescription, false);
                                    SearchDocuments({
                                        table: 'DocumentsTableApi',
                                        fields: null,
                                        typedocument: 'Received',
                                        filter: false
                                    })
                                    break
                                case 4:
                                    Notifications(null, StatusMessage, 'success',
                                        false, StatusDescription, false);
                                    SearchDocuments({
                                        table: 'DocumentsTableApi',
                                        fields: null,
                                        typedocument: 'Received',
                                        filter: false
                                    })
                                    break
                            }
                        } catch (error) {
                            Notifications(null, 'No fue posible leer la respuesta :' +
                                error['message'], 'error', true,
                                'Respuesta Eventos', false)
                        }

                    },
                    allowOutsideClick: false
                })
            } else if (result.isDenied) {
                Swal.fire({
                    // title: 'Seleccione el archivo!',
                    confirmButtonText: 'Enviar <i class="fas fa-paper-plane"></i>',
                    width: 750,
                    allowEscapeKey: false,
                    closeOnClickOutside: false,
                    padding: '3em',
                    html: `<div class="container"><div class="row">
                            <div class="col-auto mb-2"><span class="mb-2">Ingrese los datos para cargar el evento RADIAN de su compra</span></div>                            
                            <div class="col-md-12 mb-2"><label class="control-label">CUFE de Factura</label><input type="text" class="form-control" max="96" placeholder="CUFE de la factura" id="document_reference_cufe"></div>                            
                            <div class="col-md-6"><label>Seleccione el evento</label>
                            <select name="event_select_radian_data" onchange="EnableTypeReyect('event_select_radian_data','type_reyect_id_no_xml')" class="form-control" placeholder="Native Select" id="event_select_radian_data"
                                data-search="true">                        
                                <option value="0" selected>Seleccione un evento</option>
                                <option value="1" >Acuse de recibo de Factura Electrónica de Venta</option>
                                <option value="3" >Recibo del bien y/o prestación del servicio</option>
                                <option value="2" >Reclamo de la Factura Electrónica de Venta</option>
                                <option value="4">Aceptación expresa</option>
                                <option value="5">Aceptación Tácita</option>
                            </select>
                           
                    </div>
                    <div class="col-md-6">
                        <label>Seleccione el motivo de reclamo</label>
                            <select name="type_reyect_id_no_xml" class="form-control" disabled placeholder="Native Select" id="type_reyect_id_no_xml"                                                >                                                                        
                                <option value="" >Seleccione un motivo de rechazo</option>
                                                <option value="1" >Documento con inconsistencias</option>
                                                <option value="3" >Mercancía no entregada parcialmente</option>
                                                <option value="2" >Mercancía no entregada totalmente</option>
                                                <option value="4">Servicio no prestado</option>                
                                            </select>
                        </div>
                        </div>
                    </div>`,
                    showCancelButton: true,
                    confirmButtonText: 'Enviar <i class="fas fa-paper-plane"></i>',
                    showLoaderOnConfirm: true,
                    preConfirm: async (login) => {
                        const event_id = document.querySelector(
                            '#event_select_radian_data').value
                        const document_reference_cufe = document.querySelector(
                            '#document_reference_cufe').value
                        const event_select_radian_data = document.querySelector(
                            '#event_select_radian_data').value
                        const type_reyect_id = document.querySelector(
                            '#type_reyect_id_no_xml').value
                        const dataRadian = {
                            url: `https://api.nextpyme.plus/api/ubl2.1/send-event-data`,
                            method: 'POST',
                            headers: {
                                "Content-Type": "application/json",
                                "Authorization": 'Bearer ' + atob(token),
                                "Accept": "application/json",
                            },
                            typeResponse: 'json',
                            bodyRequest: JSON.stringify({
                                "event_id": event_id,
                                "type_rejection_id": type_reyect_id,
                                "document_reference": {
                                    "cufe": document_reference_cufe,
                                },
                                "resend_consecutive": false,
                                "allow_cash_documents": true,
                                "sendmail": true,
                            }),
                        }
                        //  return console.log({dataRadian})
                        const {
                            success,
                            message,
                            errors,
                            ResponseDian
                        } = await RequestComponent(dataRadian)

                        ResponseRadian(event_id, success, message, ResponseDian, errors)
                    },
                    allowOutsideClick: false
                })
            }
        })
    }
    const ResendEvent = async (event_id, request_api) => {
        console.log(window.atob(request_api))
        let json_request = JSON.parse(window.atob(request_api))
        json_request['event_id'] = event_id
        let url = null
        if (json_request.hasOwnProperty('document_reference')) {
            url = `https://api.nextpyme.plus/api/ubl2.1/send-event-data`
        } else {
            url = `https://api.nextpyme.plus/api/ubl2.1/send-event`
        }

        const dataRadianResend = {
            url: url,
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Authorization": 'Bearer ' + atob(token),
                "Accept": "application/json",
            },
            typeResponse: 'json',
            bodyRequest: JSON.stringify(json_request),
        }
        const {
            success,
            message,
            errors,
            ResponseDian
        } = await RequestComponent(dataRadianResend)

        ResponseRadian(event_id, success, message, ResponseDian, errors)


    }
    const EnableTypeReyect = (id, select) => {
        const select_type_reyect = document.getElementById(id)
        const select_reyect = document.getElementById(select)
        // console.log(select_type_reyect, {select_reyect}, select_type_reyect.value)
        if (select_type_reyect.value == 2) {
            // console.log("fui i2")
            select_reyect.removeAttribute('disabled');
        } else {
            select_reyect.setAttribute('disabled', true);
            select_reyect.value = null
        }
    }
    const ReyectDocumentButton = async (EventId, DataReyect) => {
        console.log(window.atob(DataReyect), {
            EventId
        })
        let json_request = JSON.parse(window.atob(DataReyect))
        json_request['event_id'] = EventId
        let url = null
        if (json_request.hasOwnProperty('document_reference')) {
            url = `https://api.nextpyme.plus/api/ubl2.1/send-event-data`
        } else {
            url = `https://api.nextpyme.plus/api/ubl2.1/send-event`
        }

        const {
            value: formValues
        } = await Swal.fire({
            title: 'Por favor seleccione el motivo de rechazo del documento ',
            html: `
            <label>Seleccione el motivo de reclamo</label>
                            <select name="type_reyect_button" class="form-control" placeholder="Native Select" id="type_reyect_button"
                                                data-search="true">            
                                                <option value="" >Seleccione un motivo de rechazo</option>                                                            
                                                <option value="1" >Documento con inconsistencias</option>
                                                <option value="3" >Mercancía no entregada parcialmente</option>
                                                <option value="2" >Mercancía no entregada totalmente</option>
                                                <option value="4">Servicio no prestado</option>                
                                            </select> `,
            focusConfirm: false,
            showLoaderOnConfirm: true,
            showCancelButton: true,
            allowOutsideClick: false,
            preConfirm: async () => {
                console.log(json_request)
                const type_reyect_button = document.querySelector("#type_reyect_button").value
                json_request['type_rejection_id'] = type_reyect_button

                const dataReyectButton = {
                    url: url,
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": 'Bearer ' + atob(token),
                        "Accept": "application/json",
                    },
                    typeResponse: 'json',
                    bodyRequest: JSON.stringify(json_request),
                }

                const {
                    success,
                    message,
                    errors,
                    ResponseDian
                } = await RequestComponent(dataReyectButton)
                console.log({
                    ResponseDian
                })
                ResponseRadian(EventId, success, message, ResponseDian, errors)
            }
        })
    }
    const ResponseRadian = async (event_id, success, message, ResponseDian, errors) => {
        if (errors !== undefined) {
            return Notifications(null, 'Error al procesar el archivo',
                'error', true, Object.values(errors), false)
        } else if (success == false) {
            return Notifications(null, 'Error al procesar el archivo',
                'error', true, message, false)
        }
        try {

            const StatusDescription = ResponseDian['Envelope'][
                ['Body']
            ]['SendEventUpdateStatusResponse'][
                'SendEventUpdateStatusResult'
            ][
                'StatusDescription'
            ]
            const StatusMessage = ResponseDian['Envelope'][
                ['Body']
            ]['SendEventUpdateStatusResponse'][
                'SendEventUpdateStatusResult'
            ]['StatusMessage']
            if (StatusDescription ==
                "Documento con errores en campos mandatorios." ||
                StatusMessage ==
                "Validación contiene errores en campos mandatorios."
            ) {
                const ErrorsList = ResponseDian['Envelope'][
                    'Body'
                ][
                    'SendEventUpdateStatusResponse'
                ]['SendEventUpdateStatusResult'][
                    'ErrorMessage'
                ]['string']
                return Notifications(null, StatusMessage, 'error', true, ErrorsList,
                    false)
            }
            switch (parseInt(event_id)) {
                case 1:
                    Notifications(null, StatusMessage, 'success',
                        false, StatusDescription, false);
                    SearchDocuments({
                        table: 'DocumentsTableApi',
                        fields: null,
                        typedocument: 'Received',
                        filter: false
                    })
                    break
                case 2:
                    Notifications(null, StatusMessage, 'success',
                        false, StatusDescription, false);
                    SearchDocuments({
                        table: 'DocumentsTableApi',
                        fields: null,
                        typedocument: 'Received',
                        filter: false
                    })
                    break
                case 3:
                    Notifications(null, StatusMessage, 'success',
                        false, StatusDescription, false);
                    SearchDocuments({
                        table: 'DocumentsTableApi',
                        fields: null,
                        typedocument: 'Received',
                        filter: false
                    })
                    break
                case 4:
                    Notifications(null, StatusMessage, 'success',
                        false, StatusDescription, false);
                    SearchDocuments({
                        table: 'DocumentsTableApi',
                        fields: null,
                        typedocument: 'Received',
                        filter: false
                    })
                    break
            }
        } catch (error) {
            Notifications(null, 'No fue posible leer la respuesta :' +
                error['message'], 'error', true,
                'Respuesta Eventos', false)
        }
    }
    const DownloadEVS = async (prefix, number, customer) => {
        let new_prefix;
        if (prefix == null || prefix == undefined) {
            new_prefix = ""
        } else {
            new_prefix = prefix
        }
        const {
            value: formValues
        } = await Swal.fire({
            title: 'Seleccione el archivo a descargar!',
            html: `
            <label>Seleccione el motivo de reclamo</label>
                            <select name="type_evs_file" class="form-control" placeholder="Native Select" id="type_evs_file"
                                                data-search="true">                                                                                                                     
                                                <option value="030" >XML - EVS030 - Acuse de recibo de Factura Electrónica de Venta</option>
                                                <option value="031" >XML - EVS031 - Reclamo de la Factura Electrónica de Venta</option>
                                                <option value="032" >XML - EVS032 - Recibo del bien y/o prestación del servicio</option>
                                                <option value="033" >XML - EVS033 - Aceptación expresa de la Factura Electrónica de Venta</option>                                                                                            
                                            </select> `,
            focusConfirm: false,
            showLoaderOnConfirm: true,
            showCancelButton: true,
            allowOutsideClick: false,
            preConfirm: async () => {
                console.log(prefix, number)
                const EVS = document.getElementById('type_evs_file').value
                url =
                    `https://api.nextpyme.plus/api/ubl2.1/download/${customer}/EVS-${EVS}-${customer}-${new_prefix}-${number}.xml`
                const dataEVSFile = {
                    url: url,
                    method: 'GET',
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": 'Bearer ' + atob(token),
                        "Accept": "application/json",
                    },
                    typeResponse: 'blob',
                    // bodyRequest: JSON.stringify(json_request),
                }

                const EVSFile = await RequestComponent(dataEVSFile)
                console.log(EVSFile)
                const typeFile = typeof EVSFile
                if (typeFile == "object") {
                    var blob = new Blob([EVSFile], {
                        type: EVSFile['type'],
                    });
                    var url = URL.createObjectURL(blob);
                    window.open(url);
                    return;
                }
                return ToastR({
                    message: '¡No fue posible realizar la descarga!',
                    icon: 'error'
                })
            }
        })
    }
    const getResolutions = async () => {
        ToastR({
            message: 'Consultando prefijos, espere...',
            icon: 'info'
        })
        const prefix_search = document.querySelector('#prefix_search')
        const dataGetResolution = {
            url: 'https://api.nextpyme.plus/api/ubl2.1/reports/resolutions',
            method: 'GET',
            headers: {
                "Content-Type": "application/json",
                "Authorization": 'Bearer ' + atob(token),
                "Accept": "application/json",
            },
            typeResponse: 'json',
            bodyRequest: null,
        }
        const {
            data,
            message,
            success,
            errors,
            ResponseDian
        } = await RequestComponent(dataGetResolution)
        if (success == true) {
            const optionsSelectResolutions = []
            data.forEach(element => {
                optionsSelectResolutions.push({
                    label: `${element['prefix']}`,
                    value: `${element['prefix']}`
                })
            });
            prefix_search.setOptions(optionsSelectResolutions);

            return ToastR({
                message,
                icon: 'success'
            })
        }
        if (success == false) return ToastR({
            message,
            icon: 'error'
        })
        if (errors !== undefined) return Notifications(null, message, 'error', false, Object.values(errors))
    }
    const ErrorDetails = async (identification_number, type_document_id, prefix, number) => {
        console.log({
            identification_number
        }, {
            number
        }, {
            type_document_id
        }, {
            prefix
        })
        let full_number
        let system_prefix = 'Rpta'
        if (parseInt(type_document_id) == 1) system_prefix = system_prefix + 'FE'
        if (parseInt(type_document_id) == 4) system_prefix = system_prefix + 'NC'
        if (parseInt(type_document_id) == 5) system_prefix = system_prefix + 'ND'
        if (parseInt(type_document_id) == 9) system_prefix = system_prefix + 'NI'
        if (parseInt(type_document_id) == 10) system_prefix = system_prefix + 'NA'
        if (parseInt(type_document_id) == 11) system_prefix = system_prefix + 'DS'
        if (parseInt(type_document_id) == 13) system_prefix = system_prefix + 'NDS'

        if (prefix == null || prefix == "null") {

            full_number = number
        } else {
            full_number = prefix + number
        }
        const ul_reyect_erros = document.querySelector("#ul_reyect_erros")
        ul_reyect_erros.style = "text-decoration:none !important; font-size:12px"
        ul_reyect_erros.innerHTML  = ""
        const RequestStatusDocuments = {
            url: `https://api.nextpyme.plus/api/ubl2.1/download/${identification_number}/${system_prefix}-${full_number}.xml`,
            method: 'GET',
            bodyRequest: null,
            headers: {
                "Content-Type": "application/json",
                "Authorization": 'Bearer 3fcd8364af60e73a8cbca99ea3cf57c279350e108e39d693aa74e9d2a8476918',
                "Accept": "application/json",
            },
            typeResponse: 'text',
        }
        const ResponseStatusDocument = await RequestComponent(RequestStatusDocuments)
        try {
            if (ResponseStatusDocument.includes('success')) {
                return ToastR({
                    message: data['message'],
                    icon: 'warning'
                })
            } else {
                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(ResponseStatusDocument, "text/xml");

                let errors = xmlDoc.getElementsByTagNameNS(
                    "http://schemas.microsoft.com/2003/10/Serialization/Arrays", "string")[0].childNodes
                const ul = document.createElement('ul');
                errors.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = item.data;
                    ul.appendChild(li);
                    if(item.data == "Regla: RUT01, Notificación: La validación del estado del RUT próximamente estará disponible.") return ToastR({message:'El documento fue emitido posterior a este error, consulta la lista de emitidos...', icon:'success'})
                });
                ul_reyect_erros.appendChild(ul)
                $('#reyect_details_documents').modal('show');
            }
        } catch (error) {
            return ToastR({message:'Error al ver las causales, por favor informe al administrador...', icon:'error'})
        }

    }

    getResolutions()

// console.log(templates)