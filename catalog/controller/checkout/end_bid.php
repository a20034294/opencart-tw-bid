<?php
class ControllerCheckoutEndBid extends Controller
{

    public function index()
    {
        $this->load->model('catalog/product');
        $this->config->load('bid');
        $time_now = date('Y-m-d H:i:s', time());
        $data = $this->model_catalog_product->getProductEndBid($time_now);

        foreach ($data as $bid) {
            $this->model_catalog_product->closeProduct($bid['product_id']);
            $bid['bid_status'] = STATUS_END_BID;
            $this->model_catalog_product->newProductBid($bid['product_id'], $bid);
            $cells = $this->model_catalog_product->getProductBidCells(['product_id' => $bid['product_id']]);
            if ($cells == NULL) {
                continue;
            }
            $winner = $cells[0];
            print_r($winner);
            $winner['bid_status'] = STATUS_WIN_BID;
            $cells = $this->model_catalog_product->updateProductBidCell($winner);
        }

        $data = $this->model_catalog_product->getProductEndBid('2050-10-10 05:05:05');
        $output = var_export($data, true);


        $this->response->setOutput($output);
    }
}
