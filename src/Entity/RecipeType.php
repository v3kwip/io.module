<?php

namespace Drupal\io\Entity;

use Entity;

class RecipeType extends Entity
{

    public $id;
    public $type;
    public $label;
    public $weight;
    public $data;
    public $status;
    public $module;
    public $description;
    public $help;

}
