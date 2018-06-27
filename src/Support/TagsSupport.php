<?php

namespace XSSEvasion\Support;

class TagsSupport
{
    /**
     * @const array
     */
    const TAGS_TO_FILTER = [
        '<script.*script>',
        '<frame.*frame>',
        '<iframe.*iframe>',
        '<object.*object>',
        '<embed.*embed>'
    ];

    /**
     * @return string
     */
    public static function getTagsPattern()
    {
        $allTags = implode('|', self::TAGS_TO_FILTER);
        return sprintf('/(%s)/isU', $allTags);
    }
}