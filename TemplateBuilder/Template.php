<?php

namespace FpDbTest\TemplateBuilder;

class Template implements TemplateInterface
{
    // Register list ot signature for template
    private const array SPECIFIERS = [
        "FpDbTest\TemplateBuilder\Specifiers\IntSpecifiers",
        "FpDbTest\TemplateBuilder\Specifiers\FloatSpecifiers",
        "FpDbTest\TemplateBuilder\Specifiers\ArraySpecifiers",
        "FpDbTest\TemplateBuilder\Specifiers\IdentifierOrArrayOfSpecifiers",
        "FpDbTest\TemplateBuilder\Specifiers\DefaultSpecifiers",
    ];

    // signature by detect if need skip block
    public const string SKIP_BLOCK = "?skip?";

    // render and replace signature by value
    public function render(string $template, array $args): string
    {
        // remove skip blocks from template
        $args = $this->removeSkipBlock($template, $args);


        // clear template by { }
        $template = str_replace("}", "", str_replace("{", "", $template));


        $matches = [];
        // find all signature by regex
        preg_match_all($this->generateRegex(), $template, $matches, PREG_SET_ORDER, 0);
        if (count($matches) != count($args)) return $template; // if count of signature is not equal with count argument return same template
        foreach ($matches as $key => $templateId) {
            foreach (self::SPECIFIERS as $spec) {
                if ($spec::$signature == $templateId[0]) {
                    $spec::renderTemplate($template, $args[$key]);
                    break;
                }
            }
        }
        return $template;
    }

    // create dynamic regex from array of SPECIFIERS
    private function generateRegex(): string
    {
        $regex = [];
        foreach (self::SPECIFIERS as $spec) {
            $regex[] = sprintf("\%s", $spec::$signature);
        }
        return sprintf("/%s/", implode("|", $regex));
    }

    // delete skip blocks
    private function removeSkipBlock(&$template, $args): array
    {
        foreach ($args as $k => $arg) {
            if ($arg === self::SKIP_BLOCK){
                $start_post = strpos($template, "{");
                $end_post = strpos($template, "}", $start_post);
                if ($start_post !== false && $end_post !== false){
                    $template = substr_replace($template, "", $start_post, $end_post - $start_post);
                    unset($args[$k]);
                }
            }
        }
        return array_values($args);
    }

}