<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\CalcOption;

use Exception;
use Shayer\EduEssayPlugin\Common\Field\OptionInterface;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class MinCountSymbolsService implements GetValueServiceInterface
{
    const OPTION_SLUG = 'essay_calc_min_count_symbols';

	/**
	 * @param OptionInterface $option
	 */
    public function __construct(
        private readonly OptionInterface $option
    ) {
    }

	/**
	 * @return string
	 */
    public function getValue(): string
    {
        return $this->option->getValue(self::OPTION_SLUG);
    }

    /**
     * @param int $value
     * @return bool
     * @throws Exception
     */
    public function updateValue(int $value): bool
    {
        if ((int) $this->option->getValue(self::OPTION_SLUG) === $value) {
            return true;
        }

        $result = $this->option->updateValue(self::OPTION_SLUG, $value);

        if (!$result) {
            throw new Exception('Invalid process append value');
        }

        return $result;
    }
}
