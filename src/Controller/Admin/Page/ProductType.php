<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Admin\Page;

class ProductType
{
	/**
	 * Execute
	 *
	 * @return void
	 */
	public function execute(): void
	{
		require_once dirname(__DIR__, 4) . '/templates/admin/productType/view.php';
	}
}