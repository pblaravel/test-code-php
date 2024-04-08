<?php

namespace FpDbTest;

use Exception;
use FpDbTest\TemplateBuilder\Template;
use FpDbTest\TemplateBuilder\TemplateInterface;
use mysqli;

class Database implements DatabaseInterface
{
    protected mysqli $mysqli;
    protected TemplateInterface $template;

    public function __construct(mysqli $mysqli, TemplateInterface $template)
    {
        $this->mysqli = $mysqli;
        $this->template = $template;
    }

    /**
     * @throws Exception
     */
    public function buildQuery(string $query, array $args = []): string
    {
        return $this->template->render($query, $args);
    }

    /**
     * @throws Exception
     */
    public function skip(): string
    {
        return $this->template::SKIP_BLOCK;
    }
}
