<?php

namespace XSSEvasion;

use Closure;
use XSSEvasion\EvasionFilter;

class EvasionMiddleware
{
    /**
     * @var  \XSSEvasion\EvasionFilter
     */
    protected $evasionFilter;

    /**
     * EvasionMiddleware constructor.
     * @param \XSSEvasion\EvasionFilter $evasionFilter
     */
    public function __construct(EvasionFilter $evasionFilter)
    {
        $this->evasionFilter = $evasionFilter;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \XSSEvasion\Exceptions\FilterException
     */
    public function handle($request, Closure $next)
    {
        $input = $request->input();

        foreach($input as $key => $value) {
            if(is_string($value)) {
                $input[$key] = $this->evasionFilter->filter($value);
            }
        }

        $request->merge($input);

        return $next($request);
    }
}