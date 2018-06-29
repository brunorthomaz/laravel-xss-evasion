<?php

namespace XSSEvasion\Support;

class ListenersSupport
{
    /**
     * @const string
     */
    const LISTENERS_TO_FILTER = 'on.*=\".*\"(?=.*>)';

    /**
     * @return string
     */
    public static function getListenersPattern()
    {
        return sprintf('/%s/isU', self::LISTENERS_TO_FILTER);
    }
}