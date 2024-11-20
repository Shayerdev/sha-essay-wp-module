<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\CalcOption;

use Shayer\EduEssayPlugin\Controller\Rest\RestArgsInterface;
use WP_Error;

class VariationDeadlineArgs implements RestArgsInterface {
	/**
	 * @return array[]
	 */
	public function validate(): array
	{
		return [];
	}
}
