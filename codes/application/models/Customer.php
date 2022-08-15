<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Model {

    public function fetch_all_categories() {
        $this->db->select("categories.name as name, count(products.name) as count")
        ->join("products", "categories.id = products.category_id")
        ->group_by("products.category_id");
        $query = $this->db->get('categories')->result_array();
        return $query;
    }

    public function get_all_products() {
        $this->db->select('products.id as id, name, description, price, inventory_count, quantity_sold, filename')
            ->from('products')
            ->join('images', 'images.product_id = products.id')
            ->group_by('images.product_id');
            // ->limit($rowperpage, $rowno);  
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function product_detail($id) {
                // $this->output->enable_profiler(TRUE);
        $this->db->where('id', $id);
        $query = $this->db->get('products')->result_array();
        return $query[0];
    }

    public function fetch_images($product_id) {
        $query = $this->db->where('product_id', $product_id)->get('images')->result_array();
        return $query;
    }
}


?>