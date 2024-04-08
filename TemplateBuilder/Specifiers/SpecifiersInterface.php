<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

interface SpecifiersInterface
{
    public static function renderTemplate(&$template, $args): void;
}