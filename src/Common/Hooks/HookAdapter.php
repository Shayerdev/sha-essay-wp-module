<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Hooks;

class HookAdapter
{
    /**
     * @param ActionHookSubscriberInterface $object
     * @param $name
     * @param $parameters
     * @return void
     */
    public function addAction(ActionHookSubscriberInterface $object, $name, $parameters): void
    {
        if (is_string($parameters)) {
            add_action($name, [$object, $parameters]);
        } elseif (is_array($parameters) && isset($parameters[0])) {
            add_action(
                $name,
                [$object, $parameters[0]],
                isset($parameters[1]) ? $parameters[1] : 10,
                isset($parameters[2]) ? $parameters[2] : 1
            );
        }
    }

    /**
     * @param FilterHookSubscriberInterface $object
     * @param string $name
     * @param array $parameters
     * @return void
     */
    public function addFilter(FilterHookSubscriberInterface $object, string $name, array $parameters): void
    {
        if (is_string($parameters)) {
            add_filter($name, [$object, $parameters]);
        } elseif (is_array($parameters) && isset($parameters[0])) {
            add_filter(
                $name,
                [$object, $parameters[0]],
                isset($parameters[1]) ? $parameters[1] : 10,
                isset($parameters[2]) ? $parameters[2] : 1
            );
        }
    }
}
