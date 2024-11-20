<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service;

interface GetValueServiceInterface
{
	public function getValue(): string|array|int|float;
}
