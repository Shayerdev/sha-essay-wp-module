<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Field;

class Option implements OptionInterface
{
    /**
     * Get Option field
     *
     * @param string $key
     * @return string|bool|int
     */
    public function getValue(string $key): string|bool|int
    {
        return get_option($key);
    }

    /**
     * Add Option Field
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function addValue(string $key, mixed $value): bool
    {
        return add_option($key, $value);
    }

    /**
     * Check exist Option field
     *
     * @param string $key
     * @return bool
     */
    public function hasValue(string $key): bool
    {
        return !empty(get_option($key));
    }

    /**
     * Update Option field
     *
     * @param string $key
     * @param mixed $value
     * @return bool|int
     */
    public function updateValue(string $key, mixed $value): bool|int
    {
        return update_option($key, $value);
    }

    /**
     * Delete Option Field
     *
     * @param string $key
     * @return bool
     */
    public function deleteValue(string $key): bool
    {
        return delete_option($key);
    }
}
