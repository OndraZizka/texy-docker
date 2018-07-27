<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
/*
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
*/
header('Content-Type: text/xhtml');

if ($_SERVER['REQUEST_METHOD'] != 'POST')
    die('Only HTTP POST is supported.');


// $texyMarkup = stream_get_contents(STDIN); // not available on systems running PHP using CGI
$texyMarkup = file_get_contents('php://input');

require_once "TexyService.common.php";

//$headers = getRequestHeaders();
//$httpHeaders = getallheaders();
$texyOptions = Array();
$texyOptions['topHeadingLevel'] = getHttpHeader('Texy-topHeadingLevel', 2);
$texyOptions['noCodeInPre'] = getHttpHeader('Texy-noCodeInPre', true);


$xhtml = ConvertToHtml($texyMarkup, $texyOptions);

header('Content-Length: ' . strlen($xhtml));
// I almost forgot how dumb PHP is. Strlen returns byte length. mb_strlen() is for the real length.

print $xhtml;
