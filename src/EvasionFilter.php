<?php

namespace XSSEvasion;

use Exception;
use XSSEvasion\Contracts\FilterInterface;
use XSSEvasion\Exceptions\FilterException;
use XSSEvasion\Strategies\DefaultFilter;

class EvasionFilter
{
    /**
     * @var \XSSEvasion\Contracts\FilterInterface
     */
    protected $strategy;

    /**
     * EvasionFilter constructor.
     * @param \XSSEvasion\Contracts\FilterInterface $strategy
     */
    public function __construct(FilterInterface $strategy = null)
    {
        if(!$strategy) {
            $strategy = new DefaultFilter();
        }

        $this->strategy = $strategy;
    }

    /**
     * @param string $data
     * @return string
     * @throws FilterException
     */
    public function filter($data)
    {
        try {
            return $this->strategy->filter($data);
        } catch (Exception $exception) {
            throw new FilterException($exception->getMessage());
        }
    }
}