<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Action;

use Exception;

class ActionRegistry {
    /**
     * @param ActionHookInterface[] $actionHook
     */
    public function __construct(
        private readonly array $actionHook
    ) {
    }

    /**
     * @return void
     * @throws Exception
     */
    public function execute(): void
    {
        if (empty($this->actionHook)) {
            return;
        }

        foreach ($this->actionHook as $actionHook) {
            if (!$actionHook instanceof ActionHookInterface) {
                throw new Exception('Current object not implemented with ActionHookInterface');
            }

            $actionHook->run();
        }
    }
}
