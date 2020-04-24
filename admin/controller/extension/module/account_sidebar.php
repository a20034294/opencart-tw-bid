<?php
class ControllerExtensionModuleAccountSideBar extends Controller {
	private $error = array();

	public function install() {
		$file = DIR_CONFIG . 'accountdashboard/account_sidebar.php';

		if (file_exists($file)) {
			$_ = array();	   
			require($file);

	   		$this->load->model('setting/setting');
   			$this->model_setting_setting->editSetting('module_account_sidebar', $_);
		}		
	}

	public function index() {
		$this->load->language('extension/module/account_sidebar');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('view/javascript/ciaccountdashboard/colorpicker/css/colorpicker.css');
  		$this->document->addScript('view/javascript/ciaccountdashboard/colorpicker/js/colorpicker.js');

		$this->load->model('setting/setting');

		if(isset($this->request->get['store_id'])) {
			$store_id = $this->request->get['store_id'];
		}else{
			$store_id = 0;
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_account_sidebar', $this->request->post, $store_id);	

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['link_title'])) {
			$data['error_link_title'] = $this->error['link_title'];
		} else {
			$data['error_link_title'] = array();
		}

		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = array();
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

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/account_sidebar', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['store_id'] = $store_id;

		if(isset($store_id)) {
			$data['action'] = $this->url->link('extension/module/account_sidebar', 'user_token=' . $this->session->data['user_token'] . '&store_id='. $store_id, true);
		} else{
			$data['action'] = $this->url->link('extension/module/account_sidebar', 'user_token=' . $this->session->data['user_token'], true);
		}	

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$module_info = $this->model_setting_setting->getSetting('module_account_sidebar',  $store_id);
		}	

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['module_account_sidebar_status'])) {
			$data['module_account_sidebar_status'] = $this->request->post['module_account_sidebar_status'];
		} elseif (!empty($module_info)) {
			$data['module_account_sidebar_status'] = $module_info['module_account_sidebar_status'];
		} else {
			$data['module_account_sidebar_status'] = '';
		}
		if (isset($this->request->post['module_account_sidebar_titlebgcolor'])) {
			$data['module_account_sidebar_titlebgcolor'] = $this->request->post['module_account_sidebar_titlebgcolor'];
		} elseif (!empty($module_info)) {
			$data['module_account_sidebar_titlebgcolor'] = $module_info['module_account_sidebar_titlebgcolor'];
		} else {
			$data['module_account_sidebar_titlebgcolor'] = '';
		}
		if (isset($this->request->post['module_account_sidebar_titlecolor'])) {
			$data['module_account_sidebar_titlecolor'] = $this->request->post['module_account_sidebar_titlecolor'];
		} elseif (!empty($module_info)) {
			$data['module_account_sidebar_titlecolor'] = $module_info['module_account_sidebar_titlecolor'];
		} else {
			$data['module_account_sidebar_titlecolor'] = '';
		}
		if (isset($this->request->post['module_account_sidebar_linkbgcolor'])) {
			$data['module_account_sidebar_linkbgcolor'] = $this->request->post['module_account_sidebar_linkbgcolor'];
		} elseif (!empty($module_info)) {
			$data['module_account_sidebar_linkbgcolor'] = $module_info['module_account_sidebar_linkbgcolor'];
		} else {
			$data['module_account_sidebar_linkbgcolor'] = '';
		}
		if (isset($this->request->post['module_account_sidebar_linkcolor'])) {
			$data['module_account_sidebar_linkcolor'] = $this->request->post['module_account_sidebar_linkcolor'];
		} elseif (!empty($module_info)) {
			$data['module_account_sidebar_linkcolor'] = $module_info['module_account_sidebar_linkcolor'];
		} else {
			$data['module_account_sidebar_linkcolor'] = '';
		}
		if (isset($this->request->post['module_account_sidebar_hoverbgcolor'])) {
			$data['module_account_sidebar_hoverbgcolor'] = $this->request->post['module_account_sidebar_hoverbgcolor'];
		} elseif (!empty($module_info)) {
			$data['module_account_sidebar_hoverbgcolor'] = $module_info['module_account_sidebar_hoverbgcolor'];
		} else {
			$data['module_account_sidebar_hoverbgcolor'] = '';
		}
		if (isset($this->request->post['module_account_sidebar_hovercolor'])) {
			$data['module_account_sidebar_hovercolor'] = $this->request->post['module_account_sidebar_hovercolor'];
		} elseif (!empty($module_info)) {
			$data['module_account_sidebar_hovercolor'] = $module_info['module_account_sidebar_hovercolor'];
		} else {
			$data['module_account_sidebar_hovercolor'] = '';
		}
		if (isset($this->request->post['module_account_sidebar_hovercolor'])) {
			$data['module_account_sidebar_hovercolor'] = $this->request->post['module_account_sidebar_hovercolor'];
		} elseif (!empty($module_info)) {
			$data['module_account_sidebar_hovercolor'] = $module_info['module_account_sidebar_hovercolor'];
		} else {
			$data['module_account_sidebar_hovercolor'] = '';
		}

		if (isset($this->request->post['module_account_sidebar_title'])) {
			$titles = $this->request->post['module_account_sidebar_title'];
		} elseif (!empty($module_info)) {
			$titles = (!empty($module_info['module_account_sidebar_title'])) ? (array)$module_info['module_account_sidebar_title'] : array();
		} else {
			$titles = array();
		}

		function titlesSort($a, $b) {
		    return $a['sort_order'] - $b['sort_order'];
		}

		uasort($titles, 'titlesSort');

		$data['titles'] = array();
		
		foreach($titles as $key =>  $title) {			

			$data['titles'][$key] = array(
				'link_title'		=> isset($title['link_title']) ?  $title['link_title'] : array(),
				'description'		=> isset($title['description']) ?  $title['description'] : array(),
				'status'			=> isset($title['status']) ?  $title['status'] : '',
				'sort_order'		=> isset($title['sort_order']) ?  $title['sort_order'] : '',
			);
		}

		$data['config_language_id'] = $this->config->get('config_language_id');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/account_sidebar', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/account_sidebar')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['module_account_sidebar_title'])) {
			foreach ($this->request->post['module_account_sidebar_title'] as $row => $description) {
				
				foreach ($description['description'] as $language_id => $value) {
					if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 128)) {
						$this->error['title'][$row][$language_id] = $this->language->get('error_title');
					}
				}
				if(isset($description['link_title'])) {
					foreach ($description['link_title'] as $link_title_row => $link_title) {
						foreach ($link_title['module_account_sidebar_link_title_description'] as $language_id => $link_title_description) {
						
							if ((utf8_strlen($link_title_description['name']) < 1) || (utf8_strlen($link_title_description['name']) > 128)) {
								$this->error['link_title'][$row][$link_title_row][$language_id] = $this->language->get('error_link_title');
							}
						}
					}
				}
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
}