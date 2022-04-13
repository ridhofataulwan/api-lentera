<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'category';
    protected $primaryKey = 'category_id';

    public function getCategoryByID($category_id)
    {
        return
            $this->where(['category_id' => $category_id])
            ->get()->getResultArray();
    }
}
