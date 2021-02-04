<?php
class ControllerExtensionModuleAddressMapsNik extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/address_maps_nik');
        $this->load->model('setting/setting');

        $setting = $this->model_setting_setting->getSetting('address_maps_nik');

        $data = $setting;

		return $this->load->view('extension/module/address_maps_nik', $data);
	}
}