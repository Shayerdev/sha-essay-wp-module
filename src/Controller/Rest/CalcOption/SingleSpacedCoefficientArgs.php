<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\CalcOption;

use Shayer\EduEssayPlugin\Controller\Rest\RestArgsInterface;
use WP_Error;

class SingleSpacedCoefficientArgs implements RestArgsInterface {
	/**
	 * @return array[]
	 */
	public function validate(): array
	{
		return [
			'value' => $this->validatePriceParam()
		];
	}

	/**
	 * @return array
	 */
	private function validatePriceParam(): array
	{
		return [
			'required' => true,
		];
	}
}
