<?php
class ControllerExtensionModuleAddressMapsNik extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/address_maps_nik');
        static $module = 0;

        $data = $setting;

        $data['module'] = $module++;

		return $this->load->view('extension/module/address_maps_nik', $data);
	}
}