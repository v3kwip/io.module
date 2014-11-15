<?php

namespace Drupal\io\Entity;

class RecipeController extends \EntityAPIController
{

    /**
     * Execute recipe.
     */
    public function execute()
    {

    }

    public function delete($ids, \DatabaseTransaction $transaction = NULL)
    {
        $return = parent::delete($ids, $transaction);

        // @TODO: Delete logs

        return $return;
    }

}
