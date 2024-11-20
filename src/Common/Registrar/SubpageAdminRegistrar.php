<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Registrar;

use Shayer\EduEssayPlugin\Common\Hooks\ActionHookSubscriberInterface;

class SubpageAdminRegistrar implements ActionHookSubscriberInterface
{
	/**
	 * @param array $pages
	 */
	public function __construct(
		private readonly array $pages = [],
	) {
	}

	public static function getActions(): array
	{
		return [
			'admin_menu' => ['register', 20],
		];
	}

	/**
	 * Method for register subpage in WordPress admin panel
	 * https://developer.wordpress.org/reference/functions/add_submenu_page/
	 *
	 * @return void
	 */
	public function register(): void
	{
		foreach ($this->pages as $page) {
			add_submenu_page(
				$page['parentSlug'],
				$page['pageTitle'],
				$page['menuTitle'],
				$page['manageOptions'],
				$page['slug'],
				[$page['callback'], 'execute'],
				$page['position'],
			);
		}
	}
}
