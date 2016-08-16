<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Cache;

class HomeController extends Controller
{
    public function index() {
    	$categories = $this->createArray();
    	$textData = $this->fieldFill();
    	$cachedData = $this->fetchCache();

    	return view('home', compact('categories', 'textData','cachedData'));
    }

    public function process(Request $request) {
    	Cache::flush();
    	$data = $request->input();
    	Cache::forever('survey', $data);
    	echo '<pre>';
    	print_r($data);
    	echo '</pre>';

    	return $this->index();
    }

    private function fieldFill() {
    	$array = array(
    		'header' => 'Instructions',
    		'instructions' => '<li>Example</li>',
    		'finishHeader' => 'Complete',
    		'confirmationText' => 'Confirm'
    		);
    	return $array;
    }

    private function createArray() {
    	$array = array(
    		'Category_1' => array( 
					'name'  => 'Field',
					'name2' => 'Field 2'
				),
    		'Category_2' => array( 
					'name'  => 'Field',
					'name2' => 'Field 2'
				),
			);
    	return $array;
    }

    private function fetchCache() {
    	if (Cache::has('survey')) {
    		$data = Cache::get('survey');
    	} else {
    		$array = $this->createArray();
    		foreach ($array as $key => $categories) {
    			foreach ($categories as $key2 => $field) {
    				$data[str_replace(' ', '_', $key.' '.$key2)] = '';
    			}
    		}
    	}

    	return $data;
    }
}
