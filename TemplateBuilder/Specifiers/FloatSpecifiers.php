<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

use FpDbTest\TemplateBuilder\Utils;

class FloatSpecifiers  extends DefaultSpecifiers
{
    // signature of template, this signature is searcher for replace
    static string $signature = "?f";

    #[\Override] public static function renderTemplate(&$template, $args): void
    {
        if (is_float($args)){
            $template = str_replace(self::$signature, $args, $template);
        }
        Utils::renderNull($template, $args, self::$signature);
    }
}