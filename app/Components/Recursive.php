<?php

namespace App\Components;

class Recursive
{
    private $html;
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
        $this->html = '';
    }
    public function setRecursive($parentId, $id = 0, $text = '')
    {

        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if (!empty($parentId) && $parentId ==  $value['id']) {
                    $this->html .= "<option selected value='" . $value['id'] . "'>" . $text  . $value['name'] . "</option>";
                } else {

                    $this->html .= "<option  value='" . $value['id'] . "'>" . $text  . $value['name'] . "</option>";
                }

                $this->setRecursive($parentId, $value['id'], $text . '--');
            }
        }
        return $this->html;
    }
}