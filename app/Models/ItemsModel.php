<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemsModel extends Model
{
    protected $table      = 'items';
    protected $primaryKey = 'items_id';

    public function getItemsByTitle($title)
    {
        return
            $this->join('category', 'items.category_id=category.category_id')
            ->like(['items_title' => $title])
            ->get()->getResultArray();
    }

    public function getItemsByCategory($category)
    {
        return
            $this->join('category', 'items.category_id=category.category_id')
            ->like(['category_name' => $category])
            ->get()->getResultArray();
    }

    public function getItemsByUser($user_id)
    {
        return
            $this->setTable('users')
            ->join('history', 'users.users_id=history.users_id')
            ->join('audio', 'history.audio_id=audio.audio_id')
            ->join('items', 'audio.items_id=items.items_id')
            ->where(['user_id' => $user_id])
            ->get()->getResultArray();
    }
}
