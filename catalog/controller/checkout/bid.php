<?php
class ControllerCheckoutBid extends Controller {
	public function add() {
        $json = array();
        if (isset($this->request->post['product_id'])) {
			$product_id = (int)$this->request->post['product_id'];
		} else {
			$product_id = 0;
        }
        if (!$this->customer->isLogged()) {
            $json['error']['login'] = '請先登入';
            $this->session->data['redirect'] = $this->url->link('product/product', '', true) . '&product_id=' . $product_id;
            $json['redirect'] = $this->url->link('account/login', '', true);
		}
        

        $json['product_id'] = $product_id;
        $this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
    }
}