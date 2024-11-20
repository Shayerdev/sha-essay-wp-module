<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Action;

class DeactivateActionRegistrar
{
    public function __construct(
        private readonly string $file,
        private readonly ActionRegistry $actionRegistry,
    ) {
    }

    public function register(): void
    {
        register_deactivation_hook($this->file, [$this->actionRegistry, 'execute']);
    }
}
