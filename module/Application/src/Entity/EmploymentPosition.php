<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Entity;

use Application\Entity\EntityInterface;

class EmploymentPosition implements EntityInterface
{
    /**
     * Name of position
     *
     * @var string
     */
    private $name = '';

    /**
     * Date of start work
     *
     * @var string
     */
    private $dateStart;

    /**
     * Date of finish work
     *
     * @var string
     */
    private $dateEnd;

    /**
     * Company name
     *
     * @var string
     */
    private $company = '';

    /**
     * Company address
     *
     * @var string
     */
    private $address = '';

    /**
     * Company country
     *
     * @var string
     */
    private $country = '';

    /**
     * Description of position
     *
     * @var string
     */
    private $description = '';

    /**
     * Examples url
     *
     * @var string
     */
    private $examples = '';

    /**
     * References url
     *
     * @var string
     */
    private $references = '';

    /**
     * References url
     *
     * @var string
     */
    private $recommendation = '';


    /**
     * Contact data
     *
     * @var string
     */
    private $contact = '';

    /**
     * Company url
     *
     * @var string
     */
    private $companyUrl = '';

    /**
     * Part time job flag
     *
     * @var bool
     */
    private $partTime = false;

    /**
     * Sets position as disabled
     *
     * @var bool
     */
    private $disabled = false;

    /**
     * @param string $name
     */
    public function setName(string $name = '')
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $dateStart
     */
    public function setDateStart(string $dateStart = '')
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateStart(): \DateTime
    {
        return new \DateTime($this->dateStart);
    }

    /**
     * @param string|null $dateEnd
     */
    public function setDateEnd(string $dateEnd = null)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateEnd()
    {
        if (false === empty($this->dateEnd)) {
            return (new \DateTime($this->dateEnd));
        }

        return null;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company = '')
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address = '')
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return bool
     */
    public function hasAddress(): bool
    {
        return false === empty($this->address);
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country = '')
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return bool
     */
    public function hasCountry(): bool
    {
        return false === empty($this->country);
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description = '')
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $examples
     */
    public function setExamples(string $examples = '')
    {
        $this->examples = $examples;
    }

    /**
     * @return string
     */
    public function getExamples(): string
    {
        return $this->examples;
    }

    /**
     * @return bool
     */
    public function hasExamples(): bool
    {
        return false === empty($this->examples);
    }

    /**
     * @param string $references
     */
    public function setReferences(string $references = '')
    {
        $this->references = $references;
    }

    /**
     * @return string
     */
    public function getReferences(): string
    {
        return $this->references;
    }

    /**
     * @return bool
     */
    public function hasReferences(): bool
    {
        return false === empty($this->references);
    }

    /**
     * @param string $recommendation
     */
    public function setRecommendation(string $recommendation = '')
    {
        $this->recommendation = $recommendation;
    }

    /**
     * @return string
     */
    public function getRecommendation(): string
    {
        return $this->recommendation;
    }

    /**
     * @return bool
     */
    public function hasRecommendation(): bool
    {
        return false === empty($this->recommendation);
    }

    /**
     * @param string $contact
     */
    public function setContact(string $contact = '')
    {
        $this->contact = $contact;
    }

    /**
     * @return string
     */
    public function getContact(): string
    {
        return $this->contact;
    }

    /**
     * @return bool
     */
    public function hasContact(): bool
    {
        return false === empty($this->contact);
    }

    /**
     * @param string $companyUrl
     */
    public function setCompanyUrl(string $companyUrl = '')
    {
        $this->companyUrl = $companyUrl;
    }

    /**
     * @return string
     */
    public function getCompanyUrl(): string
    {
        return $this->companyUrl;
    }

    /**
     * @return bool
     */
    public function hasCompanyUrl(): bool
    {
        return false === empty($this->companyUrl);
    }

    /**
     * @return bool
     */
    public function hasCompanyData(): bool
    {
        return $this->hasCompanyUrl()
            || $this->hasAddress()
            || $this->hasContact()
            || $this->hasCountry();
    }

    /**
     * @return bool
     */
    public function hasCompanyAddress(): bool
    {
        return $this->hasAddress()
            || $this->hasCountry();
    }

    /**
     * @param bool $partTime
     */
    public function setPartTime(bool $partTime = false)
    {
        $this->partTime = $partTime;
    }

    /**
     * @return bool
     */
    public function isPartTime(): bool
    {
        return $this->partTime;
    }

    /**
     * @param bool $disabled
     */
    public function setDisabled(bool $disabled = false)
    {
        $this->disabled = $disabled;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }
}
