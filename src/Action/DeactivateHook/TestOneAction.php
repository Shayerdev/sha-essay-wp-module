<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Action\DeactivateHook;

use Shayer\EduEssayPlugin\Action\ActionHookInterface;

class TestOneAction implements ActionHookInterface
{
    /**
     * @return void
     */
    public function run(): void
    {
        echo "Test One Action has been run";
    }
}
