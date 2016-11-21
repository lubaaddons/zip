<?php

namespace Luba;

use ZipArchive;

class Zip
{
	protected $files = [];

	protected $destination;

	protected $zipArchive;

	public function __construct($dest, array $files = [])
	{
		$this->files = $files;
		$this->name = $name;
		$this->destination = $dest;
		$this->zipArchive = new ZipArchive();
	}

	public function addFiles(array $files = [])
	{
		$this->files[] = $files;
	}

	public function make()
	{
		$this->zipArchive->open($this->destination, ZipArchive::CREATE | ZipArchive::OVERWRITE);

		foreach ($this->files as $localname => $filename)
		{
			$this->zipArchive->addFile($filename, is_int($localname) ? NULL : $localname);
		}

		$this->zipArchive->close();

		return $this->destination;
	}
}