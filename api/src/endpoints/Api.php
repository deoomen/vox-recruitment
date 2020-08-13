<?php

namespace VOXApi\Endpoints;

abstract class Api
{
    public abstract function getItems(): array;
}
