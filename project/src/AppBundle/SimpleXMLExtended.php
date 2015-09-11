<?php
/**
 * @package AppBundle
 */

namespace AppBundle;

/**
 * Class SimpleXMLExtended
 */
class SimpleXMLExtended extends \SimpleXMLElement
{
    /**
     * @param String $cDataText Gets the string to enclose in CDATA[].
     * @return null
     */
    public function addCData($cDataText)
    {
        $node = dom_import_simplexml($this);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($cDataText));

        return null;
    }
}
