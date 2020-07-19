<?php
class ControllerCommonRightfloatmenu extends Controller
{
	public function index()
	{
		$data = [];
		$data['contact'] = $this->url->link('information/contact');
		$data['account'] = $this->url->link('account/account', '', true);
		return $this->load->view('common/rightfloatmenu', $data);
	}
}
