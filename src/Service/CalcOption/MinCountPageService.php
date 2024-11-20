<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Service\CalcOption;

use Exception;
use Shayer\EduEssayPlugin\Common\Field\OptionInterface;
use Shayer\EduEssayPlugin\Service\GetValueServiceInterface;

class MinCountPageService implements GetValueServiceInterface
{
    const OPTION_SLUG = 'essay_calc_min_count_page';

    public function __construct(
        private readonly OptionInterface $option
    ) {
    }

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
