<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\CalcOption;

use Shayer\EduEssayPlugin\Controller\Rest\RestArgsInterface;
use WP_Error;

class MinCountSymbolsOptionArgs implements RestArgsInterface {
    /**
     * @return array[]
     */
    public function validate(): array
    {
        return [
            'value' => $this->validateValueParam()
        ];
    }

    /**
     * @return array
     */
    private function validateValueParam(): array
    {
        return [
            'required' => true,
            'type' => 'number',
            'validate_callback' => function($param, $request, $key) {
                if (empty($param)) {
                    return new WP_Error(
                        'invalid_param',
                        sprintf('Field %s must be not empty', $key),
                        ['status' => 400]
                    );
                }

                return true;
            },
        ];
    }
}
