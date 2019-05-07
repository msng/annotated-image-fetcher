<?php

namespace msng\AnnotatedImageFetcher;

class SafeSearchAnnotation
{
    const ADULT = 'adult';
    const SPOOF = 'spoof';
    const MEDICAL = 'medical';
    const VIOLENCE = 'violence';
    const RACY = 'racy';

    /**
     * @var array
     */
    private $likelihoods = [
        self::ADULT => Likelihood::UNKNOWN,
        self::SPOOF => Likelihood::UNKNOWN,
        self::MEDICAL => Likelihood::UNKNOWN,
        self::VIOLENCE => Likelihood::UNKNOWN,
        self::RACY => Likelihood::UNKNOWN
    ];

    public function __construct(array $likelihoods = null)
    {
        $categories = [
            self::ADULT,
            self::SPOOF,
            self::MEDICAL,
            self::VIOLENCE,
            self::RACY,
        ];

        foreach ($categories as $category) {
            if (isset($likelihoods[$category])) {
                $this->likelihoods[$category] = $likelihoods[$category];
            }
        }
    }

    /**
     * @param  int  $adult
     * @return SafeSearchAnnotation
     */
    public function setAdult(int $adult): SafeSearchAnnotation
    {
        $this->likelihoods[self::ADULT] = $adult;

        return $this;
    }

    /**
     * @return int
     */
    public function getAdult(): int
    {
        return $this->likelihoods[self::ADULT];
    }

    /**
     * @param  int  $spoof
     * @return SafeSearchAnnotation
     */
    public function setSpoof(int $spoof): SafeSearchAnnotation
    {
        $this->likelihoods[self::SPOOF] = $spoof;

        return $this;
    }

    /**
     * @return int
     */
    public function getSpoof(): int
    {
        return $this->likelihoods[self::SPOOF];
    }

    /**
     * @param  int  $medical
     * @return SafeSearchAnnotation
     */
    public function setMedical(int $medical): SafeSearchAnnotation
    {
        $this->likelihoods[self::MEDICAL] = $medical;

        return $this;
    }

    /**
     * @return int
     */
    public function getMedical(): int
    {
        return $this->likelihoods[self::MEDICAL];
    }

    /**
     * @param  int  $violence
     * @return SafeSearchAnnotation
     */
    public function setViolence(int $violence): SafeSearchAnnotation
    {
        $this->likelihoods[self::VIOLENCE] = $violence;

        return $this;
    }

    /**
     * @return int
     */
    public function getViolence(): int
    {
        return $this->likelihoods[self::VIOLENCE];
    }

    /**
     * @param  int  $racy
     * @return SafeSearchAnnotation
     */
    public function setRacy(int $racy): SafeSearchAnnotation
    {
        $this->likelihoods[self::RACY] = $racy;

        return $this;
    }

    /**
     * @return int
     */
    public function getRacy(): int
    {
        return $this->likelihoods[self::RACY];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->likelihoods;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->likelihoods);

    }
}
