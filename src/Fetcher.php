<?php

namespace msng\AnnotatedImageFetcher;

use Google\ApiCore\ApiException;
use Google\ApiCore\ValidationException;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Goutte\Client as GoutteClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Fetcher
{
    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    /**
     * @var GoutteClient
     */
    private $goutteClient;

    public function __construct(array $config = [])
    {
        $this->guzzleClient = $this->createGuzzleClient($config);
    }

    /**
     * @param  string  $pageUrl
     * @return AnnotatedImage|null Returns null if no og:image is found on the web page.
     * @throws ApiException
     * @throws GuzzleException
     * @throws ValidationException
     */
    public function fetchFromWebPage(string $pageUrl): ?AnnotatedImage
    {
        if ($imageUrl = $this->getImageUrlFromWebPage($pageUrl)) {
            return $this->fetch($imageUrl);
        }

        return null;
    }

    /**
     * @param  string  $imageUrl
     * @return AnnotatedImage
     * @throws ApiException
     * @throws GuzzleException
     * @throws ValidationException
     */
    public function fetch(string $imageUrl): AnnotatedImage
    {
        $imageContent = $this->download($imageUrl);
        $safeSearch = $this->safeSearch($imageContent);

        $annotatedImage = (new AnnotatedImage())
            ->setUrl($imageUrl)
            ->setContent($imageContent)
            ->setSafeSearchAnnotation($safeSearch);

        return $annotatedImage;
    }

    /**
     * @param  string  $url
     * @return string|null
     */
    public function getImageUrlFromWebPage(string $url): ?string
    {
        $crawler = $this->getGoutteClient()->request('GET', $url);
        $node = $crawler->filterXPath('//meta[@property="og:image"]')->first();

        if ($node->count() === 0) {
            return null;
        };

        $url = $node->attr('content');

        return $url;
    }

    /**
     * @param  string  $image
     * @return SafeSearchAnnotation
     * @throws ApiException
     * @throws ValidationException
     */
    public function safeSearch(string $image): SafeSearchAnnotation
    {
        $imageAnnotator = new ImageAnnotatorClient(['key' => '']);
        $response = $imageAnnotator->safeSearchDetection($image);
        $result = $response->getSafeSearchAnnotation();

        $safeSearchAnnotation = (new SafeSearchAnnotation())
            ->setAdult($result->getAdult())
            ->setSpoof($result->getSpoof())
            ->setMedical($result->getMedical())
            ->setViolence($result->getViolence())
            ->setRacy($result->getRacy());

        return $safeSearchAnnotation;
    }

    /**
     * @param  array  $config
     * @return GuzzleClient
     */
    private function createGuzzleClient(array $config = []): GuzzleClient
    {
        $guzzleClient = new GuzzleClient($config);

        return $guzzleClient;
    }

    /**
     * @return GoutteClient
     */
    private function getGoutteClient(): GoutteClient
    {
        if (is_null($this->goutteClient)) {
            $this->goutteClient = (new GoutteClient())->setClient($this->guzzleClient);
        }

        return $this->goutteClient;
    }

    /**
     * @param  string  $url
     * @return string
     * @throws GuzzleException
     */
    private function download(string $url): string
    {
        $image = $this->guzzleClient->request('GET', $url);
        $imageContent = $image->getBody()->getContents();

        return $imageContent;
    }

}
