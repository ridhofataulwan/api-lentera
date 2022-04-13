<?php

namespace App\Models;

use CodeIgniter\Model;

class AudioModel extends Model
{
    protected $table            = 'audio';
    protected $primaryKey       = 'audio_id';

    public function getAudioByItemID($items_id)
    {
        return
            $this
            ->where('items_id', $items_id)
            ->get()->getResultArray();
    }
}
