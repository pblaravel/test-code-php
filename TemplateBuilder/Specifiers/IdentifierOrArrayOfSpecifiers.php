<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

use FpDbTest\TemplateBuilder\Utils;

class IdentifierOrArrayOfSpecifiers  extends DefaultSpecifiers
{
    // signature of template, this signature is searcher for replace
    static string $signature = "?#";

    #[\Override] public static function renderTemplate(&$template, $args): void
    {
        if (is_array($args)){
            $template = Utils::strReplaceFirst(self::$signature, self::formatArray($args), $template);
        }
        if (is_string($args)){
            $template = Utils::strReplaceFirst(self::$signature, sprintf("`%s`", addslashes($args)), $template);
        }
    }

    private static function formatArray(array $arr): string
    {
        $formatArray = [];
        foreach ($arr as $s) {
            $formatArray[] = sprintf("`%s`", addslashes($s));
        }
        return implode(", ", $formatArray);
    }
}