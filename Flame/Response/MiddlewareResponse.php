<?php
namespace Flame\Response;

class MiddlewareResponse
{
    public function __construct(
        public bool $success,
        public mixed $data = null
    ) {}
}
