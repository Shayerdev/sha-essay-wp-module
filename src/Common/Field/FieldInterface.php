<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Field;

interface FieldInterface
{
    /**
     * @param int $postId
     * @param string $slug
     * @param bool $single
     * @return string|bool|int
     */
    public function getValue(
        int $postId,
        string $slug,
        bool $single = true
    ): string|bool|int;

    /**
     * @param int $postId
     * @param string $slug
     * @param int|string|bool $value
     * @return bool
     */
    public function addValue(
        int $postId,
        string $slug,
        int|string|bool $value
    ): bool;

    /**
     * @param int $postId
     * @param string $slug
     * @return bool
     */
    public function hasValue(
        int $postId,
        string $slug,
    ): bool;

    /**
     * @param int $postId
     * @param string $slug
     * @param int|string|bool $value
     * @return bool
     */
    public function updateValue(
        int $postId,
        string $slug,
        int|string|bool $value
    ): bool;

    /**
     * @param int $postId
     * @param string $slug
     * @return bool
     */
    public function deleteValue(
        int $postId,
        string $slug
    ): bool;
}
