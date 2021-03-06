<?php namespace Ixudra\Portfolio\Http\Controllers;


use Ixudra\Core\Http\Controllers\BaseController;
use Ixudra\Portfolio\Interfaces\Repositories\CustomerRepositoryInterface;
use Ixudra\Portfolio\Interfaces\Services\Factories\CompanyFactoryInterface;
use Ixudra\Portfolio\Interfaces\Services\Factories\PersonFactoryInterface;
use Ixudra\Portfolio\Interfaces\Services\Html\CustomerViewFactoryInterface;
use Ixudra\Portfolio\Http\Requests\Customers\CreateCustomerFormRequest;
use Ixudra\Portfolio\Http\Requests\Customers\FilterCustomerFormRequest;
use Ixudra\Portfolio\Http\Requests\Customers\UpdateCustomerFormRequest;

use App;
use Translate;

class CustomerController extends BaseController {

    protected $customerRepository;

    protected $customerViewFactory;


    public function __construct(CustomerRepositoryInterface $customerRepository, CustomerViewFactoryInterface $customerViewFactory)
    {
        $this->customerRepository = $customerRepository;
        $this->customerViewFactory = $customerViewFactory;
    }


    public function index()
    {
        return $this->customerViewFactory->index();
    }

    public function filter(FilterCustomerFormRequest $request)
    {
        return $this->customerViewFactory->index( $request->getInput() );
    }

    public function create()
    {
        return $this->customerViewFactory->create();
    }

    public function store(CreateCustomerFormRequest $request)
    {
        $customerType = $request->input('customerType');
        $object = $this->getFactory( $customerType )->make( $request->getInput(), $customerType );

        return $this->redirect( 'admin.customers.show', array('id' => $object->customer->id), 'success', array( Translate::model( 'portfolio::customer.create.success' ) ) );
    }

    public function show($id)
    {
        $customer = $this->customerRepository->find( $id );
        if( is_null($customer) ) {
            return $this->modelNotFound();
        }

        return $this->customerViewFactory->show( $customer );
    }

    public function edit($id)
    {
        $customer = $this->customerRepository->find( $id );
        if( is_null($customer) ) {
            return $this->modelNotFound();
        }

        return $this->customerViewFactory->edit( $customer );
    }

    public function update($id, UpdateCustomerFormRequest $request)
    {
        $customer = $this->customerRepository->find( $id );
        if( is_null($customer) ) {
            return $this->modelNotFound();
        }

        $customerType = $request->input('customerType');
        $this->getFactory( $customerType )->modify( $customer->object, $request->getInput(), $customerType );

        return $this->redirect( 'admin.customers.show', array('id' => $id), 'success', array( Translate::model( 'portfolio::customer.edit.success' ) ) );
    }

    public function destroy($id)
    {
        $customer = $this->customerRepository->find( $id );
        if( is_null($customer) ) {
            return $this->modelNotFound();
        }

        try {
            $customer->object->delete();
        } catch(\Exception $e) {
            return $this->redirect( 'admin.customers.show', array($customer->id), 'error', array( Translate::recursive( $e->getMessage() ) ) );
        }

        return $this->redirect( 'admin.customers.index', array(), 'success', array( Translate::model( 'portfolio::customer.delete.success' ) ) );
    }

    protected function modelNotFound()
    {
        return $this->redirect( 'admin.customers.index', array(), 'error', array( Translate::model( 'portfolio::customer.error.notFound' ) ) );
    }

    protected function getFactory($customerType)
    {
        $factory = CompanyFactoryInterface::class;
        if( $customerType === 'person' ) {
            $factory = PersonFactoryInterface::class;
        }

        return App::make( $factory );
    }

}
