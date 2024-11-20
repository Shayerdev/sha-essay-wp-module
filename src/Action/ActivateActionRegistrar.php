<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Action;

class ActivateActionRegistrar {
    public function __construct(
        private readonly string $file,
        private readonly ActionRegistry $actionRegistry,
    ) {
    }

    public function register(): void
    {
        register_activation_hook($this->file, [$this->actionRegistry, 'execute']);
    }
}
