<?php

namespace andy87\avito\client\components\data;

use andy87\avito\client\components\base\Params;

/**
 * Class ParamsEmployee
 *
 * @package andy87\avito\client\components\data
 */
abstract class ParamsEmployee extends Params
{
    public array $headers = [ 'X-Is-Employee' => true ];
}