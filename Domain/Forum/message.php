<?php

// ************************************ Header ************************************


declare(strict_types=1);


// ************************************ Class Namespaced ************************************

namespace Domain\Forum;

use Domain\Display\MessageInterface;
use Domain\Mixins;

class Message implements MessageInterface
{
    use Mixins\ContentAware, Mixins\UserAware;
}