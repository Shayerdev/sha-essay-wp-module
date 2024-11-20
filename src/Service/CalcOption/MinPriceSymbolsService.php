<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\CalcOption;

use Exception;
use Shayer\EduEssayPlugin\Common\Field\OptionInterface;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class MinPriceSymbolsService implements GetValueServiceInterface
{
    const OPTION_SLUG = 'essay_calc_min_price_symbols';

    public function __construct(
        private readonly OptionInterface $option
    ) {
    }

    public function getValue(): string
    {
        return $this->option->getValue(self::OPTION_SLUG);
    }

    /**
     * @param array $value
     * @return bool
     * @throws Exception
     */
    public function updateValue(array $value): bool
    {
        if (str_contains((string) $this->option->getValue(self::OPTION_SLUG), (string) json_encode($value))) {
            return true;
        }

        $result = $this->option->updateValue(self::OPTION_SLUG, json_encode($value));

        if (!$result) {
            throw new Exception('Invalid process append min price');
        }

        return $result;
    }
}
