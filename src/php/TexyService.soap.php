<?php

/*  Texy Web Service
 *  ================
 *
 *  Provides SOAP interface for Texy! syntax convertor.
 *  Author: Aleš Roubíček -rarous- (rarous@seznam.cz)
 *
 */

require_once("texy.min.php");  // knihovna Texy!
require_once("nusoap.php");    // knihovna nuSOAP

$ns = "http://texy.info";      // prostor názvů služby

$server = new soap_server();
$server->configureWSDL('TexyConverter', $ns); // název webové služby
$server->wsdl->schemaTargetNamespace = $ns;

// Publication of the methods
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

/**
 * Basic formatting with defaults.
 *
 * input string text - Texy! markup
 * return string html - Resulting XHTML code
 */
function PrevedDoXhtml($text) {
    $texy = &new Texy();
    $texy->utf = true;
    $texy->trustMode();
    $texy->headingModule->top = 3;
    $html = $texy->process($text);
    return $html;
}

/**
 * Basic formatting with parameters.
 *
 * input string text - Texy! markup
 * input boolean utf – Should Texy! work in UTF mode?
 * input boolean trust – Should Texy! work in trusted or secure mode?
 * input integer headingLevel – highest heading level to use in resulting XHTML
 * return string html - Resulting XHTML code
 */
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