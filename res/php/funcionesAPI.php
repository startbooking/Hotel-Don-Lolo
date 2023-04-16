<?php 

  function ultimoDia($fecha) { 
    $dia = new Datetime($fecha);
    $month = date('m', $fecha);
    $year  = date('Y', $fecha);
    $day   = date('d', mktime(0,0,0, $month+1, 0, $year));

    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
  };
    
  /** Actual month first day **/
  function primerDia($fecha) {
    $month = date('m',$fecha);
    $year  = date('Y',$fecha);
    return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
  }

  function formHeadXML(){
    $string = "<?xml version='1.0' encoding='UTF-8' standalone='no'?>
      <Invoice 
        xmlns='urn:oasis:names:specification:ubl:schema:xsd:Invoice-2' 
        xmlns:cac='urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2' 
        xmlns:cbc='urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2' 
        xmlns:ds='http://www.w3.org/2000/09/xmldsig#' 
        xmlns:ext='urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2' 
        xmlns:sts='dian:gov:co:facturaelectronica:Structures-2-1' 
        xmlns:xades='http://uri.etsi.org/01903/v1.3.2#' 
        xmlns:xades141='http://uri.etsi.org/01903/v1.4.1#' 
        xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' 
        xsi:schemaLocation='urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd'>";
    return $string;
  }

  function formExtensionXML2($invoiceAuthorization, $startDate, $endDate, $prefix , $from, $to, $identificationCode, $providerID, $softwareID, $softwareSecurityCode, $authorizationProviderID, $QRCode){

    $string = "<ext:UBLExtensions>
        <ext:UBLExtension>
          <ext:ExtensionContent>
            <sts:DianExtensions> 
              <sts:InvoiceControl> 
                <sts:InvoiceAuthorization>$invoiceAuthorization</sts:InvoiceAuthorization> 
                <sts:AuthorizationPeriod> 
                  <cbc:StartDate>$startDate</cbc:StartDate> 
                  <cbc:EndDate>$endDate</cbc:EndDate> 
                </sts:AuthorizationPeriod> 
                <sts:AuthorizedInvoices> 
                  <sts:Prefix>$prefix</sts:Prefix> 
                  <sts:From>$from</sts:From> 
                  <sts:To>$to</sts:To> 
                </sts:AuthorizedInvoices> 
              </sts:InvoiceControl> 
              <sts:InvoiceSource>
                <cbc:IdentificationCode listAgencyID='6' listAgencyName='United Nations Economic Commission for Europe' listSchemeURI='urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.1'>$identificationCode
                </cbc:IdentificationCode> 
              </sts:InvoiceSource> 
              <sts:SoftwareProvider> 
                <sts:ProviderID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='4' schemeName='31'>$providerID
                </sts:ProviderID> 
                <sts:SoftwareID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)'>$softwareID
                </sts:SoftwareID> 
              </sts:SoftwareProvider> 
              <sts:SoftwareSecurityCode schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)'> $softwareSecurityCode 
              </sts:SoftwareSecurityCode> 
              <sts:AuthorizationProvider> 
                <sts:AuthorizationProviderID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='4' schemeName='31'>$authorizationProviderID
                </sts:AuthorizationProviderID> 
              </sts:AuthorizationProvider> 
              <sts:QRCode> $QRCode </sts:QRCode> 
            </sts:DianExtensions> 
          </ext:ExtensionContent>
        </ext:UBLExtension>
     
        <ext:UBLExtension>
           <ext:ExtensionContent>
              <ds:Signature Id='xmldsig-d0322c4f-be87-495a-95d5-9244980495f4'>
                <ds:SignedInfo>
                <ds:CanonicalizationMethod Algorithm='http://www.w3.org/TR/2001/REC-xml-c14n-20010315'/>
                <ds:SignatureMethod Algorithm='http://www.w3.org/2001/04/xmldsig-more#rsa-sha256'/>
                <ds:Reference Id='xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-ref0' URI=''>
                <ds:Transforms>
                <ds:Transform Algorithm='http://www.w3.org/2000/09/xmldsig#enveloped-signature'/>
                </ds:Transforms>
                <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                <ds:DigestValue>akcOQ5qEh4dkMwt0d5BoXRR8Bo4vdy9DBZtfF5O0SsA=</ds:DigestValue>
                </ds:Reference>
                <ds:Reference URI='#xmldsig-87d128b5-aa31-4f0b-8e45-3d9cfa0eec26-keyinfo'>
                <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                <ds:DigestValue>troRYR2fcmJLV6gYibVM6XlArbddSCkjYkACZJP47/4=</ds:DigestValue>
                </ds:Reference>
                <ds:Reference Type='http://uri.etsi.org/01903#SignedProperties' URI='#xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-signedprops'>
                <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                <ds:DigestValue>hpIsyD/08hVUc1exnfEyhGyKX5s3pUPbpMKmPhkPPqU=</ds:DigestValue>
                </ds:Reference>
                </ds:SignedInfo>
                <ds:SignatureValue Id='xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-sigvalue'>
                  q4HWeb47oLdDM4D3YiYDOSXE4YfSHkQKxUfSYiEiPuP2XWvD7ELZTC4ENFv6krgDAXczmi0W7OMi
                  LIVvuFz0ohPUc4KNlUEzqSBHVi6sC34sCqoxuRzOmMEoCB9Tr4VICxU1Ue9XhgP7o6X4f8KFAQWW
                  NaeTtA6WaO/yUtq91MKP59aAnFMfYl8lXpaS0kpUwuui3wdCZsGycsl1prEWiwzpaukEUOXyTo7o
                  RBOuNsDIUhP24Fv1alRFnX6/9zEOpRTs4rEQKN3IQnibF757LE/nnkutElZHTXaSV637gpHjXoUN
                  5JrUwTNOXvmFS98N6DczCQfeNuDIozYwtFVlMw==
                </ds:SignatureValue>
                <ds:KeyInfo Id='xmldsig-87d128b5-aa31-4f0b-8e45-3d9cfa0eec26-keyinfo'>
                  <ds:X509Data>
                     <ds:X509Certificate>
                        MIIIODCCBiCgAwIBAgIIbAsHYmJtoOIwDQYJKoZIhvcNAQELBQAwgbQxIzAhBgkqhkiG9w0BCQEW
                        FGluZm9AYW5kZXNzY2QuY29tLmNvMSMwIQYDVQQDExpDQSBBTkRFUyBTQ0QgUy5BLiBDbGFzZSBJ
                        STEwMC4GA1UECxMnRGl2aXNpb24gZGUgY2VydGlmaWNhY2lvbiBlbnRpZGFkIGZpbmFsMRMwEQYD
                        VQQKEwpBbmRlcyBTQ0QuMRQwEgYDVQQHEwtCb2dvdGEgRC5DLjELMAkGA1UEBhMCQ08wHhcNMTcw
                        OTE2MTM0ODE5WhcNMjAwOTE1MTM0ODE5WjCCARQxHTAbBgNVBAkTFENhbGxlIEZhbHNhIE5vIDEy
                        IDM0MTgwNgYJKoZIhvcNAQkBFilwZXJzb25hX2p1cmlkaWNhX3BydWViYXMxQGFuZGVzc2NkLmNv
                        bS5jbzEsMCoGA1UEAxMjVXN1YXJpbyBkZSBQcnVlYmFzIFBlcnNvbmEgSnVyaWRpY2ExETAPBgNV
                        BAUTCDExMTExMTExMRkwFwYDVQQMExBQZXJzb25hIEp1cmlkaWNhMSgwJgYDVQQLEx9DZXJ0aWZp
                        Y2FkbyBkZSBQZXJzb25hIEp1cmlkaWNhMQ8wDQYDVQQHEwZCb2dvdGExFTATBgNVBAgTDEN1bmRp
                        bmFtYXJjYTELMAkGA1UEBhMCQ08wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQC0Dn8t
                        oZ2CXun+63zwYecJ7vNmEmS+YouH985xDek7ImeE9lMBHXE1M5KDo7iT/tUrcFwKj717PeVL52Nt
                        B6WU4+KBt+nrK+R+OSTpTno5EvpzfIoS9pLI74hHc017rY0wqjl0lw+8m7fyLfi/JO7AtX/dthS+
                        MKHIcZ1STPlkcHqmbQO6nhhr/CGl+tKkCMrgfEFIm1kv3bdWqk3qHrnFJ6s2GoVNZVCTZW/mOzPC
                        NnnUW12LDd/Kd+MjN6aWbP0D/IJbB42Npqv8+/oIwgCrbt0sS1bysUgdT4im9bBhb00MWVmNRBBe
                        3pH5knzkBid0T7TZsPCyiMBstiLT3yfpAgMBAAGjggLpMIIC5TAMBgNVHRMBAf8EAjAAMB8GA1Ud
                        IwQYMBaAFKhLtPQLp7Zb1KAohRCdBBMzxKf3MDcGCCsGAQUFBwEBBCswKTAnBggrBgEFBQcwAYYb
                        aHR0cDovL29jc3AuYW5kZXNzY2QuY29tLmNvMIIB4wYDVR0gBIIB2jCCAdYwggHSBg0rBgEEAYH0
                        SAECCQIFMIIBvzBBBggrBgEFBQcCARY1aHR0cDovL3d3dy5hbmRlc3NjZC5jb20uY28vZG9jcy9E
                        UENfQW5kZXNTQ0RfVjIuNS5wZGYwggF4BggrBgEFBQcCAjCCAWoeggFmAEwAYQAgAHUAdABpAGwA
                        aQB6AGEAYwBpAPMAbgAgAGQAZQAgAGUAcwB0AGUAIABjAGUAcgB0AGkAZgBpAGMAYQBkAG8AIABl
                        AHMAdADhACAAcwB1AGoAZQB0AGEAIABhACAAbABhAHMAIABQAG8AbADtAHQAaQBjAGEAcwAgAGQA
                        ZQAgAEMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAGQAZQAgAFAAZQByAHMAbwBuAGEAIABKAHUAcgDt
                        AGQAaQBjAGEAIAAoAFAAQwApACAAeQAgAEQAZQBjAGwAYQByAGEAYwBpAPMAbgAgAGQAZQAgAFAA
                        cgDhAGMAdABpAGMAYQBzACAAZABlACAAQwBlAHIAdABpAGYAaQBjAGEAYwBpAPMAbgAgACgARABQ
                        AEMAKQAgAGUAcwB0AGEAYgBsAGUAYwBpAGQAYQBzACAAcABvAHIAIABBAG4AZABlAHMAIABTAEMA
                        RDAdBgNVHSUEFjAUBggrBgEFBQcDAgYIKwYBBQUHAwQwRgYDVR0fBD8wPTA7oDmgN4Y1aHR0cDov
                        L3d3dy5hbmRlc3NjZC5jb20uY28vaW5jbHVkZXMvZ2V0Q2VydC5waHA/Y3JsPTEwHQYDVR0OBBYE
                        FL9BXJHmFVE5c5Ai8B1bVBWqXsj7MA4GA1UdDwEB/wQEAwIE8DANBgkqhkiG9w0BAQsFAAOCAgEA
                        b/pa7yerHOu1futRt8QTUVcxCAtK9Q00u7p4a5hp2fVzVrhVQIT7Ey0kcpMbZVPgU9X2mTHGfPdb
                        R0hYJGEKAxiRKsmAwmtSQgWh5smEwFxG0TD1chmeq6y0GcY0lkNA1DpHRhSK368vZlO1p2a6S13Y
                        1j3tLFLqf5TLHzRgl15cfauVinEHGKU/cMkjLwxNyG1KG/FhCeCCmawATXWLgQn4PGgvKcNrz+y0
                        cwldDXLGKqriw9dce2Zerc7OCG4/XGjJ2PyZOJK9j1VYIG4pnmoirVmZbKwWaP4/TzLs6LKaJ4b6
                        6xLxH3hUtoXCzYQ5ehYyrLVwCwTmKcm4alrEht3FVWiWXA/2tj4HZiFoG+I1OHKmgkNv7SwHS7z9
                        tFEFRaD3W3aD7vwHEVsq2jTeYInE0+7r2/xYFZ9biLBrryl+q22zM5W/EJq6EJPQ6SM/eLqkpzqM
                        EF5OdcJ5kIOxLbrIdOh0+grU2IrmHXr7cWNP6MScSL7KSxhjPJ20F6eqkO1Z/LAxqNslBIKkYS24
                        VxPbXu0pBXQvu+zAwD4SvQntIG45y/67h884I/tzYOEJi7f6/NFAEuV+lokw/1MoVsEgFESASI9s
                        N0DfUniabyrZ3nX+LG3UFL1VDtDPWrLTNKtb4wkKwGVwqtAdGFcE+/r/1WG0eQ64xCq0NLutCxg=
                     </ds:X509Certificate>
                  </ds:X509Data>
                </ds:KeyInfo>
                <ds:Object>
                  <xades:QualifyingProperties Target='#xmldsig-d0322c4f-be87-495a-95d5-9244980495f4'>
                    <xades:SignedProperties Id='xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-signedprops'>
                      <xades:SignedSignatureProperties>
                         <xades:SigningTime>2019-06-21T19:09:35.993-05:00</xades:SigningTime>
                         <xades:SigningCertificate>
                            <xades:Cert>
                               <xades:CertDigest>
                                  <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                                  <ds:DigestValue>nem6KXhqlV0A0FK5o+MwJZ3Y1aHgmL1hDs/RMJu7HYw=</ds:DigestValue>
                               </xades:CertDigest>
                               <xades:IssuerSerial>
                                  <ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD.,OU=Division de certificacion entidad final,CN=CA ANDES SCD S.A. Clase II,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
                                  <ds:X509SerialNumber>7785324499979575522</ds:X509SerialNumber>
                               </xades:IssuerSerial>
                            </xades:Cert>
                            <xades:Cert>
                               <xades:CertDigest>
                                  <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                                  <ds:DigestValue>oEsyOEeUGTXr45Jr0jHJx3l/9CxcsxPMOTarEiXOclY=</ds:DigestValue>
                               </xades:CertDigest>
                               <xades:IssuerSerial>
                                  <ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
                                  <ds:X509SerialNumber>8136867327090815624</ds:X509SerialNumber>
                               </xades:IssuerSerial>
                            </xades:Cert>
                            <xades:Cert>
                               <xades:CertDigest>
                                  <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                                  <ds:DigestValue>Cs7emRwtXWVYHJrqS9eXEXfUcFyJJBqFhDFOetHu8ts=</ds:DigestValue>
                               </xades:CertDigest>
                               <xades:IssuerSerial>
                                  <ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
                                  <ds:X509SerialNumber>3184328748892787122</ds:X509SerialNumber>
                               </xades:IssuerSerial>
                            </xades:Cert>
                         </xades:SigningCertificate>
                         <xades:SignaturePolicyIdentifier>
                            <xades:SignaturePolicyId>
                               <xades:SigPolicyId>
                                  <xades:Identifier>https://facturaelectronica.dian.gov.co/politicadefirma/v1/politicadefirmav2.pdf</xades:Identifier>
                               </xades:SigPolicyId>
                               <xades:SigPolicyHash>
                                  <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                                  <ds:DigestValue>dMoMvtcG5aIzgYo0tIsSQeVJBDnUnfSOfBpxXrmor0Y=</ds:DigestValue>
                               </xades:SigPolicyHash>
                            </xades:SignaturePolicyId>
                         </xades:SignaturePolicyIdentifier>
                         <xades:SignerRole>
                            <xades:ClaimedRoles>
                               <xades:ClaimedRole>supplier</xades:ClaimedRole>
                            </xades:ClaimedRoles>
                         </xades:SignerRole>
                      </xades:SignedSignatureProperties>
                    </xades:SignedProperties>
                  </xades:QualifyingProperties>
                </ds:Object>
              </ds:Signature>
           </ext:ExtensionContent>
        </ext:UBLExtension>
      </ext:UBLExtensions>";
    return $string;

  }

  function formExtensionXML($invoiceAuthorization, $startDate, $endDate, $prefix , $from, $to, $identificationCode, $providerID, $softwareID, $softwareSecurityCode, $authorizationProviderID, $QRCode){
    $string = "
    <ext:UBLExtensions> 
      <ext:UBLExtension> 
        <ext:ExtensionContent> 
          <sts:DianExtensions> 
            <sts:InvoiceControl> 
              <sts:InvoiceAuthorization>$invoiceAuthorization</sts:InvoiceAuthorization> 
              <sts:AuthorizationPeriod> 
                <cbc:StartDate>$startDate</cbc:StartDate> 
                <cbc:EndDate>$endDate</cbc:EndDate> 
              </sts:AuthorizationPeriod> 
              <sts:AuthorizedInvoices> 
                <sts:Prefix>$prefix</sts:Prefix> 
                <sts:From>$from</sts:From> 
                <sts:To>$to</sts:To> 
              </sts:AuthorizedInvoices> 
            </sts:InvoiceControl> 
            <sts:InvoiceSource>
              <cbc:IdentificationCode listAgencyID='6' listAgencyName='United Nations Economic Commission for Europe' listSchemeURI='urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.1'>$identificationCode
              </cbc:IdentificationCode> 
            </sts:InvoiceSource> 
            <sts:SoftwareProvider> 
              <sts:ProviderID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='4' schemeName='31'>$providerID
              </sts:ProviderID> 
              <sts:SoftwareID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)'>$softwareID
              </sts:SoftwareID> 
            </sts:SoftwareProvider> 
            <sts:SoftwareSecurityCode schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)'> $softwareSecurityCode 
            </sts:SoftwareSecurityCode> 
            <sts:AuthorizationProvider> 
              <sts:AuthorizationProviderID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='4' schemeName='31'>$authorizationProviderID
              </sts:AuthorizationProviderID> 
            </sts:AuthorizationProvider> 
            <sts:QRCode> $QRCode </sts:QRCode> 
          </sts:DianExtensions> 
        </ext:ExtensionContent> 
      </ext:UBLExtension>   
      <ext:UBLExtension>
         <ext:ExtensionContent>
            <ds:Signature Id='xmldsig-d0322c4f-be87-495a-95d5-9244980495f4'>
               <ds:SignedInfo>
               <ds:CanonicalizationMethod Algorithm='http://www.w3.org/TR/2001/REC-xml-c14n-20010315'/>
               <ds:SignatureMethod Algorithm='http://www.w3.org/2001/04/xmldsig-more#rsa-sha256'/>
               <ds:Reference Id='xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-ref0' URI=''>
               <ds:Transforms>
               <ds:Transform Algorithm='http://www.w3.org/2000/09/xmldsig#enveloped-signature'/>
               </ds:Transforms>
               <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
               <ds:DigestValue>akcOQ5qEh4dkMwt0d5BoXRR8Bo4vdy9DBZtfF5O0SsA=</ds:DigestValue>
               </ds:Reference>
               <ds:Reference URI='#xmldsig-87d128b5-aa31-4f0b-8e45-3d9cfa0eec26-keyinfo'>
               <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
               <ds:DigestValue>troRYR2fcmJLV6gYibVM6XlArbddSCkjYkACZJP47/4=</ds:DigestValue>
               </ds:Reference>
               <ds:Reference Type='http://uri.etsi.org/01903#SignedProperties' URI='#xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-signedprops'>
               <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
               <ds:DigestValue>hpIsyD/08hVUc1exnfEyhGyKX5s3pUPbpMKmPhkPPqU=</ds:DigestValue>
               </ds:Reference>
               </ds:SignedInfo>
               <ds:SignatureValue Id='xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-sigvalue'>
               q4HWeb47oLdDM4D3YiYDOSXE4YfSHkQKxUfSYiEiPuP2XWvD7ELZTC4ENFv6krgDAXczmi0W7OMi
               LIVvuFz0ohPUc4KNlUEzqSBHVi6sC34sCqoxuRzOmMEoCB9Tr4VICxU1Ue9XhgP7o6X4f8KFAQWW
               NaeTtA6WaO/yUtq91MKP59aAnFMfYl8lXpaS0kpUwuui3wdCZsGycsl1prEWiwzpaukEUOXyTo7o
               RBOuNsDIUhP24Fv1alRFnX6/9zEOpRTs4rEQKN3IQnibF757LE/nnkutElZHTXaSV637gpHjXoUN
               5JrUwTNOXvmFS98N6DczCQfeNuDIozYwtFVlMw==
               </ds:SignatureValue>
               <ds:KeyInfo Id='xmldsig-87d128b5-aa31-4f0b-8e45-3d9cfa0eec26-keyinfo'>
                  <ds:X509Data>
                     <ds:X509Certificate>
                        MIIIODCCBiCgAwIBAgIIbAsHYmJtoOIwDQYJKoZIhvcNAQELBQAwgbQxIzAhBgkqhkiG9w0BCQEW
                        FGluZm9AYW5kZXNzY2QuY29tLmNvMSMwIQYDVQQDExpDQSBBTkRFUyBTQ0QgUy5BLiBDbGFzZSBJ
                        STEwMC4GA1UECxMnRGl2aXNpb24gZGUgY2VydGlmaWNhY2lvbiBlbnRpZGFkIGZpbmFsMRMwEQYD
                        VQQKEwpBbmRlcyBTQ0QuMRQwEgYDVQQHEwtCb2dvdGEgRC5DLjELMAkGA1UEBhMCQ08wHhcNMTcw
                        OTE2MTM0ODE5WhcNMjAwOTE1MTM0ODE5WjCCARQxHTAbBgNVBAkTFENhbGxlIEZhbHNhIE5vIDEy
                        IDM0MTgwNgYJKoZIhvcNAQkBFilwZXJzb25hX2p1cmlkaWNhX3BydWViYXMxQGFuZGVzc2NkLmNv
                        bS5jbzEsMCoGA1UEAxMjVXN1YXJpbyBkZSBQcnVlYmFzIFBlcnNvbmEgSnVyaWRpY2ExETAPBgNV
                        BAUTCDExMTExMTExMRkwFwYDVQQMExBQZXJzb25hIEp1cmlkaWNhMSgwJgYDVQQLEx9DZXJ0aWZp
                        Y2FkbyBkZSBQZXJzb25hIEp1cmlkaWNhMQ8wDQYDVQQHEwZCb2dvdGExFTATBgNVBAgTDEN1bmRp
                        bmFtYXJjYTELMAkGA1UEBhMCQ08wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQC0Dn8t
                        oZ2CXun+63zwYecJ7vNmEmS+YouH985xDek7ImeE9lMBHXE1M5KDo7iT/tUrcFwKj717PeVL52Nt
                        B6WU4+KBt+nrK+R+OSTpTno5EvpzfIoS9pLI74hHc017rY0wqjl0lw+8m7fyLfi/JO7AtX/dthS+
                        MKHIcZ1STPlkcHqmbQO6nhhr/CGl+tKkCMrgfEFIm1kv3bdWqk3qHrnFJ6s2GoVNZVCTZW/mOzPC
                        NnnUW12LDd/Kd+MjN6aWbP0D/IJbB42Npqv8+/oIwgCrbt0sS1bysUgdT4im9bBhb00MWVmNRBBe
                        3pH5knzkBid0T7TZsPCyiMBstiLT3yfpAgMBAAGjggLpMIIC5TAMBgNVHRMBAf8EAjAAMB8GA1Ud
                        IwQYMBaAFKhLtPQLp7Zb1KAohRCdBBMzxKf3MDcGCCsGAQUFBwEBBCswKTAnBggrBgEFBQcwAYYb
                        aHR0cDovL29jc3AuYW5kZXNzY2QuY29tLmNvMIIB4wYDVR0gBIIB2jCCAdYwggHSBg0rBgEEAYH0
                        SAECCQIFMIIBvzBBBggrBgEFBQcCARY1aHR0cDovL3d3dy5hbmRlc3NjZC5jb20uY28vZG9jcy9E
                        UENfQW5kZXNTQ0RfVjIuNS5wZGYwggF4BggrBgEFBQcCAjCCAWoeggFmAEwAYQAgAHUAdABpAGwA
                        aQB6AGEAYwBpAPMAbgAgAGQAZQAgAGUAcwB0AGUAIABjAGUAcgB0AGkAZgBpAGMAYQBkAG8AIABl
                        AHMAdADhACAAcwB1AGoAZQB0AGEAIABhACAAbABhAHMAIABQAG8AbADtAHQAaQBjAGEAcwAgAGQA
                        ZQAgAEMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAGQAZQAgAFAAZQByAHMAbwBuAGEAIABKAHUAcgDt
                        AGQAaQBjAGEAIAAoAFAAQwApACAAeQAgAEQAZQBjAGwAYQByAGEAYwBpAPMAbgAgAGQAZQAgAFAA
                        cgDhAGMAdABpAGMAYQBzACAAZABlACAAQwBlAHIAdABpAGYAaQBjAGEAYwBpAPMAbgAgACgARABQ
                        AEMAKQAgAGUAcwB0AGEAYgBsAGUAYwBpAGQAYQBzACAAcABvAHIAIABBAG4AZABlAHMAIABTAEMA
                        RDAdBgNVHSUEFjAUBggrBgEFBQcDAgYIKwYBBQUHAwQwRgYDVR0fBD8wPTA7oDmgN4Y1aHR0cDov
                        L3d3dy5hbmRlc3NjZC5jb20uY28vaW5jbHVkZXMvZ2V0Q2VydC5waHA/Y3JsPTEwHQYDVR0OBBYE
                        FL9BXJHmFVE5c5Ai8B1bVBWqXsj7MA4GA1UdDwEB/wQEAwIE8DANBgkqhkiG9w0BAQsFAAOCAgEA
                        b/pa7yerHOu1futRt8QTUVcxCAtK9Q00u7p4a5hp2fVzVrhVQIT7Ey0kcpMbZVPgU9X2mTHGfPdb
                        R0hYJGEKAxiRKsmAwmtSQgWh5smEwFxG0TD1chmeq6y0GcY0lkNA1DpHRhSK368vZlO1p2a6S13Y
                        1j3tLFLqf5TLHzRgl15cfauVinEHGKU/cMkjLwxNyG1KG/FhCeCCmawATXWLgQn4PGgvKcNrz+y0
                        cwldDXLGKqriw9dce2Zerc7OCG4/XGjJ2PyZOJK9j1VYIG4pnmoirVmZbKwWaP4/TzLs6LKaJ4b6
                        6xLxH3hUtoXCzYQ5ehYyrLVwCwTmKcm4alrEht3FVWiWXA/2tj4HZiFoG+I1OHKmgkNv7SwHS7z9
                        tFEFRaD3W3aD7vwHEVsq2jTeYInE0+7r2/xYFZ9biLBrryl+q22zM5W/EJq6EJPQ6SM/eLqkpzqM
                        EF5OdcJ5kIOxLbrIdOh0+grU2IrmHXr7cWNP6MScSL7KSxhjPJ20F6eqkO1Z/LAxqNslBIKkYS24
                        VxPbXu0pBXQvu+zAwD4SvQntIG45y/67h884I/tzYOEJi7f6/NFAEuV+lokw/1MoVsEgFESASI9s
                        N0DfUniabyrZ3nX+LG3UFL1VDtDPWrLTNKtb4wkKwGVwqtAdGFcE+/r/1WG0eQ64xCq0NLutCxg=
                     </ds:X509Certificate>
                  </ds:X509Data>
               </ds:KeyInfo>
               <ds:Object>
                  <xades:QualifyingProperties Target='#xmldsig-d0322c4f-be87-495a-95d5-9244980495f4'>
                     <xades:SignedProperties Id='xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-signedprops'>
                        <xades:SignedSignatureProperties>
                           <xades:SigningTime>2019-06-21T19:09:35.993-05:00</xades:SigningTime>
                           <xades:SigningCertificate>
                              <xades:Cert>
                                 <xades:CertDigest>
                                    <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                                    <ds:DigestValue>nem6KXhqlV0A0FK5o+MwJZ3Y1aHgmL1hDs/RMJu7HYw=</ds:DigestValue>
                                 </xades:CertDigest>
                                 <xades:IssuerSerial>
                                    <ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD.,OU=Division de certificacion entidad final,CN=CA ANDES SCD S.A. Clase II,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
                                    <ds:X509SerialNumber>7785324499979575522</ds:X509SerialNumber>
                                 </xades:IssuerSerial>
                              </xades:Cert>
                              <xades:Cert>
                                 <xades:CertDigest>
                                    <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                                    <ds:DigestValue>oEsyOEeUGTXr45Jr0jHJx3l/9CxcsxPMOTarEiXOclY=</ds:DigestValue>
                                 </xades:CertDigest>
                                 <xades:IssuerSerial>
                                    <ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
                                    <ds:X509SerialNumber>8136867327090815624</ds:X509SerialNumber>
                                 </xades:IssuerSerial>
                              </xades:Cert>
                              <xades:Cert>
                                 <xades:CertDigest>
                                    <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                                    <ds:DigestValue>Cs7emRwtXWVYHJrqS9eXEXfUcFyJJBqFhDFOetHu8ts=</ds:DigestValue>
                                 </xades:CertDigest>
                                 <xades:IssuerSerial>
                                    <ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
                                    <ds:X509SerialNumber>3184328748892787122</ds:X509SerialNumber>
                                 </xades:IssuerSerial>
                              </xades:Cert>
                           </xades:SigningCertificate>
                           <xades:SignaturePolicyIdentifier>
                              <xades:SignaturePolicyId>
                                 <xades:SigPolicyId>
                                    <xades:Identifier>https://facturaelectronica.dian.gov.co/politicadefirma/v1/politicadefirmav2.pdf</xades:Identifier>
                                 </xades:SigPolicyId>
                                 <xades:SigPolicyHash>
                                    <ds:DigestMethod Algorithm='http://www.w3.org/2001/04/xmlenc#sha256'/>
                                    <ds:DigestValue>dMoMvtcG5aIzgYo0tIsSQeVJBDnUnfSOfBpxXrmor0Y=</ds:DigestValue>
                                 </xades:SigPolicyHash>
                              </xades:SignaturePolicyId>
                           </xades:SignaturePolicyIdentifier>
                           <xades:SignerRole>
                              <xades:ClaimedRoles>
                                 <xades:ClaimedRole>supplier</xades:ClaimedRole>
                              </xades:ClaimedRoles>
                           </xades:SignerRole>
                        </xades:SignedSignatureProperties>
                     </xades:SignedProperties>
                  </xades:QualifyingProperties>
               </ds:Object>
            </ds:Signature>
         </ext:ExtensionContent>
      </ext:UBLExtension>
    </ext:UBLExtensions>";

    return $string;
  }

  function formVersionXML($customizationID, $profileExecutionID, $current, $UUID, $issueDate, $issueTime, $invoiceTypeCode, $companyNote, $documentCurrencyCode, $lineCountNumeric, $invoiceStartDate, $invoiceEndDate) {
    $string = "  
        <cbc:UBLVersionID>UBL 2.1</cbc:UBLVersionID> <cbc:CustomizationID>$customizationID</cbc:CustomizationID> <cbc:ProfileID>DIAN 2.1</cbc:ProfileID> <cbc:ProfileExecutionID>$profileExecutionID</cbc:ProfileExecutionID> <cbc:ID>$current</cbc:ID> <cbc:UUID schemeID='2' schemeName='CUFE-SHA384'> $UUID </cbc:UUID> <cbc:IssueDate>$issueDate</cbc:IssueDate> <cbc:IssueTime>$issueTime</cbc:IssueTime> <cbc:InvoiceTypeCode>$invoiceTypeCode</cbc:InvoiceTypeCode> <cbc:Note>$companyNote</cbc:Note> <cbc:DocumentCurrencyCode listAgencyID='6' listAgencyName='United Nations Economic Commission for Europe' listID='ISO 4217 Alpha'>$documentCurrencyCode</cbc:DocumentCurrencyCode> <cbc:LineCountNumeric>$lineCountNumeric</cbc:LineCountNumeric> <cac:InvoicePeriod> <cbc:StartDate>$invoiceStartDate</cbc:StartDate> <cbc:EndDate>$invoiceEndDate</cbc:EndDate> </cac:InvoicePeriod> ";

    return $string;
  }

  function formCompanyXML($additionalAccountID, $industryClassificationCode, $companyName, $IDCity, $companyCity, $postalZone, $companyCountry, $IDCountry, $addressLine, $providerID, $taxLevelCode, $tributoID, $tributoName){
    $string = "<cac:AccountingSupplierParty> <cbc:AdditionalAccountID>$additionalAccountID</cbc:AdditionalAccountID> <cac:Party> <cbc:IndustryClassificationCode>$industryClassificationCode</cbc:IndustryClassificationCode> <cac:PartyName> <cbc:Name>$companyName</cbc:Name> </cac:PartyName> <cac:PhysicalLocation> <cac:Address> <cbc:ID>$IDCity</cbc:ID> <cbc:CityName>$companyCity</cbc:CityName> <cbc:PostalZone>$postalZone</cbc:PostalZone> <cbc:CountrySubentity>$companyCountry</cbc:CountrySubentity> <cbc:CountrySubentityCode>$IDCountry</cbc:CountrySubentityCode> <cac:AddressLine> <cbc:Line>$addressLine</cbc:Line> </cac:AddressLine> <cac:Country> <cbc:IdentificationCode>CO</cbc:IdentificationCode> <cbc:Name languageID='es'>Colombia</cbc:Name> </cac:Country> </cac:Address> </cac:PhysicalLocation> <cac:PartyTaxScheme> <cbc:RegistrationName>$companyCity</cbc:RegistrationName> <cbc:CompanyID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='4' schemeName='31'>$providerID</cbc:CompanyID> <cbc:TaxLevelCode listName='05'>$taxLevelCode</cbc:TaxLevelCode> <cac:RegistrationAddress> <cbc:ID>$IDCity</cbc:ID> <cbc:CityName>$companyCity</cbc:CityName> <cbc:PostalZone>$postalZone</cbc:PostalZone> <cbc:CountrySubentity>$companyCountry</cbc:CountrySubentity> <cbc:CountrySubentityCode>$IDCountry</cbc:CountrySubentityCode> <cac:AddressLine> <cbc:Line>$addressLine</cbc:Line> </cac:AddressLine> <cac:Country> <cbc:IdentificationCode>CO</cbc:IdentificationCode> <cbc:Name languageID='es'>Colombia</cbc:Name> </cac:Country> </cac:RegistrationAddress> <cac:TaxScheme> <cbc:ID>$tributoID</cbc:ID> <cbc:Name>$tributoName</cbc:Name> </cac:TaxScheme> </cac:PartyTaxScheme> </cac:Party> </cac:AccountingSupplierParty> ";
      return $string;
  }

  function formBuyerXML($buyerTypeCO , $buyerName , $buyerIDCity , $buyerCity , $buyerCountry , $buyerIDCountry, $buyerAddress, $buyerIDdv, $buyerNit, $taxLevelCode, $buyerMovil, $buyereMail, $buyerTributeCode, $buyerTributename){
    $string = "
    <cac:AccountingCustomerParty> 
      <cbc:AdditionalAccountID>$buyerTypeCO</cbc:AdditionalAccountID> 
      <cac:Party> 
        <cac:PartyName> 
          <cbc:Name>$buyerName</cbc:Name> 
        </cac:PartyName> 
        <cac:PhysicalLocation> 
          <cac:Address> 
            <cbc:ID>$buyerIDCity</cbc:ID> 
            <cbc:CityName>$buyerCity</cbc:CityName> 
            <cbc:CountrySubentity>$buyerCountry</cbc:CountrySubentity> 
            <cbc:CountrySubentityCode>$buyerIDCountry</cbc:CountrySubentityCode> 
            <cac:AddressLine> 
              <cbc:Line>$buyerAddress</cbc:Line> 
            </cac:AddressLine> 
            <cac:Country> 
              <cbc:IdentificationCode>CO</cbc:IdentificationCode> 
              <cbc:Name languageID='es'>Colombia</cbc:Name> 
            </cac:Country> 
          </cac:Address> 
        </cac:PhysicalLocation> 
        <cac:PartyTaxScheme> 
          <cbc:RegistrationName>$buyerName</cbc:RegistrationName> 
          <cbc:CompanyID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='$buyerIDdv' schemeName=''>$buyerNit</cbc:CompanyID> 
          <cbc:TaxLevelCode listName='04'>$taxLevelCode</cbc:TaxLevelCode>         
          <cac:RegistrationAddress>
            <cbc:ID>$buyerIDCity</cbc:ID>
            <cbc:CityName>$buyerCity</cbc:CityName>
            <cbc:CountrySubentity>$buyerCountry</cbc:CountrySubentity>
            <cbc:CountrySubentityCode>$buyerIDCountry</cbc:CountrySubentityCode>
            <cac:AddressLine>
              <cbc:Line>$buyerAddress</cbc:Line>
            </cac:AddressLine>
            <cac:Country>
              <cbc:IdentificationCode>CO</cbc:IdentificationCode>
              <cbc:Name languageID='es'>Colombia</cbc:Name>
            </cac:Country>
          </cac:RegistrationAddress>
          <cac:TaxScheme> 
            <cbc:ID>$buyerTributeCode</cbc:ID> 
            <cbc:Name>$buyerTributename</cbc:Name> 
          </cac:TaxScheme> 
        </cac:PartyTaxScheme> 
        <cac:PartyLegalEntity> 
          <cbc:RegistrationName>$buyerName</cbc:RegistrationName> 
          <cbc:CompanyID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='$buyerIDdv' schemeName='31'>$buyerNit</cbc:CompanyID> 
        </cac:PartyLegalEntity> 
        <cac:Contact> 
            <cbc:Name>$buyerName</cbc:Name> 
            <cbc:Telephone>$buyerMovil</cbc:Telephone> 
            <cbc:ElectronicMail>$buyereMail</cbc:ElectronicMail> 
          </cac:Contact> 
      </cac:Party> 
    </cac:AccountingCustomerParty> ";

    return $string;
  }

  function formTotalXML($paymentMeans, $PaymentMeansCode, $paymentDueDate, $lineExtensionAmount, $taxExclusiveAmount, $taxInclusiveAmount, $prepaidAmount, $payableAmount, $imptos, $totalTax){
    $string = "  
      <cac:PaymentMeans>
        <cbc:ID>$paymentMeans</cbc:ID>
        <cbc:PaymentMeansCode>$PaymentMeansCode</cbc:PaymentMeansCode>
        <cbc:PaymentDueDate>$paymentDueDate</cbc:PaymentDueDate>
      </cac:PaymentMeans>
      ";
      /* Anticipos */ 
      $string .= totalTaxXML($imptos, $totalTax);
      $string .= "
      <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID='COP'>$lineExtensionAmount</cbc:LineExtensionAmount>
        <cbc:TaxExclusiveAmount currencyID='COP'>$taxExclusiveAmount</cbc:TaxExclusiveAmount>
        <cbc:TaxInclusiveAmount currencyID='COP'>$taxInclusiveAmount</cbc:TaxInclusiveAmount>
        <cbc:PrepaidAmount currencyID='COP'>$prepaidAmount</cbc:PrepaidAmount>
        <cbc:PayableAmount currencyID='COP'>$payableAmount</cbc:PayableAmount>
      </cac:LegalMonetaryTotal>
      ";
    return $string;
  }

  function totalTaxXML($imptos, $totalTax){
    $total = 0;
    $string = "
    <cac:TaxTotal>
      <cbc:TaxAmount currencyID='COP'>$totalTax</cbc:TaxAmount>
      ";

    foreach ($imptos as $key => $value) {
      $string .= "
        <cac:TaxSubtotal> 
          <cbc:TaxableAmount currencyID='COP'>".number_format($value['cargos'],2,'.','')."</cbc:TaxableAmount> 
          <cbc:TaxAmount currencyID='COP'>".number_format($value['imptos'],2,'.','')."</cbc:TaxAmount> 
          <cac:TaxCategory> 
            <cbc:Percent>".number_format($value['porcentaje'],2,'.','')."</cbc:Percent> 
            <cac:TaxScheme> 
              <cbc:ID>".$value['identificador']."</cbc:ID> 
              <cbc:Name>".$value['nombre']."</cbc:Name> 
            </cac:TaxScheme> 
          </cac:TaxCategory> 
        </cac:TaxSubtotal>
        " ; 
        $total += $value['imptos'];
    }

    $string .="
    </cac:TaxTotal>
    "; 

    return $string;
  }

  function formLegalMonetary(){
    $string = "
    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID='COP'>12600.06</cbc:LineExtensionAmount>
        <cbc:TaxExclusiveAmount currencyID='COP'>12787.56</cbc:TaxExclusiveAmount>
        <cbc:TaxInclusiveAmount currencyID='COP'>15024.07</cbc:TaxInclusiveAmount>
        <cbc:PrepaidAmount currencyID='COP'>1000.00</cbc:PrepaidAmount>
        <cbc:PayableAmount currencyID='COP'>14024.07</cbc:PayableAmount>
      </cac:LegalMonetaryTotal>
      ";

      return $string;

  } 

  function formLineXML($lines){
    include_once '../res/php/functionsAPI.php'; 
    $userAPI = new UserAPI();

    $string = "";
    foreach ($lines as $key => $value) { 
      $id = $key + 1; 
      $string .= "
      <cac:InvoiceLine>
        <cbc:ID>$id</cbc:ID>
        <cbc:InvoicedQuantity unitCode='EA'>".$value['cant']."</cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID='COP'>".number_format($value['cargos'],2,'.','')."</cbc:LineExtensionAmount>
        <cac:TaxTotal>
          <cbc:TaxAmount currencyID='COP'>".number_format($value['imptos'],2,'.','')."</cbc:TaxAmount>
          <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID='COP'>".number_format($value['base'],2,'.','')."</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID='COP'>".number_format($value['imptos'],2,'.','')."</cbc:TaxAmount>
            <cac:TaxCategory>";
            $desImpto = $userAPI->getinfoImptos($value['codigo_impto']);            
            $string .= "<cbc:Percent>".$desImpto[0]['porcentaje']."</cbc:Percent>
              <cac:TaxScheme>
                <cbc:ID>".$desImpto[0]['identificador']."</cbc:ID>
                <cbc:Name>".$desImpto[0]['nombre']."</cbc:Name>
              </cac:TaxScheme>
              ";
            $string .= "
            </cac:TaxCategory>
          </cac:TaxSubtotal>
        </cac:TaxTotal>
        <cac:Item>
           <cbc:Description>".$value['descripcion_cargo']."</cbc:Description>
           <cac:SellersItemIdentification>
              <cbc:ID>".$value['id_codigo_cargo']."</cbc:ID>
           </cac:SellersItemIdentification>
        </cac:Item>
        <cac:Price>
           <cbc:PriceAmount currencyID='COP'>".number_format($value['cargos'],2,'.','')."</cbc:PriceAmount>
           <cbc:BaseQuantity unitCode='EA'>".$value['cant']."</cbc:BaseQuantity>
        </cac:Price>
        "; 
        $string = $string."
        </cac:InvoiceLine> ";
    }
    return $string;
  }

  function formFooterXML(){
    return "
    </Invoice>";
  }

  function validateXML($doc){
    libxml_use_internal_errors(true);
    $xml = new DOMDocument();
    $xml->loadXML($doc);
    $rutaValidator = '../apidian/XSD/maindoc/UBL-Invoice-2.1.xsd';

    if($xml->schemaValidate($rutaValidator)){
      echo 'XML Validado ';
    }else{
      getErrors();
      echo 'XML NO Validado ';
    }
  }

  function getErrors(){
    $errors = libxml_get_errors();
    foreach ($errors as $key => $value) {
      echo libxml_display_error($value);
    }
    libxml_clear_errors();
  }

  function libxml_display_error($error){
      $return = "<br/>\n";
      switch ($error->level) {
          case LIBXML_ERR_WARNING:
              $return .= "<b>Warning $error->code</b>: ";
              break;
          case LIBXML_ERR_ERROR:
              $return .= "<b>Error $error->code</b>: ";
              break;
          case LIBXML_ERR_FATAL:
              $return .= "<b>Fatal Error $error->code</b>: ";
              break;
      }
      $return .= trim($error->message);
      
      if ($error->file) {
          $return .=    " in <b>$error->file</b>";
      }
      $return .= " on line <b>$error->line</b>\n\n\n";

      return $return;
  }



?>  
