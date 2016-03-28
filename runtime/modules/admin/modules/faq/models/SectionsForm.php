<?php
class SectionsForm extends CFormModel
{
    public $username;
    public function rules()
    {
        return array(
            array('title', 'required'),
        );
    }
}