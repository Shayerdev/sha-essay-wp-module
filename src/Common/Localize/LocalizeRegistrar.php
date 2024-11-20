<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Localize;

use Shayer\EduEssayPlugin\Common\Hooks\ActionHookSubscriberInterface;

class LocalizeRegistrar implements ActionHookSubscriberInterface
{
	/**
	 * @param LocalizeScriptSubscriber[] $localizeServiceList
	 */
	public function __construct(
		private readonly LocalizeAdapter $localizeAdapter,
		private readonly mixed $localizeServiceList,
	) {
	}

	/**
	 * @return array[]
	 */
	public static function getActions(): array
	{
		return [
			'admin_enqueue_scripts' => ['register'],
		];
	}

	/**
	 * @return void
	 */
	public function register(): void
	{
		if (empty($this->localizeServiceList)) {
			return;
		}

		$this->localizeScriptMap($this->localizeServiceList);
	}

	/**
	 * @param LocalizeScriptSubscriber[] $objectList
	 *
	 * @return void
	 */
	private function localizeScriptMap(array $objectList): void
	{
		foreach ($objectList as $object) {
			if ($object instanceof LocalizeScriptSubscriber) {
				$this->localizeScript($object);
			}
		}
	}

	/**
	 * @param LocalizeScriptSubscriber $object
	 *
	 * @return void
	 */
	private function localizeScript(LocalizeScriptSubscriber $object): void
	{
		//var_dump($object);
		$this->localizeAdapter->adapt($object, $object->getLocalizeScript());
	}
}
