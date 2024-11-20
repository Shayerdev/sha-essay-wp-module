<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Hooks;

/**
 * PluginAPIManager handles registering actions and hooks with the
 * WordPress Plugin API.
 */
class HookManager
{
    /**
     * @param HookAdapter $adapter
     */
    public function __construct(
        private readonly HookAdapter $adapter,
    ) {
    }

    /**
     * Registers an object with the WordPress Plugin API.
     *
     * @param mixed $object
     */
    public function register(mixed $object): void
    {
        if ($object instanceof ActionHookSubscriberInterface) {
            $this->registerActions($object);
        }
        if ($object instanceof FilterHookSubscriberInterface) {
            $this->registerFilters($object);
        }
    }

    /**
     * Register an object with a specific action hook.
     *
     * @param ActionHookSubscriberInterface $object
     * @param string $name
     * @param mixed $parameters
     */
    private function registerAction(ActionHookSubscriberInterface $object, string $name, mixed $parameters): void
    {
        $this->adapter->addAction($object, $name, $parameters);
    }

    /**
     * Registers an object with all its action hooks.
     *
     * @param ActionHookSubscriberInterface $object
     */
    private function registerActions(ActionHookSubscriberInterface $object): void
    {
        foreach ($object->getActions() as $name => $parameters) {
            $this->registerAction($object, $name, $parameters);
        }
    }

    /**
     * Register an object with a specific filter hook.
     *
     * @param FilterHookSubscriberInterface $object
     * @param string $name
     * @param mixed $parameters
     */
    private function registerFilter(FilterHookSubscriberInterface $object, string $name, mixed $parameters): void
    {
        $this->adapter->addFilter($object, $name, $parameters);
    }

    /**
     * Registers an object with all its filter hooks.
     *
     * @param FilterHookSubscriberInterface $object
     */
    private function registerFilters(FilterHookSubscriberInterface $object): void
    {
        foreach ($object->getFilters() as $name => $parameters) {
            $this->registerFilter($object, $name, $parameters);
        }
    }
}
