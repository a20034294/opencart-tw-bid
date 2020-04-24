<?php
class ControllerExtensionModuleSliderWithBanner extends Controller {
	public function index($setting) {
		static $module = 0;		

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		$this->document->addStyle('catalog/view/javascript/jquery/swiper/css/swiper.min.css');
		$this->document->addStyle('catalog/view/theme/simplica/stylesheet/swiper.opencart.css');
		$this->document->addScript('catalog/view/javascript/jquery/swiper/js/swiper.jquery.js');
		
		$data['sliders'] = array();
		$results = $this->model_design_banner->getBanner($setting['slider_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['sliders'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['slider_width'], $setting['slider_height'])
				);
			}
		}
		$data['effect'] = $setting['effect'];
		$data['autoplay'] = $setting['autoplay'];
		$data['speed'] = $setting['speed'];

		$data['banners'] = array();
		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['banner_width'], $setting['banner_height'])
				);
			}
		}

		$data['module'] = $module++;

		return $this->load->view('extension/module/slider_with_banner', $data);
	}
}