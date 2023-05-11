SELECT
    '1' AS codEmpesa,
    D.ANO,
    a.tipo as tipoDOc, a.numero as numeroDoc, a.fecha, b.detalle,  a.anulado, a.contabilidad,
    '1' AS codEmpesa,
    a.tipo as tipoDOc, a.numero as numeroDoc,
    b.cuenta as codigoPuc,
    '1' as concecutivoDoc,
    a.fecha as fechaDoc,
    b.centro as centroCosto,
    b.tercero as nit,
    '' as dv,
    c.nombres as nombre1,
    c.nombres as nombre2,
    c.apellidos as apellido1,
    c.apellidos as apellido2,
    c.nombreempresa,
    c.departamento,
    c.pais,
    c.direccion,
    c.telefono,
    c.genero,
    '' as referencia,
    E.NOMBRE,
    B.debito, 
    B.CREDITO,
    0 AS CodSubTipoDoc,
    0 as SubNumeroDoc,
    0 as FechaConciliado,
    0 as ValorTotal
FROM
    DOCUMENTO a, COMPROBANTE B, CLIENTE C, periodo d, puc e
WHERE
    a.id = b.documento AND
    B.tercero = C.cedula AND
    A.TIPO = 'FV' AND
    A.fecha  = '05.05.2023' AND
    A.PERIODO = D.ID AND
    B.CUENTA = E.CUENTA
ORDER by
    a.TIPO,
    fecha,
    numero