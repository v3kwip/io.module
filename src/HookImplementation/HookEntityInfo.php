<?php

namespace Drupal\io\HookImplementation;

class HookEntityInfo
{

    /**
     * Get entity informations.
     * @return array
     */
    public function execute()
    {
        return [
            'io_recipe_type' => $this->getRecipeTypeInfo(),
            'io_recipe'      => $this->getRecipeInfo(),
            'io_log'         => $this->getLogInfo(),
        ];
    }

    private function getRecipeTypeInfo()
    {
        return [
            'label'            => t('Recipe type'),
            'plural label'     => t('Recipe types'),
            'description'      => '',
            'entity class'     => 'Drupal\io\Entity\RecipeType',
            'controller class' => 'Drupal\io\Entity\RecipeTypeController',
            'base table'       => 'io_recipe_type',
            'fieldable'        => FALSE,
            'bundle of'        => 'io_recipe',
            'exportable'       => TRUE,
            'entity keys'      => array('id' => 'id', 'name' => 'type', 'label' => 'label'),
            'access callback'  => 'io_recipe_type_access',
            'module'           => 'io',
            'admin ui'         => [
                'path'             => 'admin/structure/io-recipe-types',
                'file'             => 'io.pages.php',
                'controller class' => 'Drupal\io\Entity\RecipeTypeUIController',
            ],
        ];
    }

    private function getRecipeInfo()
    {
        $info = [
            'label'                     => t('Recipe'),
            'description'               => t('Recipe entity'),
            'entity class'              => 'Drupal\io\Entity\Recipe',
            'controller class'          => 'Drupal\io\Entity\RecipeController',
            'metadata controller class' => 'Drupal\io\Entity\RecipeMetadataController',
            'base table'                => 'quiz_entity',
            'revision table'            => 'quiz_entity_revision',
            'fieldable'                 => TRUE,
            'entity keys'               => array('id' => 'id', 'bundle' => 'type', 'label' => 'summary'),
            'bundle keys'               => array('bundle' => 'type'),
            'access callback'           => 'io_recipe_access_callback',
            'label callback'            => 'entity_class_label',
            'uri callback'              => 'entity_class_uri',
            'module'                    => 'io',
            'bundles'                   => array(),
            'admin ui'                  => array(
                'path'             => 'admin/content/io',
                'file'             => 'io.pages.inc',
                'controller class' => 'Drupal\io\Entity\RecipeUIController',
            ),
        ];

        // Add bundle info but bypass entity_load() as we cannot use it here.
        foreach (db_select('io_recipe_type', 'rt')->fields('rt')->execute()->fetchAllAssoc('type') as $type => $info) {
            $info['bundles'][$type] = array(
                'label' => $info->label,
                'admin' => array(
                    'path'             => 'admin/structure/io/manage/%io_recipe_type',
                    'real path'        => 'admin/structure/io/manage/' . $type,
                    'bundle argument'  => 4,
                    'access arguments' => array('administer recipe'),
                ),
            );
        }
        // Support entity cache module.
        if (module_exists('entitycache')) {
            $info['field cache'] = FALSE;
            $info['entity cache'] = TRUE;
        }

        return $info;
    }

    private function getLogInfo()
    {
        return [
            'label'                     => t('Recipe log'),
            'description'               => t('Recipe log entity'),
            'entity class'              => 'Drupal\io\Entity\Log',
            'controller class'          => 'Drupal\io\Entity\LogController',
            'metadata controller class' => 'Drupal\io\Entity\LogMetadataController',
            'base table'                => 'io_log',
            'fieldable'                 => FALSE,
            'entity keys'               => array('id' => 'id'),
            'access callback'           => 'io_log_access_callback',
            'label callback'            => 'entity_class_label',
            'uri callback'              => 'entity_class_uri',
            'module'                    => 'io',
        ];
    }

}
