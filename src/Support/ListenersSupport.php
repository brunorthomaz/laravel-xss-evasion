<?php

namespace XSSEvasion\Support;

class ListenersSupport
{
    /**
     * @const array
     */
    const LISTENERS_TO_FILTER = [
        'on.*=\".*\"(?=.*>)'
    ];

    /**
     * @return string
     */
    public static function getListenersPattern()
    {
        return sprintf('/%s/isU', self::LISTENERS_TO_FILTER);
    }
}