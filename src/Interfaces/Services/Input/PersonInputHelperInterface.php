<?php namespace Ixudra\Portfolio\Interfaces\Services\Input;


interface PersonInputHelperInterface {

    public function getDefaultInput($prefix = '');

    public function getInputForModel($model, $prefix = '');

}