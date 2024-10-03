<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>XML Read File</title>
</head>
<body>
  <div id="demo"></div>
  <?php
  $dom = new DOMDocument;
  echo print_r($dom);
  $xml = simplexml_load_file('ad090005923800624003DB940.xml');
  // $oXml = simplexml_load_string('ad090005923800624003DB940.xml');
  $dom->loadXML('ad090005923800624003DB940.xml');
  if (!$dom) {
    echo 'Error al analizar el documento';
    exit;
  }
  $s = simplexml_import_dom($dom);

  echo $s;

/*   $peliculas = new SimpleXMLElement($xmlstr);
  echo $peliculas->pelicula[0]->argumento;
  echo $oXml ; */

  ?>
</body>
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
    $(document).ready(function(){
      // $.get("scripts/archivo.xml",{},function(xml){
      $.get("ad090005923800624003DB940.xml",{},function(xml){
        // alert(xml);
        $('cbc:Description',xml).each(function(i) {
          let no = ((xml.getElementsByTagName('Invoice')[i]).childNodes[0]).nodeValue;
          consle.log(no)
          /* 
          var name = ((xml.getElementsByTagName('d:name')[i]).childNodes[0]).nodeValue;
          var address = ((xml.getElementsByTagName('d:address')[i]).childNodes[0]).nodeValue;
          var city = ((xml.getElementsByTagName('d:city')[i]).childNodes[0]).nodeValue;
          var county = ((xml.getElementsByTagName('d:county')[i]).childNodes[0]).nodeValue;
          var e_mail = ((xml.getElementsByTagName('d:e_mail')[i]).childNodes[0]).nodeValue;
          var school_no = ((xml.getElementsByTagName('d:school_no')[i]).childNodes[0]).nodeValue;
          var school_name = ((xml.getElementsByTagName('d:school_name')[i]).childNodes[0]).nodeValue; 
          $("#demo").append(no + " --- "+name + " --- "+address +" --- " +city +" --- " +county + " --- "+e_mail +" --- " +school_no +" --- "  +school_name);  */
        });
      });
    });
  </script> -->
</html>