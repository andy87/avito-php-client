<?php

namespace andy87\avito\client\components\interfaces;

interface RequestInterface
{
    public function openConnect();

    public function updateHeaders( array $headers ): void;

    public function call();

    public function closeConnect();

    public function getResponseClass();

    public function getResponse();
}