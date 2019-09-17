<?php

namespace BackendBundle\Entity;

/**
 * Photo
 */
class Photo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $thumbnailurl;

    /**
     * @var \BackendBundle\Entity\Album
     */
    private $album;


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
     * Set title
     *
     * @param string $title
     *
     * @return Photo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Photo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set thumbnailurl
     *
     * @param string $thumbnailurl
     *
     * @return Photo
     */
    public function setThumbnailurl($thumbnailurl)
    {
        $this->thumbnailurl = $thumbnailurl;

        return $this;
    }

    /**
     * Get thumbnailurl
     *
     * @return string
     */
    public function getThumbnailurl()
    {
        return $this->thumbnailurl;
    }

    /**
     * Set album
     *
     * @param \BackendBundle\Entity\Album $album
     *
     * @return Photo
     */
    public function setAlbum(\BackendBundle\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \BackendBundle\Entity\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }
}

