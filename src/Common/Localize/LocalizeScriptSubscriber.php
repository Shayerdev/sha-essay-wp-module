<?php

declare( strict_types=1 );

namespace Shayer\EduEssayPlugin\Common\Localize;

interface LocalizeScriptSubscriber
{
	/**
	 * Callback Data mush be on array
	 *
	 * * array('object_name' => array('script_name', 'data'))
	 *
	 * @return array
	 */
	public static function getLocalizeScript(): array;
}
