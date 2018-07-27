<?php

require_once("texy.phar");

/**
 * Basic formatting with defaults.
 *
 * input string text - Texy! markup
 * return string html - Resulting XHTML code
 */
function ConvertToHtml($markup, $options) {
    $texy = new Texy();

    //$texy->utf = true;
    //$texy->trustMode();
    $texy->headingModule->top = $options['topHeadingLevel'];
    $texy->headingModule->generateID = true;

    $texy->imageModule->root  = '';
    $texy->imageModule->linkedRoot  = '';

    $texy->setOutputMode(Texy::XHTML5);

    if ($options['noCodeInPre']) {
        $texy->addHandler('block', array('removeCodeFromPre', 'blockHandler'));
    }

    $html = $texy->process($markup);
    return $html;
}



class removeCodeFromPre
{
    /**
     * @param TexyHandlerInvocation  handler invocation
     * @param string  block type
     * @param string  text to highlight
     * @param string  language
     * @param TexyModifier modifier
     * @return TexyHtml
     */
    function blockHandler($invocation, $blocktype, $s, $lang, $modifier)
    {
        if ($blocktype !== 'block/code')
            return $invocation->proceed();

        //$tx = $this->texy;
        $tx = $invocation->getTexy();
        $s = Texy\Texy::outdent($s);
        if ($s === '') {
            return "\n";
        }
        $s = Texy\Texy::escapeHtml($s);
        $s = $tx->protect($s, Texy\Texy::CONTENT_BLOCK);
        $el = Texy\HtmlElement::el('pre');
        $modifier->decorate($tx, $el);
        //$c = $el->create('code', $s);
        $el->setText($s);
        $el->attrs['class'][] = "$lang";
        return $el;
    }
}



/** Fallback if getallheaders() wouldn't work. */
function getRequestHeaders() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}

/**
 * Ivan recommends: Symfony\http-foundation (https://symfony.com/doc/current/components/http_foundation.html) or Nette\Http
 */
function getHttpHeader($nameToFind, $defaultValue = null) {
    $nameToFind = trim($nameToFind);
    /*foreach (getallheaders() as $name => $value) {
        if ($name === $nameToFind)
            return $value;
    }
    return $defaultValue;
    */
    return getallheaders()[$nameToFind] ?: $defaultValue;
}

