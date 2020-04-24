<?php
class ControllerExtensionModuleSliderWithBanner extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/slider_with_banner');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('slider_with_banner', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['slider_width'])) {
			$data['error_slider_width'] = $this->error['slider_width'];
		} else {
			$data['error_slider_width'] = '';
		}

		if (isset($this->error['slider_height'])) {
			$data['error_slider_height'] = $this->error['slider_height'];
		} else {
			$data['error_slider_height'] = '';
		}

		if (isset($this->error['banner_width'])) {
			$data['error_banner_width'] = $this->error['banner_width'];
		} else {
			$data['error_banner_width'] = '';
		}

		if (isset($this->error['banner_height'])) {
			$data['error_banner_height'] = $this->error['banner_height'];
		} else {
			$data['error_banner_height'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/slider_with_banner', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/slider_with_banner', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/slider_with_banner', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/slider_with_banner', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['slider_id'])) {
			$data['slider_id'] = $this->request->post['slider_id'];
		} elseif (!empty($module_info)) {
			$data['slider_id'] = $module_info['slider_id'];
		} else {
			$data['slider_id'] = '';
		}

		if (isset($this->request->post['banner_id'])) {
			$data['banner_id'] = $this->request->post['banner_id'];
		} elseif (!empty($module_info)) {
			$data['banner_id'] = $module_info['banner_id'];
		} else {
			$data['banner_id'] = '';
		}

		$this->load->model('design/banner');

		$data['banners'] = $this->model_design_banner->getBanners();

		if (isset($this->request->post['slider_width'])) {
			$data['slider_width'] = $this->request->post['slider_width'];
		} elseif (!empty($module_info)) {
			$data['slider_width'] = $module_info['slider_width'];
		} else {
			$data['slider_width'] = '';
		}

		if (isset($this->request->post['slider_height'])) {
			$data['slider_height'] = $this->request->post['slider_height'];
		} elseif (!empty($module_info)) {
			$data['slider_height'] = $module_info['slider_height'];
		} else {
			$data['slider_height'] = '';
		}

		if (isset($this->request->post['banner_width'])) {
			$data['banner_width'] = $this->request->post['banner_width'];
		} elseif (!empty($module_info)) {
			$data['banner_width'] = $module_info['banner_width'];
		} else {
			$data['banner_width'] = '';
		}

		if (isset($this->request->post['banner_height'])) {
			$data['banner_height'] = $this->request->post['banner_height'];
		} elseif (!empty($module_info)) {
			$data['banner_height'] = $module_info['banner_height'];
		} else {
			$data['banner_height'] = '';
		}

		if (isset($this->request->post['effect'])) {
			$data['effect'] = $this->request->post['effect'];
		} elseif (!empty($module_info)) {
			$data['effect'] = $module_info['effect'];
		} else {
			$data['effect'] = '';
		}

		if (isset($this->request->post['autoplay'])) {
			$data['autoplay'] = $this->request->post['autoplay'];
		} elseif (!empty($module_info)) {
			$data['autoplay'] = $module_info['autoplay'];
		} else {
			$data['autoplay'] = '2500';
		}

		if (isset($this->request->post['speed'])) {
			$data['speed'] = $this->request->post['speed'];
		} elseif (!empty($module_info)) {
			$data['speed'] = $module_info['speed'];
		} else {
			$data['speed'] = '500';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/slider_with_banner', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/slider_with_banner')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->request->post['slider_width']) {
			$this->error['slider_width'] = $this->language->get('error_slider_width');
		}

		if (!$this->request->post['slider_height']) {
			$this->error['slider_height'] = $this->language->get('error_slider_height');
		}

		if (!$this->request->post['banner_width']) {
			$this->error['banner_width'] = $this->language->get('error_banner_width');
		}

		if (!$this->request->post['banner_height']) {
			$this->error['banner_height'] = $this->language->get('error_banner_height');
		}

		return !$this->error;
	}
}
