<?php
class ControllerCheckoutBid extends Controller
{
    private function swap(&$x, &$y)
    {
        $tmp = $x;
        $x = $y;
        $y = $tmp;
    }
    public function add()
    {
        $json = array();

        if (isset($this->request->post['product_id'])) {
            $product_id = (int) $this->request->post['product_id'];
        } else {
            $product_id = 0;
        }

        if (!$this->customer->isLogged()) {
            $json['error']['login'] = '請先登入';
            $this->session->data['redirect'] = $this->url->link('product/product', '', true) . '&product_id=' . $product_id;
            $json['redirect'] = $this->url->link('account/login', '', true);

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
            return;
        }

        $this->load->model('catalog/product');
        $data = $this->model_catalog_product->getProductBid($product_id);
        $time_now = date('Y-m-d H:i:s', time());

        if ($time_now > $data['bid_endtime']) {
            $json['error']['time_exceed'] = '超過截標時間';

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
            return;
        }

        if (isset($this->request->post['new_price'])) {
            $new_price = (int) $this->request->post['new_price'];
        } else {
            $new_price = 0;
        }

        if ($new_price < $data['price_now'] + $data['price_minadd']) {
            $json['error']['price_low'] = '出價增額低於要求';

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
            return;
        }

        if ($this->customer->getId() == $data['bid_user_id'] && $new_price <= $data['bid_max']) {
            $json['error']['duplicate'] = '出價低於自身自動出價';

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
            return;
        }



        $data['bid_time'] = $time_now;

        $this->config->load('bid');
        if ($this->request->post['bid_auto'] == 1) {
            $data['bid_auto'] = AUTO_BID;
        } else {
            $data['bid_auto'] = NOT_AUTO_BID;
        }

        $new_bid_user = $this->customer->getId();

        if ($new_bid_user == $data['bid_user_id']) {
            $data['bid_max'] = $new_price;
            if (!$data['bid_auto']) {
                $data['price_now'] = $new_price;
                $data['bid_count'] = $data['bid_count'] + 1;
                $this->model_catalog_product->addProductBidCell($product_id, $data);
            }
            $this->model_catalog_product->newProductBid($product_id, $data);
            $json['success'] = 'success';
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
            return;
        }

        $data['price_now'] = $data['bid_auto'] ? $data['price_now'] + $data['price_minadd'] : $new_price;
        $data['bid_count'] = $data['bid_count'] + 1;
        $this->swap($data['bid_user_id'], $new_bid_user);
        $this->swap($data['bid_max'], $new_price);
        $this->model_catalog_product->addProductBidCell($product_id, $data);

        while ($data['price_now'] + $data['price_minadd'] <= $new_price) {
            $data['bid_auto'] = 1;
            $data['price_now'] += $data['price_minadd'];
            $data['bid_count'] = $data['bid_count'] + 1;
            $this->swap($data['bid_user_id'], $new_bid_user);
            $this->swap($data['bid_max'], $new_price);
            $this->model_catalog_product->addProductBidCell($product_id, $data);
        }

        $this->model_catalog_product->newProductBid($product_id, $data);
        $json['success'] = 'success';

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
