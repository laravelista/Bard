<?php

namespace Laravelista\Bard\Helpers;

trait Matchers
{
    /**
     * getMatchers() should return an array with keys describing the expectations and values the closures
     * containing the logic of the expectations. The first parameter in the closure is the output
     * of the executed method.
     *
     * @return array
     */
    public function getMatchers()
    {
        return [
            // Checks if the given $result is valid xml
            'beValidXml' => function ($result) {
                if (! simplexml_load_string($result)) {
                    return false;
                }

                return true;
            }
        ];
    }
}
