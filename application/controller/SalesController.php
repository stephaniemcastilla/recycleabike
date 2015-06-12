<?php

class SalesController extends Controller
{
  
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Logged In
        Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('sales/index', array(
            'saless' => SalesModel::getAllSales()
        ));
    }

    public function create()
    {
        $sales_number = "1";//date('Y', Request::post('sales_date_in')) & date('m', Request::post('sales_date_in')) & date('d', Request::post('sales_date_in')) ;
        
        SalesModel::createSale($sales_number, Request::post('sales_make'), Request::post('sales_model'), Request::post('sales_color'), Request::post('sales_price'), Request::post('sales_serial'), Request::post('sales_photo'), Request::post('sales_source'), Request::post('sales_status'), Request::post('sales_date_in'), Request::post('sales_date_out'));
        Redirect::to('sales');
    }

    public function edit($sales_id)
    {
        $this->View->render('sales/edit', array(
            'sales' => SalesModel::getSale($sales_id)
        ));
    }

    public function editSave()
    {
        SalesModel::updateSale($sales_number, Request::post('sales_make'), Request::post('sales_model'), Request::post('sales_color'), Request::post('sales_price'), Request::post('sales_serial'), Request::post('sales_photo'), Request::post('sales_source'), Request::post('sales_status'), Request::post('sales_date_in'), Request::post('sales_date_out'));
        Redirect::to('sales');
    }

    public function delete($sales_id)
    {
        SalesModel::deleteSale($sales_id);
        Redirect::to('sales');
    }
}
