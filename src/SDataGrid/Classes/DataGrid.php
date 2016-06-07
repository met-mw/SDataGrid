<?php
namespace SDataGrid\Classes;

use SDataGrid\Interfaces\InterfaceColumn;
use SDataGrid\Interfaces\InterfaceDataGrid;

class DataGrid implements InterfaceDataGrid
{

    protected $caption = null;
    protected $attributes = [];
    protected $dataSource = [];
    /** @var InterfaceColumn[] */
    protected $Columns = [];

    /**
     * @param $caption
     * @return InterfaceDataGrid
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @param array $attributes
     * @return InterfaceDataGrid
     */
    public function setAttributes($attributes = [])
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return InterfaceColumn[]
     */
    public function getColumns()
    {
        return $this->Columns;
    }

    /**
     * @param array $dataSet
     * @return InterfaceDataGrid
     */
    public function setDataSet(array $dataSet)
    {
        $this->dataSource = $dataSet;
        return $this;
    }

    /**
     * @param InterfaceColumn $Column
     * @return InterfaceDataGrid
     */
    public function addColumn(InterfaceColumn $Column)
    {
        $Column->setDataGrid($this);
        $this->Columns[] = $Column;

        return $this;
    }

    public function render()
    {
        $count = 1;
        $Columns = $this->getColumns();
        $hasFooter = false;
        ?>
        <table<? if ($this->hasAttributes()) { echo " {$this->getAttributesAsString()}"; } ?>>
            <?
            if ($this->hasCaption()) {
                ?><caption><?= $this->getCaption() ?></caption><?
            }
            ?>
            <thead>
                <tr>
                    <?
                    foreach ($Columns as $Column) {
                        if ($Column->hasFooterCallback()) {
                            $hasFooter = true;
                        }
                        ?><th<? if ($Column->hasHeaderAttributes()) { echo " {$Column->getHeaderAttributesAsString()}"; } ?>><?= $Column->getDisplayName(); ?></th><?
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
            <? $dataSet = $this->getDataSet(); ?>
            <?
            foreach ($dataSet as $data) {
                ?><tr><?
                foreach ($Columns as $Column) {
                    ?><td<? if ($Column->hasBodyAttributes()) { echo " {$Column->getBodyAttributesAsString()}"; } ?>><?
                    if ($Column->isCounter()) {
                        echo $count;
                    } elseif ($Column->hasCallback()) {
                        $callback = $Column->getCallback();
                        $callback($data);
                    } elseif (is_object($data)) {
                        echo $data->{$Column->getValueName()};
                    } else {
                        echo $data[$Column->getValueName()];
                    }
                    ?></td><?
                }
                ?></tr><?
                $count++;
            }
            ?>
            </tbody>
            <?
            if ($hasFooter) {
                ?><tfoot><?
                ?><tr><?
                foreach ($Columns as $Column) {
                    ?><td<? if ($Column->hasFooterAttributes()) { echo " {$Column->getFooterAttributesAsString()}"; } ?>><?
                    if ($Column->hasFooterCallback()) {
                        $footerCallback = $Column->getFooterCallback();
                        $footerCallback($dataSet);
                    }
                    ?></td><?
                }
                ?></tr><?
                ?></tfoot><?
            }
            ?>
        </table>
        <?
    }

    public function get()
    {
        ob_start();
        $this->render();
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

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

    public function getAttributesAsString()
    {
        $preparedAttributes = [];
        $attributes = $this->getAttributes();
        foreach ($attributes as $name => $value) {
            $preparedAttributes[] = "{$name}=\"{$value}\"";
        }

        return implode(' ', $preparedAttributes);
    }

    public function hasAttributes()
    {
        return !empty($this->getAttributes());
    }

    public function hasCaption()
    {
        return !is_null($this->getCaption());
    }

}