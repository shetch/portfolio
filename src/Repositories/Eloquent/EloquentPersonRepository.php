<?php namespace Ixudra\Portfolio\Repositories\Eloquent;


use Ixudra\Core\Repositories\Eloquent\BaseEloquentRepository;
use Ixudra\Portfolio\Interfaces\Repositories\PersonRepositoryInterface;

use Config;

class EloquentPersonRepository extends BaseEloquentRepository implements PersonRepositoryInterface {

    protected function getModel()
    {
        $className = Config::get('bindings.models.person');

        return new $className;
    }

    protected function getTable()
    {
        return 'people';
    }


    public function search($filters, $size = 25)
    {
        $results = $this->getModel();

        if( array_key_exists('query', $filters) && !empty($filters[ 'query' ]) ) {
            $results = $results
                ->where('first_name', 'like', $filters[ 'query' ])
                ->orWhere('last_name', 'like', $filters[ 'query' ])
                ->orWhere('email', 'like', $filters[ 'query' ]);
        }

        return $this->paginated($results, $filters, $size);
    }

}
