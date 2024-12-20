<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Hooks;

/**
 * ActionHookSubscriberInterface is used by an object that needs to subscribe to
 * WordPress action hooks.
 */
interface ActionHookSubscriberInterface
{
    /**
     * Returns an array of actions that the object needs to be subscribed to.
     *
     * The array key is the name of the action hook. The value can be:
     *
     *  * The method name
     *  * An array with the method name and priority
     *  * An array with the method name, priority and number of accepted arguments
     *
     * For instance:
     *
     *  * array('action_name' => 'method_name')
     *  * array('action_name' => array('method_name', $priority))
     *  * array('action_name' => array('method_name', $priority, $accepted_args))
     *
     * @return array
     */
    public static function getActions(): array;
}
