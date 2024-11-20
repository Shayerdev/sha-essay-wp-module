<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Enqueues;

use Shayer\EduEssayPlugin\Common\Hooks\ActionHookSubscriberInterface;

class EnqueueStyleRegistrar implements ActionHookSubscriberInterface
{
	/**
	 * @param string $handle
	 * @param string $src
	 * @param string $version
	 * @param string $media
	 */
	public function __construct(
		private readonly string $handle,
		private readonly string $src,
		private readonly string $version,
		private readonly string $media,
	) {
	}

	/**
	 * @return array[]
	 */
	public static function getActions(): array {
		return [
			'admin_enqueue_scripts' => ['register', 20],
		];
	}

	/**
	 * @return void
	 */
	public function register(): void
	{
		wp_enqueue_style($this->handle, $this->src, [], $this->version, $this->media);
	}
}
