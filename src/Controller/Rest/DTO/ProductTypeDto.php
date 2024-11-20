<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\DTO;

class ProductTypeDto
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
	public function getTypeName(): string
	{
		return (string) $this->data['name_type'];
	}

	/**
	 * @return float|int
	 */
	public function getCoefficient(): float|int
	{
		return (float) $this->data['coefficient'];
	}

	/**
	 * @return int
	 */
	public function getMinCountSymbols(): int
	{
		return (int) $this->data['min_count_symbols'];
	}

	/**
	 * @return int
	 */
	public function getMinCountPages(): int
	{
		return (int) $this->data['min_count_pages'];
	}

	/**
	 * @return bool
	 */
	public function getApplyCoefficientIfBelowMin(): bool
	{
		return (bool) $this->data['apply_coefficient_if_below_min'];
	}

	/**
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}
}
