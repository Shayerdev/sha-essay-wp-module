<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\CalcOption;

use Exception;
use Shayer\EduEssayPlugin\Controller\Rest\RestHandleInterface;
use Shayer\EduEssayPlugin\Service\CalcOption\SingleSpacedCoefficientService;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;

class SingleSpacedCoefficientReq implements RestHandleInterface
{
	/**
	 * Construct.
	 *
	 * @param SingleSpacedCoefficientService $singleSpacedCoefficient
	 */
	public function __construct(
		private readonly SingleSpacedCoefficientService $singleSpacedCoefficient
	) {
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response|WP_Error
	 */
	public function handle(WP_REST_Request $request): WP_REST_Response|WP_Error
	{
		$body = $request->get_json_params();

		try {
			$this->singleSpacedCoefficient->updateValue((float) $body['value']);
			return new WP_REST_Response([
				'result' => "Coefficient for Single Spaced has been success appended",
				'success' => true,
			], 201);
		} catch (Exception $exception) {
			return new WP_Error(
				'some_error',
				$exception->getMessage(),
				['status' => $exception->getCode()]
			);
		}
	}
}
