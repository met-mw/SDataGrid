<?php
namespace SDataGrid;

use InvalidArgumentException;
use ReflectionFunction;

class Column implements ColumnInterface
{

    /** @var DataGridInterface */
    protected $DataGrid = null;

    protected $displayName = '';
    protected $valueName = null;
    /** @var <string, string>[] */
    protected $headerAttributes = [];
    /** @var <string, string>[] */
    protected $bodyAttributes = [];
    /** @var <string, string>[] */
    protected $footerAttributes = [];

    /** @var callable */
    protected $callback = null;
    /** @var callable */
    protected $footerCallback = null;

    /**
     * Column constructor.
     * @param DataGridInterface|null $DataGrid
     */
    public function __construct(DataGridInterface $DataGrid = null)
    {
        $this->DataGrid = $DataGrid;
    }

    /**
     * @return DataGridInterface
     */
    public function getDataGrid()
    {
        return $this->DataGrid;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @return array
     */
    public function getHeaderAttributes()
    {
        return $this->headerAttributes;
    }

    /**
     * @return array
     */
    public function getBodyAttributes()
    {
        return $this->bodyAttributes;
    }

    /**
     * @param array<string, string> $attributes
     * @return string
     */
    protected function getAttributesAsString(array $attributes)
    {
        $preparedAttributes = [];
        foreach ($attributes as $name => $value) {
            $preparedAttributes[] = "{$name}=\"{$value}\"";
        }

        return implode(' ', $preparedAttributes);
    }

    /**
     * @return string
     */
    public function getHeaderAttributesAsString()
    {
        return $this->getAttributesAsString($this->getHeaderAttributes());
    }

    /**
     * @return string
     */
    public function getBodyAttributesAsString()
    {
        return $this->getAttributesAsString($this->getBodyAttributes());
    }

    /**
     * @return null
     */
    public function getValueName()
    {
        return $this->valueName;
    }

    /**
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @return callable
     */
    public function getFooterCallback()
    {
        return $this->footerCallback;
    }

    /**
     * @return array<string, string>
     */
    public function getFooterAttributes()
    {
        return $this->footerAttributes;
    }

    /**
     * @return string
     */
    public function getFooterAttributesAsString()
    {
        return $this->getAttributesAsString($this->getFooterAttributes());
    }

    /**
     * @return bool
     */
    public function hasFooterAttributes()
    {
        return !empty($this->getFooterAttributes());
    }

    /**
     * @return bool
     */
    public function hasFooterCallback()
    {
        return !is_null($this->footerCallback);
    }

    /**
     * @return bool
     */
    public function hasHeaderAttributes()
    {
        return !empty($this->getHeaderAttributes());
    }

    /**
     * @return bool
     */
    public function hasBodyAttributes()
    {
        return !empty($this->getBodyAttributes());
    }

    /**
     * @return bool
     */
    public function hasCallback()
    {
        return !is_null($this->callback);
    }

    /**
     * @param string $displayName
     * @return ColumnInterface
     */
    public function setDisplayName($displayName)
    {
        if (!is_string($displayName)) {
            throw new InvalidArgumentException('Column display name must be a string');
        }

        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @param array<string, string> $headerAttributes
     * @return ColumnInterface
     */
    public function setHeaderAttributes(array $headerAttributes = [])
    {
        $this->headerAttributes = $headerAttributes;
        return $this;
    }

    /**
     * @param array<string, string> $bodyAttributes
     * @return ColumnInterface
     */
    public function setBodyAttributes(array $bodyAttributes = [])
    {
        $this->bodyAttributes = $bodyAttributes;
        return $this;
    }

    /**
     * @param $callback
     * @return ColumnInterface
     */
    public function setCallback(callable $callback)
    {
        $closure = &$callback;
        $reflection = new ReflectionFunction($closure);
        if ($reflection->getNumberOfRequiredParameters() != 2) {
            throw new InvalidArgumentException('Callback\'s parameters are required.');
        }

        $this->callback = $callback;
        return $this;
    }

    /**
     * @param DataGridInterface $DataGrid
     * @return ColumnInterface
     */
    public function setDataGrid(DataGridInterface $DataGrid)
    {
        $this->DataGrid = $DataGrid;
        return $this;
    }

    /**
     * @param string $valueName
     * @return ColumnInterface
     */
    public function setValueName($valueName)
    {
        if (!is_string($valueName)) {
            throw new InvalidArgumentException('Column name must be a string.');
        }

        $this->valueName = $valueName;
        return $this;
    }

    /**
     * @param array<string, string> $footerAttributes
     * @return ColumnInterface
     */
    public function setFooterAttributes(array $footerAttributes = [])
    {
        $this->footerAttributes = $footerAttributes;
        return $this;
    }

    /**
     * @param callable $callback
     * @return ColumnInterface
     */
    public function setFooterCallback(callable $callback)
    {
        $closure = &$callback;
        $reflection = new ReflectionFunction($closure);
        if ($reflection->getNumberOfRequiredParameters() != 1) {
            throw new InvalidArgumentException('Footer callback\'s parameter are required.');
        }

        $this->footerCallback = $callback;
        return $this;
    }

}