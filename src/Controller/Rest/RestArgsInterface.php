<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest;

interface RestArgsInterface {
    public function validate(): array;
}
