<?php

namespace Drupal\io\Entity;

use Entity;

class Recipe extends Entity
{

    public $id;
    public $type;
    public $status;
    public $summary;
    public $uid;
    public $handler_in;
    public $handler_out;
    public $created;
    public $changed;
    public $rate_limit = 0;
    public $runtime_limit = 0;

}
