<?php

namespace Drupal\io;

use Drupal\io\HookImplementation\Implementation;

class IO
{

    private $hookImplentations;

    /**
     * @return \Drupal\io\HookImplementation\Implementation
     */
    public function getHookImplentations()
    {
        if (NULL === $this->hookImplentations) {
            $this->hookImplentations = new Implementation();
        }
        return $this->hookImplentations;
    }

    public function setHookImplentations($hookImplentations)
    {
        $this->hookImplentations = $hookImplentations;
        return $this;
    }

}
