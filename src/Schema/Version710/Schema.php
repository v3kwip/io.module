<?php

namespace Drupal\io\Schema\Version710;

/**
 * Schema for module version 7.x-1.0
 */
class Schema
{

    public function get()
    {
        return [
            'io_recipe_type' => $this->getRecipeTypeSchema(),
            'io_recipe'      => $this->getRecipeSchema(),
            'io_log'         => $this->getLogSchema(),
        ];
    }

    /**
     * Schema for recipe type table.
     */
    protected function getRecipeTypeSchema()
    {
        return [
            'description' => 'Stores information about all defined recipe types.',
            'fields'      => [
                'id'          => [
                    'type'        => 'serial',
                    'not null'    => TRUE,
                    'description' => 'Primary Key: Unique recipe type ID.'
                ],
                'type'        => [
                    'type'        => 'varchar',
                    'length'      => 32,
                    'not null'    => TRUE,
                    'description' => 'The machine-readable name of this recipe type.'
                ],
                'label'       => [
                    'type'        => 'varchar',
                    'length'      => 255,
                    'not null'    => TRUE,
                    'default'     => '',
                    'description' => 'The human-readable name of this recipe type.'
                ],
                'weight'      => [
                    'type'        => 'int',
                    'not null'    => TRUE,
                    'default'     => 0,
                    'size'        => 'tiny',
                    'description' => 'The weight of this recipe type in relation to others.'
                ],
                'data'        => [
                    'type'        => 'text',
                    'not null'    => FALSE,
                    'size'        => 'big',
                    'serialize'   => TRUE,
                    'description' => 'A serialized array of additional data related to this recipe type.'
                ],
                'status'      => [
                    'type'        => 'int',
                    'not null'    => TRUE,
                    'default'     => 0x01,
                    'size'        => 'tiny',
                    'description' => 'The exportable status of the entity.'
                ],
                'module'      => [
                    'type'        => 'varchar',
                    'length'      => 255,
                    'not null'    => FALSE,
                    'description' => 'The name of the providing module if the entity has been defined in code.'
                ],
                'description' => [
                    'type'         => 'text',
                    'not null'     => FALSE,
                    'size'         => 'medium',
                    'translatable' => TRUE,
                    'description'  => 'A brief description of this recipe type.'
                ],
                'help'        => [
                    'type'         => 'text',
                    'not null'     => FALSE,
                    'size'         => 'medium',
                    'translatable' => TRUE,
                    'description'  => 'Help information shown to the user when creating a recipe entity of this type.'
                ],
            ],
            'primary key' => ['id'],
            'unique keys' => ['type' => ['type']],
        ];
    }

    /**
     * Schema for recipe table.
     *
     * @return array
     */
    protected function getRecipeSchema()
    {
        return [
            'description' => 'Store recipe entities',
            'fields'      => [
                'id'            => [
                    'type'        => 'serial',
                    'not null'    => TRUE,
                    'unsigned'    => TRUE,
                    'description' => 'Primary Key: Unique recipe item ID.'
                ],
                'status'        => [
                    'type'        => 'int',
                    'not null'    => TRUE,
                    'default'     => 1,
                    'description' => 'Boolean indicating whether the recipe is published (visible to non-administrators).'
                ],
                'summary'       => [
                    'type'        => 'varchar',
                    'length'      => 255,
                    'not null'    => TRUE,
                    'default'     => '',
                    'description' => 'The title of the recipe, always treated as non-markup plain text.'
                ],
                'uid'           => [
                    'type'        => 'int',
                    'unsigned'    => TRUE,
                    'not null'    => TRUE,
                    'default'     => 0,
                    'description' => 'Author ID of the recipe.'
                ],
                'handler_in'    => [
                    'type'        => 'varchar',
                    'length'      => 64,
                    'not null'    => TRUE,
                    'default'     => '',
                    'description' => 'Name of input handler.'
                ],
                'handler_out'   => [
                    'type'        => 'varchar',
                    'length'      => 64,
                    'not null'    => TRUE,
                    'default'     => '',
                    'description' => 'Name of output handler.'
                ],
                'created'       => [
                    'type'        => 'int',
                    'not null'    => FALSE,
                    'description' => 'The Unix timestamp when the recipe was created.'
                ],
                'changed'       => [
                    'type'        => 'int',
                    'not null'    => FALSE,
                    'description' => 'The Unix timestamp when the recipe was most recently saved.'
                ],
                'rate_limit'    => [
                    'description' => 'Limit of execution per minutes. 0 is unlimited.',
                    'type'        => 'int',
                    'not null'    => TRUE,
                    'default'     => 0
                ],
                'runtime_limit' => [
                    'description' => 'Maximum seconds per execution. 0 is unlimited.',
                    'type'        => 'int',
                    'not null'    => TRUE,
                    'default'     => 0
                ],
            ],
            'primary key' => ['id'],
            'indexes'     => [
                'author'      => ['uid'],
                'handler_in'  => ['handler_in'],
                'handler_out' => ['handler_out'],
            ],
        ];
    }

    private function getLogSchema()
    {
        return [
            'description' => 'Store log entity, details of recipe execution.',
            'fields'      => [
                'id'        => [
                    'type'        => 'serial',
                    'not null'    => TRUE,
                    'unsigned'    => TRUE,
                    'description' => 'Primary Key: Unique log item ID.',
                ],
                'recipe_id' => [
                    'type'        => 'int',
                    'unsigned'    => TRUE,
                    'not null'    => TRUE,
                    'default'     => 0,
                    'description' => 'Recipe ID of the log item.',
                ],
                'status'    => [
                    'type'        => 'int',
                    'not null'    => TRUE,
                    'default'     => 0x01,
                    'size'        => 'tiny',
                    'description' => 'Status of recipe execution.',
                ],
                'error'     => [
                    'type'        => 'text',
                    'not null'    => FALSE,
                    'size'        => 'medium',
                    'serialize'   => TRUE,
                    'description' => 'Error log',
                ],
                'output'    => [
                    'type'        => 'text',
                    'not null'    => FALSE,
                    'size'        => 'medium',
                    'serialize'   => TRUE,
                    'description' => 'Output log',
                ],
                'runtime'   => [
                    'type'        => 'int',
                    'unsigned'    => TRUE,
                    'not null'    => TRUE,
                    'default'     => 0,
                    'description' => 'Seconds of runtime.',
                ],
            ],
            'primary key' => ['id'],
            'indexes'     => [
                'recipe' => ['recipe_id'],
                'status' => ['status']
            ],
        ];
    }

}
