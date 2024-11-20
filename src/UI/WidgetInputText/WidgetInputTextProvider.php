<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\UI\WidgetInputText;

use Shayer\EduEssayPlugin\Common\Hooks\ActionHookSubscriberInterface;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class WidgetInputTextProvider implements ActionHookSubscriberInterface
{
	public function __construct(
		private readonly GetValueServiceInterface $extractValueService,
		private readonly string $pathEndpoint,
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
			'essay_page_global_options_content' => ['render'],
		];
	}

	/**
	 * @return void
	 */
	public function render(): void
	{
		$label = $this->label;
		$name = $this->name;
		$pathEndpoint = $this->pathEndpoint;
		$value = $this->extractValueService->getValue();

		require dirname(__DIR__) . '/WidgetInputText/WidgetInputTextView.php';
	}
}
