<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\ProductType;

use Shayer\EduEssayPlugin\Controller\Rest\RestArgsInterface;
use WP_Error;

class ProductTypeCreateArgs implements RestArgsInterface {
	/**
	 * @return array[]
	 */
	public function validate(): array
	{
		return [];
	}
}
