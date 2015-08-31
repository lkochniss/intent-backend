<?php

namespace AppBundle;

/**
 * Class SimpleXMLExtended
 * @package AppBundle
 */
class SimpleXMLExtended extends \SimpleXMLElement {
    public function addCData($cdata_text) {
        $node = dom_import_simplexml($this);
        $no   = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($cdata_text));
    }
}
