<?php
class ControllerExtensionModuleAccountSidebar extends Controller {
	private $ssl;

	public function __construct($resgistry) {
		parent::__construct($resgistry);
		$this->ssl = true;

		if(VERSION <= '2.1.0.2') {
			$this->ssl = 'SSL';
		}
	}

	public function index() {
		$this->load->language('extension/module/account_sidebar');

		$this->load->model('account/customer');

		$this->document->addStyle('catalog/view/theme/default/stylesheet/accountdashboard/sidebar.css');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['logged'] = $this->customer->isLogged();
		$this->load->model('setting/setting');


		// Affiliate Links
		$affiliate_info = $this->model_account_customer->getAffiliate($this->customer->getId());
		if(empty($affiliate_info)) {
			$affiliate_account = 3;
		} else {
			$affiliate_account = 4;
		}

		$data['main_links'] = array();
		$links = (array)$this->config->get('module_account_sidebar_title');
		foreach ($links as $parent_link) {
			if($parent_link['status']) {
				$children_links = array();

				if(!empty($parent_link['link_title'])) {
					foreach ($parent_link['link_title'] as $children_link) {
						if ($children_link['logged'] != '9') {

							if($this->customer->isLogged()) {
								$mylogged = '1'; // Logged In
							} else{
								$mylogged = '0'; // Logged Not
							}

							if($children_link['logged'] == $mylogged  || $children_link['logged'] == '2') {
								$children_links[] = array(
										'title' 	=> isset($children_link['module_account_sidebar_link_title_description'][$this->config->get('config_language_id')]['name']) ? $children_link['module_account_sidebar_link_title_description'][$this->config->get('config_language_id')]['name'] : '',
										'link' 		=> $children_link['link'],
										'iconclass' => $children_link['iconclass'],
										'logged' 	=> $children_link['logged'],
								);
							}

							if($children_link['logged'] == $affiliate_account) {
								$children_links[] = array(
										'title' 	=> isset($children_link['module_account_sidebar_link_title_description'][$this->config->get('config_language_id')]['name']) ? $children_link['module_account_sidebar_link_title_description'][$this->config->get('config_language_id')]['name'] : '',
										'link' 		=> $children_link['link'],
										'iconclass' => $children_link['iconclass'],
										'logged' 	=> $children_link['logged'],
								);
							}
						}
					}
				}

				if ($children_links) {
					$data['main_links'][] = array(
						'title' 			=> isset($parent_link['description'][$this->config->get('config_language_id')]['title']) ? $parent_link['description'][$this->config->get('config_language_id')]['title'] : '',
						'sort_order' 		=> $parent_link['sort_order'],
						'children_links' 	=> $children_links,
					);
				}
			}
		}

		$data['module_account_sidebar_titlebgcolor'] = $this->config->get('module_account_sidebar_titlebgcolor');
		$data['module_account_sidebar_titlecolor'] = $this->config->get('module_account_sidebar_titlecolor');
		$data['module_account_sidebar_linkbgcolor'] = $this->config->get('module_account_sidebar_linkbgcolor');
		$data['module_account_sidebar_linkcolor'] = $this->config->get('module_account_sidebar_linkcolor');
		$data['module_account_sidebar_hoverbgcolor'] = $this->config->get('module_account_sidebar_hoverbgcolor');
		$data['module_account_sidebar_hovercolor'] = $this->config->get('module_account_sidebar_hovercolor');


		usort($data['main_links'], array($this, 'sidebarsort'));

		if($data['main_links']) {
			return $this->load->view('extension/module/account_sidebar', $data);
		}
	}

	public function sidebarsort($a, $b) {
	    return $a['sort_order'] - $b['sort_order'];
	}

}