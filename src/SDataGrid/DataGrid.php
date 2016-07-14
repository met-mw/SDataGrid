<?php
namespace SDataGrid;

use InvalidArgumentException;

class DataGrid implements DataGridInterface
{

    /** @var string */
    protected $caption = '';
    /** @var array */
    protected $attributes = [];
    /** @var array */
    protected $dataSource = [];
    /** @var ColumnInterface[] */
    protected $Columns = [];

    /**
     * DataGrid constructor.
     * @param array $dataSet
     * @param string $caption
     */
    public function __construct(array $dataSet = [], $caption = '')
    {
        $this->setDataSet($dataSet)
            ->setCaption($caption);
    }

    /**
     * @param ColumnInterface $Column
     * @return DataGridInterface
     */
    public function addColumn(ColumnInterface $Column)
    {
        $Column->setDataGrid($this);
        $this->Columns[] = $Column;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @return array
     */
    public function getDataSet()
    {
        return $this->dataSource;
    }

    /**
     * @return string
     */
    public function getAttributesAsString()
    {
        $preparedAttributes = [];
        $attributes = $this->getAttributes();
        foreach ($attributes as $name => $value) {
            $preparedAttributes[] = "{$name}=\"{$value}\"";
        }

        return implode(' ', $preparedAttributes);
    }

    /**
     * @return bool
     */
    public function hasAttributes()
    {
        return !empty($this->getAttributes());
    }

    /**
     * @return bool
     */
    public function hasCaption()
    {
        return !is_null($this->getCaption());
    }

    /**
     * @param string $caption
     * @return DataGridInterface
     */
    public function setCaption($caption)
    {
        if (!is_string($caption)) {
            throw new InvalidArgumentException('Table caption must be a string.');
        }

        $this->caption = $caption;
        return $this;
    }

    /**
     * @param array $attributes
     * @return DataGridInterface
     */
    public function setAttributes(array $attributes = [])
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return ColumnInterface[]
     */
    public function getColumns()
    {
        return $this->Columns;
    }

    /**
     * @param array $dataSet
     * @return DataGridInterface
     */
    public function setDataSet(array $dataSet = [])
    {
        $this->dataSource = $dataSet;
        return $this;
    }

    /**
     * @return void
     */
    public function render()
    {
        $number = 1;
        $Columns = $this->getColumns();
        $hasFooter = false;
        ?><table<?php if ($this->hasAttributes()) { echo " {$this->getAttributesAsString()}"; } ?>><?php
            if ($this->hasCaption()) {
                ?><caption><?php echo $this->getCaption(); ?></caption><?php
            }
            ?><thead><?php
                ?><tr><?php
                    foreach ($Columns as $Column) {
                        if ($Column->hasFooterCallback()) {
                            $hasFooter = true;
                        }
                        ?><th<?php if ($Column->hasHeaderAttributes()) { echo " {$Column->getHeaderAttributesAsString()}"; } ?>><?php echo $Column->getDisplayName(); ?></th><?php
                    }
                ?></tr><?php
            ?></thead><?php
            ?><tbody><?php
                $dataSet = $this->getDataSet();
                foreach ($dataSet as $data) {
                    ?><tr><?php
                    foreach ($Columns as $Column) {
                        ?><td<?php if ($Column->hasBodyAttributes()) { echo " {$Column->getBodyAttributesAsString()}"; } ?>><?php
                        if ($Column->hasCallback()) {
                            $callback = $Column->getCallback();
                            $callback($number, $data);
                        } elseif (is_object($data)) {
                            echo $data->{$Column->getValueName()};
                        } else {
                            echo $data[$Column->getValueName()];
                        }
                        ?></td><?php
                    }
                    ?></tr><?php
                    $number++;
                }
            ?></tbody><?php
            if ($hasFooter) {
                ?><tfoot><?php
                ?><tr><?php
                foreach ($Columns as $Column) {
                    ?><td<?php if ($Column->hasFooterAttributes()) { echo " {$Column->getFooterAttributesAsString()}"; } ?>><?php
                    if ($Column->hasFooterCallback()) {
                        $footerCallback = $Column->getFooterCallback();
                        $footerCallback($dataSet);
                    }
                    ?></td><?php
                }
                ?></tr><?php
                ?></tfoot><?php
            }
            ?></table><?php
    }

    /**
     * @return string
     */
    public function get()
    {
        ob_start();
        $this->render();
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

}