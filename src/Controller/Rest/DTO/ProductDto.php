<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\DTO;

class ProductDto
{
	/**
	 * Construct.
	 *
	 * @param array $data
	 */
	public function __construct(
		private readonly array $data
	) {
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return (string) $this->data['product_name'];
	}

	/**
	 * @return int
	 */
	public function getActive(): int
	{
		return (int) $this->data['product_active'];
	}

	/**
	 * @return int|null
	 */
	public function getTypeId(): int|null
	{
		return !empty($this->data['product_type_id'])
			? (int) $this->data['product_type_id']
			: null;
	}

	/**
	 * @return int|null
	 */
	public function getCategoryId(): int|null
	{
		return !empty($this->data['product_category_id'])
			? (int) $this->data['product_category_id']
			: null;
	}

	/**
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}
}
