<?php

namespace App\Controllers;

use App\Models\ItemsModel;
use App\Models\CategoryModel;
use CodeIgniter\RESTful\ResourceController;

class Items extends ResourceController
{
    public function __construct()
    {
        $this->itemsModel = new ItemsModel();
        $this->categoryModel = new CategoryModel();
    }

    /**
     * -----------------------------------------------------------------------
     * title($api, $title)
     * -----------------------------------------------------------------------
     * Method untuk mencari items berdasarkan title
     */
    public function title($api, $title)
    {
        if (getenv('apikey') == $api) {
            $items = $this->itemsModel->getItemsByTitle($title);
            $response = [
                'countOfItems'   => count($items),
                'items' => $items,
            ];
            return $this->respond($response, 200);
        }
        return $this->respond('error', 500);
    }

    /**
     * -----------------------------------------------------------------------
     * category($api, $category)
     * -----------------------------------------------------------------------
     * Method untuk mencari items berdasarkan category
     */
    public function category($api, $category)
    {
        if (getenv('apikey') == $api) {
            $items = $this->itemsModel->getItemsByCategory($category);
            $response = [
                'countOfItems'   => count($items),
                'items' => $items,
            ];            
            return $this->respond($response, 200);
        }
        return $this->respond('error', 500);
    }

    /**
     * -----------------------------------------------------------------------
     * history($api)
     * -----------------------------------------------------------------------
     * Method untuk mencari items berdasarkan user 
     * 
     * Parameter user diambil dari session
     */
    public function history($api)
    {
        if (getenv('apikey') == $api) {
            $user_id = session()->get('user_id');
            $items = $this->itemsModel->getItemsByUser($user_id);
            $response = [
                'countOfItems'   => count($items),
                'items' => $items,
            ];  
            return $this->respond($response, 200);
        }
        return $this->respond('error', 500);
    }
}
