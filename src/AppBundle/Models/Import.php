<?php

namespace AppBundle\Models;

use AppBundle\Entity\Item;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints as Assert;

class Import
{
	/**
	 * @Assert\NotBlank(message="Required")
	 */
	private $distributor;

	/**
	 * @Assert\NotBlank(message="Required")
	 * @Assert\File(mimeTypes={"text/plain"})
	 */
	private $file;

	private $replace;

	/**
	 * @return mixed
	 */
	public function getDistributor()
	{
		return $this->distributor;
	}

	/**
	 * @param mixed $distributor
	 */
	public function setDistributor($distributor)
	{
		$this->distributor = $distributor;
	}

	/**
	 * @return mixed
	 */
	public function getFile()
	{
		return $this->file;
	}

	/**
	 * @param mixed $file
	 */
	public function setFile($file)
	{
		$this->file = $file;
	}

	public function getReplace()
	{
		return $this->replace;
	}

	public function setReplace($replace)
	{
		$this->replace = $replace;
	}
}