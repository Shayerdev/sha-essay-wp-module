<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Hooks;

class HookProvider
{
    /**
     * @param array $actionSubscribers
     * @param array $filterSubscribers
     */
    public function __construct(
        private readonly array $actionSubscribers = [],
        private readonly array $filterSubscribers = [],
    ) {
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return array_merge($this->actionSubscribers, $this->filterSubscribers);
    }
}
