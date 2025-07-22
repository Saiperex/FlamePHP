<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Title extends AbstractTag
{
    public function __construct(string $text)
    {
        parent::__construct('title', [], [$text]);
    }
}
