<?php

namespace Dipesh79\LaravelHelpers\Exception;

use Exception;

class FilterableColumnsNotSpecifiedException extends Exception
{
    /**
     * FilterableColumnsNotSpecifiedException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = 'No filterable columns specified.')
    {
        parent::__construct($message);
    }

}
