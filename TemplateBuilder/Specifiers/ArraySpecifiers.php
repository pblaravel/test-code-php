<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

use Exception;
use FpDbTest\TemplateBuilder\Utils;

class ArraySpecifiers  extends DefaultSpecifiers
{
    // signature of template, this signature is searcher for replace
    static string $signature = "?a";

    /**
     * @throws Exception
     */
    #[\Override] public static function renderTemplate(&$template, $args): void
    {
        if (!array_is_list($args)){
            $template = Utils::strReplaceFirst(self::$signature, self::formatArray($args), $template);
            return;
        }
        if (array_is_list($args)){
            $template = Utils::strReplaceFirst(self::$signature, implode(", ", $args), $template);
            return;
        }
        if (is_string($args)){
            $template = Utils::strReplaceFirst(self::$signature, sprintf("`%s`", addslashes($args)), $template);
            return;
        }
        throw new Exception("Wrong type to template");
    }

    private static function formatArray(array $arr): string
    {
        $formatArray = [];
        foreach ($arr as $k => $s) {
            if (is_null($s)){
                $formatArray[] = sprintf("`%s` = NULL", $k);
            } else {
                $formatArray[] = sprintf("`%s` = '%s'", addslashes($k), addslashes($s));
            }

        }
        return implode(", ", $formatArray);
    }
}