<?php
namespace SDataGrid\Classes;

use InvalidArgumentException;
use ReflectionFunction;
use SDataGrid\Interfaces\InterfaceColumn;
use SDataGrid\Interfaces\InterfaceDataGrid;

class Column implements InterfaceColumn
{

    /** @var InterfaceDataGrid */
    protected $DataGrid = null;

    protected $displayName = '';
    protected $valueName = null;
    protected $headerAttributes = [];
    protected $bodyAttributes = [];
    protected $footerAttributes = [];

    /** @var callable */
    protected $callback = null;
    /** @var callable */
    protected $footerCallback = null;

    /**
     * Column constructor.
     * @param InterfaceDataGrid|null $DataGrid
     */
    public function __construct(InterfaceDataGrid $DataGrid = null)
    {
        $this->DataGrid = $DataGrid;
    }

    /**
     * @return InterfaceDataGrid
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
     * @return array<string, string>
     */
    public function getHeaderAttributes()
    {
        return $this->headerAttributes;
    }

    /**
     * @return array<string, string>
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
     * @return InterfaceColumn
     */
    public function setDisplayName($displayName)
    {
        if (!is_string($displayName)) {
            throw new InvalidArgumentException('Имя колонки должно быть строкой.');
        }

        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @param array<string, string> $headerAttributes
     * @return InterfaceColumn
     */
    public function setHeaderAttributes(array $headerAttributes = [])
    {
        $this->headerAttributes = $headerAttributes;
        return $this;
    }

    /**
     * @param array<string, string> $bodyAttributes
     * @return InterfaceColumn
     */
    public function setBodyAttributes(array $bodyAttributes = [])
    {
        $this->bodyAttributes = $bodyAttributes;
        return $this;
    }

    /**
     * @param $callback
     * @return InterfaceColumn
     */
    public function setCallback(callable $callback)
    {
        $closure = &$callback;
        $reflection = new ReflectionFunction($closure);
        if ($reflection->getNumberOfRequiredParameters() != 2) {
            throw new InvalidArgumentException('Параметры callback колонки должны быть обязательными.');
        }

        $this->callback = $callback;
        return $this;
    }

    /**
     * @param InterfaceDataGrid $DataGrid
     * @return InterfaceColumn
     */
    public function setDataGrid(InterfaceDataGrid $DataGrid)
    {
        $this->DataGrid = $DataGrid;
        return $this;
    }

    /**
     * @param string $valueName
     * @return InterfaceColumn
     */
    public function setValueName($valueName)
    {
        if (!is_string($valueName)) {
            throw new InvalidArgumentException('Имя поля данных колонки должно быть строкой.');
        }

        $this->valueName = $valueName;
        return $this;
    }

    /**
     * @param array<string, string> $footerAttributes
     * @return InterfaceColumn
     */
    public function setFooterAttributes(array $footerAttributes = [])
    {
        $this->footerAttributes = $footerAttributes;
        return $this;
    }

    /**
     * @param callable $callback
     * @return InterfaceColumn
     */
    public function setFooterCallback(callable $callback)
    {
        $closure = &$callback;
        $reflection = new ReflectionFunction($closure);
        if ($reflection->getNumberOfRequiredParameters() != 1) {
            throw new InvalidArgumentException('Параметр footerCallback колонки должен быть обязательным.');
        }

        $this->footerCallback = $callback;
        return $this;
    }

}