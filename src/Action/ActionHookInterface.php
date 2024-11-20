<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Action;

interface ActionHookInterface {
    public function run(): void;
}
