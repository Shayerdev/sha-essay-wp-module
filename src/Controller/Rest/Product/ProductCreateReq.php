<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\Product;

use Exception;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductDto;
use Shayer\EduEssayPlugin\Controller\Rest\RestHandleInterface;
use Shayer\EduEssayPlugin\Service\Product\ProductService;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;

class ProductCreateReq implements RestHandleInterface
{
	/**
	 * @param ProductService $productService
	 */
	public function __construct(
		private readonly ProductService $productService,
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
		$dto = $this->convertToDtoArray($body);

		try {
			$this->productService->extract($dto);
			return new WP_REST_Response([
				'result' => "Product, has been success appended",
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
	 * @return ProductDto[]
	 */
	private function convertToDtoArray($data): array
	{
		$result = [];

		foreach ($data as $item) {
			$result[] = new ProductDto($item);
		}

		return $result;
	}
}
