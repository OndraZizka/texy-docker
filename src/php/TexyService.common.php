<?php

require_once("texy.phar");

/**
 * Basic formatting with defaults.
 *
 * input string text - Texy! markup
 * return string html - Resulting XHTML code
 */
function PrevedDoXhtml($text) {
    $texy = new Texy();
    //$texy->utf = true;
    //$texy->trustMode();
    $texy->headingModule->top = 3;
    $texy->imageModule->root  = '';
    $texy->imageModule->linkedRoot  = '';
    $texy->setOutputMode(Texy::XHTML5);
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
    $texy = new Texy();
    $texy->utf = $utf;
    if($trust) $texy->trustMode();
    else $texy->safeMode();
    $texy->headingModule->top = $headingLevel;
    $html = $texy->process($text);
    return $html;
}
