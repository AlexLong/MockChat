<?php
/**
 * 
 * User: Windows
 * Date: 3/3/14
 * Time: 7:37 PM
 * 
 */

namespace MockChat\Form;






use Zend\Form\Form;

class PictureForm extends Form {


    protected $underDev = false;


    protected $pictureModel;

    public function __construct(){
        parent::__construct('picture_form');

        $this->add(array(
            'name' => 'profile_picture',
            'type' => 'File',

            'options' => array(
                'label' => 'Your Picture',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'autocomplete' => 'off',
                'id' => 'profile_picture'
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Save',
                'id' => 'submitbutton',
                'class' => 'btn btn-default'
            ),
        )
       );

    }









} 