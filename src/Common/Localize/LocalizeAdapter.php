<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Localize;

class LocalizeAdapter
{
	/**
	 * @param mixed $object
	 * @param array $params
	 *
	 * @return void
	 */
	public function adapt(mixed $object, array $params): void
	{
		foreach ($params as $key => $val) {
			wp_localize_script($val[0], $key, call_user_func([$object, $val[1]]));
		}
	}
}
