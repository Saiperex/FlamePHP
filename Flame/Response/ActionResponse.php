<?php

namespace Flame\Response;

class ActionResponse
{
    public function __construct(
        public bool $success,
        public string $target,
        public string $html
    ) {}

    public function toJson(): string
    {
        return json_encode([
            'success' => $this->success,
            'target' => $this->target,
            'html' => $this->html
        ], JSON_UNESCAPED_UNICODE);
    }
}
