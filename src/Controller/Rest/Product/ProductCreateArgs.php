<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\Product;

use Shayer\EduEssayPlugin\Controller\Rest\RestArgsInterface;

class ProductCreateArgs implements RestArgsInterface {
	/**
	 * @return array[]
	 */
	public function validate(): array
	{
		return [];
	}
}
