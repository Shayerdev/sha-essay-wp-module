<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Field;

interface OptionInterface {
    /**
     * Get Option field
     *
     * @param string $key
     * @return string|bool|int
     */
    public function getValue(string $key): string|bool|int;

    /**
     * Add Option Field
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function addValue(string $key, mixed $value): bool;

    /**
     * Check exist Option field
     *
     * @param string $key
     * @return bool
     */
    public function hasValue(string $key): bool;

    /**
     * Update Option field
     *
     * @param string $key
     * @param mixed $value
     * @return bool|int
     */
    public function updateValue(string $key, mixed $value): bool|int;

    /**
     * Delete Option Field
     *
     * @param string $key
     * @return bool
     */
    public function deleteValue(string $key): bool;
}
