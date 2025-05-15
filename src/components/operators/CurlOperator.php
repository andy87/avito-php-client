<?php

namespace andy87\avito\client\components\operators;

use andy87\avito\client\components\base\Request;
use andy87\avito\client\components\base\Operator;
use andy87\avito\client\components\requests\CurlRequest;

/**
 * Class CurlOperator
 *
 * @package src\components\operators
 */
abstract class CurlOperator extends Operator
{
    public Request|string $classRequest = CurlRequest::class;
}