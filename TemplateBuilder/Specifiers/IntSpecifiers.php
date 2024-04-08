<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

use FpDbTest\TemplateBuilder\Utils;

class IntSpecifiers extends DefaultSpecifiers
{
    // signature of template, this signature is searcher for replace
    static string $signature = "?d";

    #[\Override] public static function renderTemplate(&$template, $args): void
    {
        if (is_int($args)){
            $template = Utils::strReplaceFirst(self::$signature, $args, $template);
        }
        if (is_bool($args)){
            $template = Utils::strReplaceFirst(self::$signature, $args ? 1 : 0, $template);
        }
        Utils::renderNull($template, $args, self::$signature);
    }
}