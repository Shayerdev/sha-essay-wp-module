<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Localize;

class LocalizeProvider
{
	/**
	 * @param LocalizeScriptSubscriber[] $subscribeLocalize
	 */
	public function __construct(
		private readonly array $subscribeLocalize = []
	) {
	}

	/**
	 * @return array[]
	 */
	public function get(): array
	{
		return $this->subscribeLocalize;
	}
}
