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
    protected $callback;

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
        return $this->callback != null;
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
    public function setCallback($callback)
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

}