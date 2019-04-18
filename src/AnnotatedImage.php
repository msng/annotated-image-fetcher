<?php

namespace msng\AnnotatedImageFetcher;

class AnnotatedImage
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $content;

    /**
     * @var SafeSearchAnnotation
     */
    private $safeSearchAnnotation;

    /**
     * @param string $url
     * @return AnnotatedImage
     */
    public function setUrl(string $url): AnnotatedImage
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $content
     * @return AnnotatedImage
     */
    public function setContent(string $content): AnnotatedImage
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param SafeSearchAnnotation $safeSearch
     * @return AnnotatedImage
     */
    public function setSafeSearchAnnotation(SafeSearchAnnotation $safeSearch): AnnotatedImage
    {
        $this->safeSearchAnnotation = $safeSearch;
        return $this;
    }

    /**
     * @return SafeSearchAnnotation
     */
    public function getSafeSearchAnnotation(): SafeSearchAnnotation
    {
        return $this->safeSearchAnnotation;
    }
}
