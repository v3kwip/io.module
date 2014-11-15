<?php

namespace Drupal\io\Entity;

use EntityAPIController;

class RecipeTypeController extends EntityAPIController
{

    public function delete($ids, \DatabaseTransaction $transaction = NULL)
    {
        $return = parent::delete($ids, $transaction);

        // @TODO: Delete recipes

        return $return;
    }

}
