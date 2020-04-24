<?php
class ControllerExtensionModuleCustomTheme extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/custom_theme');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('custom_theme', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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
			'href' => $this->url->link('extension/module/custom_theme', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/custom_theme', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['custom_theme_theme'])) {
			$data['custom_theme_theme'] = $this->request->post['custom_theme_theme'];
		} else {
			$data['custom_theme_theme'] = $this->config->get('custom_theme_theme');
		}

		if (isset($this->request->post['custom_theme_nav'])) {
			$data['custom_theme_nav'] = $this->request->post['custom_theme_nav'];
		} else {
			$data['custom_theme_nav'] = $this->config->get('custom_theme_nav');
		}

        if (isset($this->request->post['config_custom_js'])) {
            $data['config_custom_theme_js'] = $this->request->post['config_custom_theme_js'];
        } else {
            $data['config_custom_theme_js'] = html_entity_decode($this->config->get('config_custom_theme_js'), ENT_QUOTES, 'UTF-8');
        }
        if (isset($this->request->post['config_custom_theme_css'])) {
            $data['config_custom_theme_css'] = $this->request->post['config_custom_theme_css'];
        } else {
            $data['config_custom_theme_css'] = html_entity_decode($this->config->get('config_custom_theme_css'), ENT_QUOTES, 'UTF-8');
        }

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/custom_theme', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/custom_theme')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
