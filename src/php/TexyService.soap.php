<?php

/*  Texy Web Service
 *  ================
 *
 *  Provides SOAP interface for Texy! syntax convertor.
 *  Author: Aleš Roubíček -rarous- (rarous@seznam.cz)
 *
 */

require_once "TexyService.common.php";
require_once("nusoap.php");    // nuSOAP

$namespace = "http://texy.info";

$server = new soap_server();
$server->configureWSDL('TexyConverter', $namespace); // název webové služby
$server->wsdl->schemaTargetNamespace = $namespace;

// Publication of the methods
$server->register(
    'PrevedDoXhtml',
    array('text' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $namespace
);

$server->register(
    'PrevedDoXhtmlR',
    array('text' => 'xsd:string',
        'utf' => 'xsd:boolean',
        'trust' => 'xsd:boolean',
        'headingLevel' => 'xsd:integer'
    ),
    array('return' => 'xsd:string'),
    $namespace
);

$server->service($HTTP_RAW_POST_DATA);
?>
