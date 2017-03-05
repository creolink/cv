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
    public function setName($name = '')
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $dateStart
     */
    public function setDateStart($dateStart = '')
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateStart()
    {
        return new \DateTime($this->dateStart);
    }

    /**
     * @param string $dateEnd
     */
    public function setDateEnd($dateEnd = '')
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
    public function setCompany($company = '')
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $address
     */
    public function setAddress($address = '')
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return bool
     */
    public function hasAddress()
    {
        return false === empty($this->address);
    }

    /**
     * @param string $country
     */
    public function setCountry($country = '')
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return bool
     */
    public function hasCountry()
    {
        return false === empty($this->country);
    }

    /**
     * @param string $description
     */
    public function setDescription($description = '')
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $examples
     */
    public function setExamples($examples = '')
    {
        $this->examples = $examples;
    }

    /**
     * @return string
     */
    public function getExamples()
    {
        return $this->examples;
    }

    /**
     * @return bool
     */
    public function hasExamples()
    {
        return false === empty($this->examples);
    }

    /**
     * @param string $references
     */
    public function setReferences($references = '')
    {
        $this->references = $references;
    }

    /**
     * @return string
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * @return bool
     */
    public function hasReferences()
    {
        return false === empty($this->references);
    }

    /**
     * @param string $recommendation
     */
    public function setRecommendation($recommendation = '')
    {
        $this->recommendation = $recommendation;
    }

    /**
     * @return string
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * @return bool
     */
    public function hasRecommendation()
    {
        return false === empty($this->recommendation);
    }

    /**
     * @param string $contact
     */
    public function setContact($contact = '')
    {
        $this->contact = $contact;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @return bool
     */
    public function hasContact()
    {
        return false === empty($this->contact);
    }

    /**
     * @param string $companyUrl
     */
    public function setCompanyUrl($companyUrl = '')
    {
        $this->companyUrl = $companyUrl;
    }

    /**
     * @return string
     */
    public function getCompanyUrl()
    {
        return $this->companyUrl;
    }

    /**
     * @return bool
     */
    public function hasCompanyUrl()
    {
        return false === empty($this->companyUrl);
    }

    /**
     * @return bool
     */
    public function hasCompanyData()
    {
        return $this->hasCompanyUrl()
            || $this->hasAddress()
            || $this->hasContact()
            || $this->hasCountry();
    }

    /**
     * @return bool
     */
    public function hasCompanyAddress()
    {
        return $this->hasAddress()
            || $this->hasCountry();
    }

    /**
     * @param bool $partTime
     */
    public function setPartTime($partTime = false)
    {
        $this->partTime = $partTime;
    }

    /**
     * @return bool
     */
    public function isPartTime()
    {
        return $this->partTime;
    }

    /**
     * @param bool $disabled
     */
    public function setDisabled($disabled = false)
    {
        $this->disabled = $disabled;
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return $this->disabled;
    }
}
