<?php

namespace App\Services;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

class MarkdownRendererService {

    public static function getMetaAndContent(string $markdown) {
        $environment = new Environment([]);

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FrontMatterExtension());

        $converter = new MarkdownConverter($environment);

        $result = $converter->convert($markdown);

        return [
            "meta" => $result instanceof RenderedContentWithFrontMatter ? $result->getFrontMatter() : [],
            "content" => $result->getContent()
        ];
    }

}