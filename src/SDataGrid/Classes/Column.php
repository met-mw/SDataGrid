<?php
namespace SDataGrid\Classes;

use SDataGrid\Interfaces\InterfaceColumn;
use SDataGrid\Interfaces\InterfaceDataGrid;

class Column implements InterfaceColumn
{

    /** @var InterfaceDataGrid */
    protected $DataGrid = null;

    protected $isCounter = false;
    protected $displayName = null;
    protected $valueName = null;
    protected $headerAttributes = [];
    protected $bodyAttributes = [];
    protected $footerAttributes = [];

    /** @var callable */
    protected $callback = null;
    /** @var callable */
    protected $footerCallback = null;

    public function __construct(InterfaceDataGrid $DataGrid = null)
    {
        $this->DataGrid = $DataGrid;
    }


    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function getHeaderAttributes()
    {
        return $this->headerAttributes;
    }

    public function getBodyAttributes()
    {
        return $this->bodyAttributes;
    }

    protected function getAttributesAsString(array $attributes)
    {
        $preparedAttributes = [];
        foreach ($attributes as $name => $value) {
            $preparedAttributes[] = "{$name}=\"{$value}\"";
        }

        return implode(' ', $preparedAttributes);
    }

    public function getHeaderAttributesAsString()
    {
        return $this->getAttributesAsString($this->getHeaderAttributes());
    }

    public function getBodyAttributesAsString()
    {
        return $this->getAttributesAsString($this->getBodyAttributes());
    }

    public function hasHeaderAttributes()
    {
        return !empty($this->getHeaderAttributes());
    }

    public function hasBodyAttributes()
    {
        return !empty($this->getBodyAttributes());
    }

    public function hasCallback()
    {
        return !is_null($this->callback);
    }

    /**
     * @param $displayName
     * @return InterfaceColumn
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @param array $headerAttributes
     * @return InterfaceColumn
     */
    public function setHeaderAttributes($headerAttributes = [])
    {
        $this->headerAttributes = $headerAttributes;
        return $this;
    }

    /**
     * @param array $bodyAttributes
     * @return InterfaceColumn
     */
    public function setBodyAttributes($bodyAttributes = [])
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
        $this->callback = $callback;
        return $this;
    }

    /**
     * @return InterfaceDataGrid
     */
    public function getDataGrid()
    {
        return $this->DataGrid;
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
     * @param $valueName
     * @return InterfaceColumn
     */
    public function setValueName($valueName)
    {
        $this->valueName = $valueName;
        return $this;
    }


    public function getValueName()
    {
        return $this->valueName;
    }

    public function getCallback()
    {
        return $this->callback;
    }

    public function isCounter()
    {
        return $this->isCounter;
    }

    public function switchOnCounter()
    {
        $this->isCounter = true;
        return $this;
    }

    public function switchOffCounter()
    {
        $this->isCounter = false;
        return $this;
    }

    /**
     * @return callable
     */
    public function getFooterCallback()
    {
        return $this->footerCallback;
    }

    /**
     * @return array
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
     * @param array $footerAttributes
     * @return InterfaceColumn
     */
    public function setFooterAttributes($footerAttributes = [])
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
        $this->footerCallback = $callback;
        return $this;
    }
}