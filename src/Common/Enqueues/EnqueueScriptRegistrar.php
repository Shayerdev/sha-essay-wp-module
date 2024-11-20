<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Enqueues;

use Shayer\EduEssayPlugin\Common\Hooks\ActionHookSubscriberInterface;

class EnqueueScriptRegistrar implements ActionHookSubscriberInterface
{
	/**
	 * @param string $handle
	 * @param string $src
	 * @param string $version
	 * @param bool $args
	 */
	public function __construct(
		private readonly string $handle,
		private readonly string $src,
		private readonly string $version,
		private readonly bool $args,
	) {
	}

	/**
	 * @return array[]
	 */
	public static function getActions(): array {
		return [
			'admin_enqueue_scripts' => ['register'],
		];
	}

	/**
	 * @return void
	 */
	public function register(): void
	{
		echo 'enc script';
		wp_enqueue_script($this->handle, $this->src, [], $this->version, $this->args);
	}
}
