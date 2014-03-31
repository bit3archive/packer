<?php

/*
 * CSS/JS distribution packer.
 *
 * (c) Tristan Lins <tristan.lins@bit3.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bit3\Builder;

use Assetic\Filter\CssRewriteFilter;
use Assetic\Filter\FilterInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Assetic\Asset\StringAsset;
use Assetic\Filter\CssEmbedFilter;
use Assetic\Filter\Sass\ScssFilter;
use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\Yui\JsCompressorFilter;
use Assetic\Filter\CssCrushFilter;
use Symfony\Component\Yaml\Yaml;

class LocalFile implements File
{
	/**
	 * The file pathname.
	 *
	 * @var string
	 */
	protected $pathname;

	/**
	 * File specific filters.
	 *
	 * @var FilterInterface[]
	 */
	protected $filters = [];

	function __construct($pathname, array $filters = [])
	{
		$this->pathname = (string) $pathname;
		$this->filters  = $filters;
	}

	public function setPathname($pathname)
	{
		$this->pathname = (string) $pathname;
		return $this;
	}

	public function getPathname()
	{
		return $this->pathname;
	}

	public function addFilter(FilterInterface $filter, $name)
	{
		$this->filters[$name] = $filter;
		return $this;
	}

	public function setFilters(array $filters)
	{
		$this->filters = $filters;
		return $this;
	}

	public function getFilters()
	{
		return $this->filters;
	}
}
