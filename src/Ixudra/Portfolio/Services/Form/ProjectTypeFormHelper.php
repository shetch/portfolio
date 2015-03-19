<?php namespace Ixudra\Portfolio\Services\Form;


use App;

use Ixudra\Core\Services\Form\BaseFormHelper;

class ProjectTypeFormHelper extends BaseFormHelper {

    protected $repository;


    public function __construct()
    {
        $this->repository = App::make('\Ixudra\Portfolio\Repositories\Eloquent\EloquentProjectTypeRepository');
    }

}