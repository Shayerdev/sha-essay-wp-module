<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\CalcOption;

use Exception;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\VariationDeadlineDto;
use Shayer\EduEssayPlugin\Controller\Rest\RestHandleInterface;
use Shayer\EduEssayPlugin\Service\VariationDeadline\VariationDeadlineService;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;

class VariationDeadlineReq implements RestHandleInterface
{
	public function __construct(
		private readonly VariationDeadlineService $variationDeadlineService,
	) {
	}

	public function handle(WP_REST_Request $request): WP_REST_Response|WP_Error
	{
		$body = $request->get_json_params();
		$dto = $this->convertToDtoArray($body);

		try {
			$this->variationDeadlineService->extract($dto);
			return new WP_REST_Response([
				'result' => "Variations deadline, has been success appended",
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

	/**
	 * @return VariationDeadlineDto[]
	 */
	private function convertToDtoArray($data): array
	{
		$result = [];

		foreach ($data as $item) {
			$result[] = new VariationDeadlineDto($item);
		}

		return $result;
	}
}
