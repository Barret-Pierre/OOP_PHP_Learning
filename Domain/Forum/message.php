<?php

// ************************************ Header ************************************


declare(strict_types=1);


// ************************************ Class Namespaced ************************************

namespace Domain\Forum;

use Domain\Mixins;

class Message
{
    use Mixins\ContentAware, Mixins\UserAware;
}