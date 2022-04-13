<?php

namespace App\Controllers;

use App\Models\AudioModel;
use App\Models\ItemsModel;
use CodeIgniter\RESTful\ResourceController;

class Items extends ResourceController
{
    public function __construct()
    {
        $this->itemsModel = new ItemsModel();
        $this->audioModel = new AudioModel();
    }

    /**
     * -----------------------------------------------------------------------
     * title($api, $title)
     * -----------------------------------------------------------------------
     * Method untuk mencari items berdasarkan title
     */
    public function title($api, $title)
    {
        if (getenv('apiKey') == $api) {
            $items = $this->itemsModel->getItemsByTitle($title);
            $items = $this->setItemsArrayMap($items);
            $response = [
                'countOfItems'   => count($items),
                'items' => $items,
            ];
            if (!$items) {
                $response['message'] = 'Sorry ' . session()->get('users_username') . '. The book with title ' . $title . ' not found';
            }
            return $this->respond($response, 404);
        }
        $response = [
            'error'   => true,
            'message' => 'Your API Key is invalid',
        ];
        return $this->respond($response, 404
    );
    }

    /**
     * -----------------------------------------------------------------------
     * category($api, $category)
     * -----------------------------------------------------------------------
     * Method untuk mencari items berdasarkan category
     */
    public function category($api, $category)
    {
        if (getenv('apiKey') == $api) {
            $items = $this->itemsModel->getItemsByCategory($category);
            $items = $this->setItemsArrayMap($items);
            $response = [
                'countOfItems'   => count($items),
                'items' => $items,
            ];
            if (!$items) {
                $response['message'] = 'Sorry ' . session()->get('users_username') . '. The book with category ' . $category . ' not found';
            }
            return $this->respond($response, 404);
        }
        $response = [
            'error'   => true,
            'message' => 'Your API Key is invalid',
        ];
        return $this->respond($response, 404
    );
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
        if (getenv('apiKey') == $api) {
            $user_id = session()->get('user_id');
            $items = $this->itemsModel->getItemsByUser($user_id);
            $items = $this->setItemsArrayMap($items);
            $response = [
                'countOfItems'   => count($items),
                'items' => $items,
            ];
            if (!$items) {
                $response['message'] = 'Sorry ' . session()->get('users_username') . '. You have no history of access to books';
            }
            return $this->respond($response, 404);
        }
        $response = [
            'error'   => true,
            'message' => 'Your API Key is invalid',
        ];
        return $this->respond($response, 404
    );
    }

    /**
     * -----------------------------------------------------------------------
     * author($api, $author)
     * -----------------------------------------------------------------------
     * Method untuk mencari items berdasarkan author
     */
    public function author($api, $author)
    {
        if (getenv('apiKey') == $api) {
            $items = $this->itemsModel->getItemsByAuthor($author);
            $items = $this->setItemsArrayMap($items);
            $response = [
                'countOfItems'   => count($items),
                'items' => $items,
            ];
            if (!$items) {
                $response['message'] = 'Sorry ' . session()->get('users_username') . '. You have no history of access to books';
            }
            return $this->respond($response, 404);
        }
        $response = [
            'error'   => true,
            'message' => 'Your API Key is invalid',
        ];
        return $this->respond($response, 404
    );
    }

    /**
     * -----------------------------------------------------------------------
     * author($api, $items)
     * -----------------------------------------------------------------------
     * Method untuk mencari items berdasarkan author
     */
    public function audio($api, $items_id)
    {
        if (getenv('apiKey') == $api) {
            $item = $this->itemsModel->getItemByID($items_id);
            if (!$item) {
                $response['message'] = 'Sorry ' . session()->get('users_username') . '. The Book with id '.$items_id.' not found';
            }
            return $this->respond($response, 200);
            $audio = $this->audioModel->getAudioByItemID($items_id);
            // $audio = $this->aetAudioArrayMap($audio);
            $response = [
                'countOfAudio'   => count($audio),
                'item' => $this->setItemsArrayMap($item),
                'audio' => $this->setAudioArrayMap($audio),
            ];
            if (!$audio) {
                $response['message'] = 'Sorry ' . session()->get('users_username') . '. The Book with title ' . $item['items_title'].' have no audio';
            }
            return $this->respond($response, 200);
        }
        $response = [
            'error'   => true,
            'message' => 'Your API Key is invalid',
        ];
        return $this->respond($response, 404
    );
    }

    /**
     * -----------------------------------------------------------------------
     * setItemsArrayMap($items)
     * -----------------------------------------------------------------------
     * Method private untuk mengubah response JSON dari pencarian Items
     */
    private function setItemsArrayMap($items)
    {
        return array_map(function ($items) {
            $thumbnailURL = getenv('lenteraApp') . '/asset/items/thumbnail/' . $items['items_thumbnail'];
            $pdfURL = getenv('lenteraApp') . '/asset/items/pdf/' . $items['items_pdf'];
            if (!$items['items_thumbnail']) {
                $thumbnailURL = null;
            }
            if (!$items['items_pdf']) {
                $pdfURL = null;
            }
            return array(
                'id' => $items['items_id'],
                'title' => $items['items_title'],
                'slug' => $items['items_slug'],
                'category' => $items['category_name'],
                'isbn' => $items['items_isbn'],
                'authors' => $items['items_authors'],
                'publisher' => $items['items_publisher'],
                'publishDate' => $items['items_published_date'],
                'isbn' => $items['items_isbn'],
                'language' => $items['items_language'],
                'countOfChapter' => $items['items_chapter'],
                'countOfPage' => $items['items_page'],
                'countOfAccess' => $items['items_access_count'],
                'description' => $items['items_description'],
                'contributor' => [
                    'createdBy' => $items['items_created_by'],
                    'createdDate' => $items['items_created_date'],
                    'updatedBy' => $items['items_updated_by'],
                    'updatedDate' => $items['items_updated_date'],
                ],
                'source' => [
                    'thumbnail' => $thumbnailURL,
                    'pdf' => $pdfURL,
                ],
            );
        }, $items);
    }

    /**
     * -----------------------------------------------------------------------
     * setAudioArrayMap($items)
     * -----------------------------------------------------------------------
     * Method private untuk mengubah response JSON dari pencarian Audio berdasarkan Items ID
     */
    private function setAudioArrayMap($items)
    {
        return array_map(function ($audio) {
            $audioURL = getenv('lenteraApp') . '/asset/items/audio/' . $audio['audio_filename'];
            if (!$audio['audio_filename']) {
                $audioURL = null;
            }
            return array(
                'id' => $audio['audio_id'],
                'name' => $audio['audio_name'],
                'chapter' => $audio['audio_chapter'],
                'createdDate' => $audio['audio_created_date'],
                'itemsId' => $audio['items_id'],
                'contributor' => $audio['users_id_contribute'],
                'source' => $audioURL,
            );
        }, $items);
    }
}
