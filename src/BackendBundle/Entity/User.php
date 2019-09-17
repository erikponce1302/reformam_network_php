<?php

namespace BackendBundle\Entity;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $suite;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $zipcode;

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lng;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $nameCompany;

    /**
     * @var string
     */
    private $catchphrase;

    /**
     * @var string
     */
    private $bs;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set suite
     *
     * @param string $suite
     *
     * @return User
     */
    public function setSuite($suite)
    {
        $this->suite = $suite;

        return $this;
    }

    /**
     * Get suite
     *
     * @return string
     */
    public function getSuite()
    {
        return $this->suite;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return User
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return User
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set nameCompany
     *
     * @param string $nameCompany
     *
     * @return User
     */
    public function setNameCompany($nameCompany)
    {
        $this->nameCompany = $nameCompany;

        return $this;
    }

    /**
     * Get nameCompany
     *
     * @return string
     */
    public function getNameCompany()
    {
        return $this->nameCompany;
    }

    /**
     * Set catchphrase
     *
     * @param string $catchphrase
     *
     * @return User
     */
    public function setCatchphrase($catchphrase)
    {
        $this->catchphrase = $catchphrase;

        return $this;
    }

    /**
     * Get catchphrase
     *
     * @return string
     */
    public function getCatchphrase()
    {
        return $this->catchphrase;
    }

    /**
     * Set bs
     *
     * @param string $bs
     *
     * @return User
     */
    public function setBs($bs)
    {
        $this->bs = $bs;

        return $this;
    }

    /**
     * Get bs
     *
     * @return string
     */
    public function getBs()
    {
        return $this->bs;
    }
}

