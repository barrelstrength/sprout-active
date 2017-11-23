<?php

namespace barrelstrength\sproutactive\services;

use craft\base\Component;

class App extends Component
{
    /**
     * @var Utilities
     */
    public $utilities;

    public function init()
    {
        $this->utilities = new Utilities();
    }
}