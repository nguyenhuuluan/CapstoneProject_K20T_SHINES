<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;

class TagController extends Controller
{
	public function getTags()
	{
		$tags = Tag::all('name');

		$arrTags = Array();

		foreach ($tags as $tag) {
			$arrTags[] = $tag["name"];
		}

		//return $tags;

		return response()->json(
			$arrTags
		);

		//return $arrTags;
	}
}
