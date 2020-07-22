<?php
class ControllerCheckoutBid extends Controller
{
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
        $data['bid_time'] = $time_now;

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

        if (isset($this->request->post['bid_auto'])) {
            $bid_auto = (int) $this->request->post['bid_auto'];
        } else {
            $bid_auto = 0;
        }


        $win_is_new = false;

        if ($bid_auto == 1) { // 自動出價
            while ($data['price_now'] <= $data['bid_max'] && $data['price_now'] <= $new_price) {
                $win_is_new = !$win_is_new;
                $data['price_now'] += $data['price_minadd'];
            }
            if ($win_is_new) {
                $data['bid_count'] = $data['bid_count'] + 1;
            } else {
                $data['bid_count'] = $data['bid_count'] + 2;
            }
        } else { // 直接出價
            if ($new_price + $data['price_minadd'] <= $data['bid_max']) {
                $data['price_now'] = $new_price + $data['price_minadd'];
                $data['bid_count'] = $data['bid_count'] + 2;
            } else {
                $data['price_now'] = $new_price;
                $data['bid_count'] = $data['bid_count'] + 1;
                $win_is_new = true;
            }
        }

        if ($win_is_new) {
            $data['bid_max'] = $new_price;
            $data['bid_user_id'] = $this->customer->getId();
        }

        $this->model_catalog_product->newProductBid($product_id, $data);
        $json['success'] = 'success';

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
