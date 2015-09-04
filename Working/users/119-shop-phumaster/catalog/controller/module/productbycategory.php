<?php
class ControllerModuleProductbycategory extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image'); 

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.transitions.css');
		$this->document->addStyle('catalog/view/theme/default/stylesheet/productbycategory.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['categories'] = array();

		$results = $this->model_catalog_category->getCategory($setting['category_id']);

		if ($results) {
			$data['categories'][] = array(
				'name' => $results['name'],
				'href' => $this->url->link('product/category', 'path=' . $results['category_id'])
			);

			$data['subcategories'] = array();

			$resultsb = $this->model_catalog_category->getCategories($results['category_id']);

			foreach ($resultsb as $result) {
				$data['subcategories'][] = array(
					'name'  => $result['name'] ,
					'href'  => $this->url->link('product/category', 'path=' . $result['category_id'])
				);
			}
			if (isset($this->request->get['filter'])) {
				$filter = $this->request->get['filter'];
			} else {
				$filter = '';
			}

			$data['style'] = $setting['style'];
			 
			$limit = $setting['limit'];
		 

			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}

			$category_id = $setting['category_id'];

			$data['products'] = array();
			
			$filter_data = array(
				'filter_category_id' => $category_id,
				'order'              => $order,
				 'filter_sub_category' => true, 
				'limit'              => $limit,
				'start'              => 0,
			);

			//$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

			$product = $this->model_catalog_product->getProducts($filter_data);

			foreach ($product as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $result['rating'],
					'href'        => $this->url->link('product/product', 'path=' . $category_id . '&product_id=' . $result['product_id'])
				);
			}
		}
		

 


		
 		
		$data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/productbycategory.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/productbycategory.tpl', $data);
		} else {
			return $this->load->view('default/template/module/productbycategory.tpl', $data);
		}
	}
}