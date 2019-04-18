<?php

namespace msng\AnnotatedImageFetcher;

use msng\Values\EnumValue;

class Likelihood extends EnumValue
{
    const UNKNOWN = 0;
    const VERY_UNLIKELY = 1;
    const UNLIKELY = 2;
    const POSSIBLE = 3;
    const LIKELY = 4;
    const VERY_LIKELY = 5;
}
