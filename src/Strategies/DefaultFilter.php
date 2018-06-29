<?php

namespace XSSEvasion\Strategies;

use XSSEvasion\Contracts\FilterInterface;
use XSSEvasion\Exceptions\FilterException;
use XSSEvasion\Support\ListenersSupport;
use XSSEvasion\Support\TagsSupport;

class DefaultFilter implements FilterInterface
{
    /**
     * @param $data
     * @return string
     * @throws \XSSEvasion\Exceptions\FilterException
     */
    public function filter($data)
    {
        if(!is_string($data)) {
            throw new FilterException('The input data must be string');
        }

        $data = $this->filterTags($data);
        $data = $this->filterListeners($data);

        return $data;
    }

    /**
     * @param string $valueToFilter
     * @return mixed|string
     */
    protected function filterTags(string $valueToFilter): string
    {
        preg_match_all(
            TagsSupport::getTagsPattern(),
            $valueToFilter,
            $pregResult
        );

        $matches = array_first($pregResult);
        if(!$matches) {
            $matches = [];
        }

        foreach($matches as $tag) {
            $valueToFilter = str_replace($tag, e($tag), $valueToFilter);
        }

        return $valueToFilter;
    }

    /**
     * @param string $valueToFilter
     * @return string
     */
    protected function filterListeners(string $valueToFilter): string
    {
        preg_replace(
            ListenersSupport::getListenersPattern(),
            '',
            $valueToFilter
        );

        return $valueToFilter;
    }
}