<?php

/*  Texy Web Service
 *  ================
 *
 *  Provides SOAP interface for Texy! syntax convertor.
 *  Author: Aleš Roubíček -rarous- (rarous@seznam.cz)
 *
 */

require_once("texy-min.php");  // knihovna Texy!
require_once("nusoap.php");    // knihovna nuSOAP

$ns = "http://texy.info";      // prostor názvů služby

$server = new soap_server();
$server->configureWSDL('TexyConverter', $ns); // název webové služby
$server->wsdl->schemaTargetNamespace = $ns;

// zveřejnění metody s jejími parametry
$server->register(
    'PrevedDoXhtml',
    array('text' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $ns
);

$server->register(
    'PrevedDoXhtmlR',
    array('text' => 'xsd:string',
        'utf' => 'xsd:boolean',
        'trust' => 'xsd:boolean',
        'headingLevel' => 'xsd:integer'
    ),
    array('return' => 'xsd:string'),
    $ns
);

// funkce pro základní formátování s natvrdo nastavenými vlastnostmi
// input string text – text v Texy! syntaxu
// return string html – vrací XHTML kód
function PrevedDoXhtml($text) {
    $texy = &new Texy();
    $texy->utf = true;
    $texy->trustMode();
    $texy->headingModule->top = 3;
    $html = $texy->process($text);
    return $html;
}

// funkce pro základní formátování s volitelnými vlastnostmi
// input string text – text v Texy! syntaxi
// input boolean utf – má Texy! pracovat s UTF?
// input boolean trust – má Texy! pracovat v důvěryhodném režimu nebo v bezpečném
// input integer headingLevel – nejvyšší úroveň nadpisu
// return string html – vrací XHTML kód
function PrevedDoXhtmlR($text, $utf, $trust, $headingLevel) {
    $texy = &new Texy();
    $texy->utf = $utf;
    if($trust) $texy->trustMode();
    else $texy->safeMode();
    $texy->headingModule->top = $headingLevel;
    $html = $texy->process($text);
    return $html;
}

$server->service($HTTP_RAW_POST_DATA);
?>
