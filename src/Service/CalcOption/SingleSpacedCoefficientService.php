<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\CalcOption;

use Exception;
use Shayer\EduEssayPlugin\Common\Field\OptionInterface;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class SingleSpacedCoefficientService implements GetValueServiceInterface
{
	const OPTION_SLUG = 'essay_calc_single_spaced_coefficient';

	public function __construct(
		private readonly OptionInterface $option
	) {
	}

	public function getValue(): string
	{
		return $this->option->getValue(self::OPTION_SLUG);
	}

	/**
	 * @param int|float $value
	 * @return bool
	 * @throws Exception
	 */
	public function updateValue(int|float $value): bool
	{
		if ((float) $this->option->getValue(self::OPTION_SLUG) === $value) {
			return true;
		}

		$result = $this->option->updateValue(self::OPTION_SLUG, $value);

		if (!$result) {
			throw new Exception('Invalid process append value');
		}

		return $result;
	}
}

