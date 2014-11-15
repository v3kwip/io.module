<?php

namespace Drupal\io\Entity;

use Entity;

class Log extends Entity
{

    public $id;
    public $recipe_id;
    public $status;
    public $error;
    public $output;
    public $runtime;

}
