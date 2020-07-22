<?php
class ControllerCommonRules extends Controller
{
	public function index()
	{
		$data = [];
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$popo = true;
		$data['header'] = $this->load->controller('common/header', $popo);

		$this->response->setOutput($this->load->view('common/rules', $data));
	}
}
