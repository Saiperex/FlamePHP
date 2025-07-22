<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;
class Head extends AbstractTag
{
    public function __construct( array $children = [])
    {
        parent::__construct('head', [], $children); 
    }
}