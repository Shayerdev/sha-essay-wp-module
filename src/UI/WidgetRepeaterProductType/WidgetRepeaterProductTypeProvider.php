<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\UI\WidgetRepeaterProductType;

use Shayer\EduEssayPlugin\Common\Hooks\ActionHookSubscriberInterface;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class WidgetRepeaterProductTypeProvider implements ActionHookSubscriberInterface
{
	/**
	 * @param GetValueServiceInterface $extractValueService
	 * @param string $pathEndpoint
	 * @param array $columns
	 * @param string $label
	 * @param string $name
	 */
	public function __construct(
		private readonly GetValueServiceInterface $extractValueService,
		private readonly string $pathEndpoint,
		private readonly array $columns,
		private readonly string $label,
		private readonly string $name,
	) {
	}

	/**
	 * @return array[]
	 */
	public static function getActions(): array
	{
		return [
			'essay_page_product_type_content' => ['render'],
		];
	}

	/**
	 * @return void
	 */
	public function render(): void
	{
		$label = $this->label;
		$name = $this->name;
		$columns = $this->columns;
		$pathEndpoint = $this->pathEndpoint;
		$value = $this->extractValueService->getValue();

		require dirname(__DIR__) . '/WidgetRepeaterProductType/WidgetRepeaterProductTypeView.php';
	}
}
