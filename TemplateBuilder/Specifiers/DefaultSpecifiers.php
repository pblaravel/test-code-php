<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

use FpDbTest\TemplateBuilder\Utils;

class DefaultSpecifiers implements SpecifiersInterface
{
    // signature of template, this signature is searcher for replace
    static string $signature = "?";

    public static function renderTemplate(&$template, $args): void
    {
        if (is_int($args)){
            $template = Utils::strReplaceFirst(self::$signature, $args, $template);
        }
        if (is_float($args)){
            $template = Utils::strReplaceFirst(self::$signature, $args, $template);
        }
        if (is_string($args)){
            $template = Utils::strReplaceFirst(self::$signature, sprintf("'%s'", addslashes($args)), $template);
        }
        if (is_bool($args)){
            $template = Utils::strReplaceFirst(self::$signature, $args ? 1 : 0, $template);
        }
        Utils::renderNull($template, $args, self::$signature);
    }
}