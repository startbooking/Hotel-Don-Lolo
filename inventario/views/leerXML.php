<!DOCTYPE html>
<html>

<head>
    <title>Visor de Archivos XML</title>
</head>

<body>
    <input type="file" id="fileInput" accept=".xml">
    <button onclick="leerArchivo()">Leer Archivo</button>
    <pre id="resultado"></pre>

    <script>
        async function leerArchivo() {
            const file = document.getElementById('fileInput').files[0];
            const reader = new FileReader();
            reader.onload = async function(e) {
                console.log(e)
                const xmlDoc = new DOMParser().parseFromString(e.target.result, 'text/xml');
                const senderParties = xmlDoc.getElementsByTagName("AttachedDocument");
                if (senderParties.length > 0) {
                    const senderPartyContent = senderParties[0].textContent;
                    const senderParty = senderParties[0].childNodes[21]['cac:SenderParty'];
                    const senderParty2 = senderParties[0].childNodes['cac:SenderParty'];
                    /* console.log(senderParties[0].childNodes)
                    console.log(senderParties[0].children) */
                    let proveedor = senderParties[0].children[10].children[0].children;
                    let cliente = senderParties[0].children[11].children[0].children;
                    let xmlProductos = senderParties[0].children[12].children[0].children[2]['textContent'];
                    console.log(xmlProductos);
                    // proveedor = new DOMParser().parseFromString(senderParties[0].children[10],'text/xml')
                    /* let req = {
                        proveedor,
                        cliente,
                        xmlProductos,
                    } */
                    // console.log(xmlProductos)

                    // let productos = await leerProductos(req);

                    // console.log(productos);


                    // const xmlProd = new DOMParser().parseFromString(xmlProductos, 'text/xml');

                    // /* console.log(xmlProd.length) */
                    // console.log(xmlProd)

                    // const listaProd = xmlProd.getElementsByTagName("cac:InvoiceLine");
                    // console.log(listaProd)
                    // const listaProd2 = xmlProd.querySelectorAll("cac:InvoiceLine");
                    // console.log(listaProd2)
                    // document.getElementById('resultado').textContent = senderPartyContent;
                } else {
                    document.getElementById('resultado').textContent = "No se encontró el elemento AttachedDocument";
                }
            };

            reader.readAsText(file);
        }



        async function leerProductos(req){
            let {xmlProductos} = req
            
            console.log(xmlProductos);
            const xmlProd = new DOMParser().parseFromString(xmlProductos, 'text/xml');
            console.log(xmlProd)
            const senderInvoice = xmlProd.getElementsByTagName("Invoice");
            console.log(senderInvoice)

               


        }
    </script>
</body>

</html>