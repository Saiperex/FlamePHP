<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class ReactiveScript extends AbstractTag
{
    public function __construct(?string $customPath = null)
    {
        $domain = rtrim($_ENV['DOMAIN'] ?? '', '/');
        $jsPath = $customPath ?? "$domain/assets/core/FlameReactive.js";

        $scriptContent = <<<JS
import FlameReactive from '$jsPath';
FlameReactive.init();
JS;

        parent::__construct('script', ['type' => 'module'], [$scriptContent]);
    }
}
