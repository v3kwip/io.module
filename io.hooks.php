<?php

/**
 * Implements hook_entity_info().
 */
function io_entity_info()
{
    return io()->getHookImplentations()->getHookEntityInfo()->execute();
}

/**
 * Implements hook_user_cancel()
 */
function io_user_cancel($edit, $account, $method)
{
    return io()->getHookImplentations()->getHookUserCancel()->execute($edit, $account, $method);
}

/**
 * Implements hook_cron().
 */
function io_cron()
{
    return io()->getHookImplentations()->getHookCron()->execute();
}

/**
 * Access callback for recipe type entity.
 */
function io_recipe_type_access()
{

}

/**
 * Access callback for recipe entity.
 */
function io_recipe_access_callback()
{

}

/**
 * Access callback for log entity.
 */
function io_log_access_callback()
{

}
