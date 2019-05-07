<?php

namespace msng\AnnotatedImageFetcher\Tests;

use msng\AnnotatedImageFetcher\Likelihood;
use msng\AnnotatedImageFetcher\SafeSearchAnnotation;
use PHPUnit\Framework\TestCase;

class SafeSearchAnnotationTest extends TestCase
{
    public function testConstructor()
    {
        $annotation = new SafeSearchAnnotation([
            SafeSearchAnnotation::ADULT => Likelihood::POSSIBLE
        ]);

        $this->assertSame($annotation->getAdult(), Likelihood::POSSIBLE);
        $this->assertSame($annotation->getViolence(), Likelihood::UNKNOWN);
    }
}
