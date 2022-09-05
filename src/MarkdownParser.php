<?php

namespace Code16\Jigsaw;

use League\CommonMark\ConverterInterface;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\MarkdownConverter;

class MarkdownParser implements \Mni\FrontYAML\Markdown\MarkdownParser
{
    public function __construct()
    {
    }
    
    protected function converter(): ConverterInterface
    {
        $config = [
            'html_input' => 'allow',
            'external_link' => [
                'internal_hosts' => [], // all links are external
                'open_in_new_window' => true,
            ],
        ];
        
        $environment = new Environment($config);
        
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new ExternalLinkExtension());
        
        return new MarkdownConverter($environment);
    }
    
    public function parse($markdown)
    {
        return $this->converter()->convert($markdown);
    }
}
