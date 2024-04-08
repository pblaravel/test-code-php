<?php

namespace FpDbTest\TemplateBuilder;

interface TemplateInterface
{
    public function render(string $template, array $args): string;
}