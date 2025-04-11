<!DOCTYPE html>
<html>

<head>
  <title>Visor de Archivos XML</title>
</head>

<body>
  <input type="file" id="fileInput" accept=".xml">
  <button onclick="leerArchivo()">Leer Archivo</button>
  <pre id="resultado"></pre>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <script>
    function leerArchivo() {
      const file = document.getElementById('fileInput').files[0];
      const reader = new FileReader();
      console.log(file);
      var jsonData = $.parseXML(file);
      xmlDoc = $.parseXML( file ),
      $xml = $( xmlDoc ),
      console.log(xmlDoc);
      $title = $xml.find( "cbc:Description" );
      console.log($title);
      // console.log(jsonData);
      reader.onload = function(e) {
        const xmlDoc = new DOMParser().parseFromString(e.target.result, 'text/xml');

        console.log(xmlDoc)

        // Seleccionamos todos los elementos con el nombre "SenderParty"
        const senderParties = xmlDoc.getElementsByTagName("cbc:Description");
        console.log(senderParties);

        // Suponiendo que solo hay un elemento SenderParty, accedemos a su contenido
        /* if (senderParties.length > 0) {
            console.log(senderParties);
            const senderPartyContent = senderParties[0].textContent;
            document.getElementById('resultado').textContent = senderPartyContent;
        } else {
            document.getElementById('resultado').textContent = "No se encontró el elemento AccountingSupplierParty";
        } */

      };

      reader.readAsText(file);
      console.log(file);
    }
  </script>
</body>

</html>