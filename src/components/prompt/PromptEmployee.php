<?php

namespace andy87\avito\client\components\prompt;

use andy87\avito\client\components\base\Prompt;

/**
 * Class ParamsEmployee
 *
 * @package src\components\prompt
 */
abstract class PromptEmployee extends Prompt
{
    public array $headers = [ 'X-Is-Employee' => true ];
}