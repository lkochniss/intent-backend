<?php

namespace AppBundle\DataFixtures\Alice;

/**
 * Class SlugifyProvider
 */
class SlugifyProvider
{
    /**
     * @param String $string
     * @return String $string
     */
    public function slugify($string)
    {
        $string = strtolower($string);

        $string = str_replace('ä', 'ae', $string);
        $string = str_replace('ö', 'oe', $string);
        $string = str_replace('ü', 'ue', $string);
        $string = str_replace('ß', 'ss', $string);
        $string = str_replace('&', 'and', $string);
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);

        return $string;
    }
}
