<?php
class ControllerExtensionModuleAddressMapsNik extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/address_maps_nik');

		$this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('address_maps_nik', $this->request->post);
            $this->model_setting_setting->editSetting('module_address_maps_nik', array('module_address_maps_nik_status' => $this->request->post['address_maps_nik_status']));

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['apikey'])) {
			$data['error_apikey'] = $this->error['apikey'];
		} else {
			$data['error_apikey'] = '';
		}

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

		if (isset($this->error['class_map_loader'])) {
			$data['error_class_map_loader'] = $this->error['class_map_loader'];
		} else {
			$data['error_class_map_loader'] = '';
		}

		if (isset($this->error['input_address'])) {
			$data['error_input_address'] = $this->error['input_address'];
		} else {
			$data['error_input_address'] = '';
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
				'href' => $this->url->link('extension/module/address_maps_nik', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/address_maps_nik', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/address_maps_nik', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/address_maps_nik', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$module_info = $this->model_setting_setting->getSetting('address_maps_nik');
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->post['address_maps_nik_name'])) {
			$data['address_maps_nik_name'] = $this->request->post['address_maps_nik_name'];
		} elseif (!empty($module_info)) {
			$data['address_maps_nik_name'] = $module_info['address_maps_nik_name'];
		} else {
			$data['address_maps_nik_name'] = '';
		}

        if (isset($this->request->post['address_maps_nik_apikey'])) {
            $data['address_maps_nik_apikey'] = $this->request->post['address_maps_nik_apikey'];
        } elseif (!empty($module_info)) {
            $data['address_maps_nik_apikey'] = $module_info['address_maps_nik_apikey'];
        } else {
            $data['address_maps_nik_apikey'] = '';
        }

		if (isset($this->request->post['address_maps_nik_class_map_loader'])) {
			$data['address_maps_nik_class_map_loader'] = $this->request->post['address_maps_nik_class_map_loader'];
		} elseif (!empty($module_info)) {
			$data['address_maps_nik_class_map_loader'] = $module_info['address_maps_nik_class_map_loader'];
		} else {
			$data['address_maps_nik_class_map_loader'] = '';
		}

		if (isset($this->request->post['address_maps_nik_input_address'])) {
			$data['address_maps_nik_input_address'] = $this->request->post['address_maps_nik_input_address'];
		} elseif (!empty($module_info)) {
			$data['address_maps_nik_input_address'] = $module_info['address_maps_nik_input_address'];
		} else {
			$data['address_maps_nik_input_address'] = '';
		}

		if (isset($this->request->post['address_maps_nik_input_address_type'])) {
			$data['address_maps_nik_input_address_type'] = $this->request->post['address_maps_nik_input_address_type'];
		} elseif (!empty($module_info)) {
			$data['address_maps_nik_input_address_type'] = $module_info['address_maps_nik_input_address_type'];
		} else {
			$data['address_maps_nik_input_address_type'] = '0';
		}

		if (isset($this->request->post['address_maps_nik_status'])) {
			$data['address_maps_nik_status'] = $this->request->post['address_maps_nik_status'];
		} elseif (!empty($module_info)) {
			$data['address_maps_nik_status'] = $module_info['address_maps_nik_status'];
		} else {
			$data['address_maps_nik_status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/address_maps_nik', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/address_maps_nik')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['address_maps_nik_name']) < 3) || (utf8_strlen($this->request->post['address_maps_nik_name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (utf8_strlen($this->request->post['address_maps_nik_apikey']) < 3) {
			$this->error['apikey'] = $this->language->get('error_apikey');
		}

		if (!$this->request->post['address_maps_nik_class_map_loader']) {
			$this->error['class_map_loader'] = $this->language->get('error_class_map_loader');
		}

		if (!$this->request->post['address_maps_nik_input_address']) {
			$this->error['input_address'] = $this->language->get('error_input_address');
		}

		return !$this->error;
	}
}
