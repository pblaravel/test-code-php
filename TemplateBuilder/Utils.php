<?php

namespace FpDbTest\TemplateBuilder;

class Utils
{
    public static function renderNull(&$template, $ars, string $signature): void
    {
        if (is_null($ars)){
            $template = Utils::strReplaceFirst($signature, "NULL", $template);
        }
    }

    public static function strReplaceFirst($search, $replace, &$subject): string
    {
        $search = '/'.preg_quote($search, '/').'/';
        return preg_replace($search, $replace, $subject, 1);
    }
}