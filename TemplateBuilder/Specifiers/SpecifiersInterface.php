<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

/**
 * Class interface for all class signature.
 */
interface SpecifiersInterface
{
    /**
     * Render template function.
     */
    public static function renderTemplate(&$template, $args): void;
}