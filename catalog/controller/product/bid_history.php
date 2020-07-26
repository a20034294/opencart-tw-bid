<?php
class ControllerProductBidHistory extends Controller
{
    public function index($limit = [])
    {
        $data['histories'] = array_reverse($this->model_catalog_product->getProductBidCells($limit));
        //return var_export($limit, true);
        return $this->load->view('product/bid_history', $data);
    }
}
