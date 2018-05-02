<?php

namespace App\Events;

use App\Recruitment;
use Auth;
use Session;
use Illuminate\Session\Store;

class ViewRecruitmentHandler
{
    

	private $session;

	public function __construct(Store $session)
	{
		$this->session = $session;
	}

	public function handle(Recruitment $recruitment)
	{
		if (!$this->isRecruitmentViewed($recruitment))
		{
			if (Auth::user() == null ) {
       //$recruitment->number_of_anonymous_view = $recruitment->number_of_anonymous_view + 1;
				$recruitment->increment('number_of_anonymous_view');
			}elseif (Auth::user()->isStudent()) {
      // $recruitment->number_of_view = $recruitment->number_of_view + 1;
				$recruitment->increment('number_of_view');
			}else{
    // $recruitment->number_of_anonymous_view = $recruitment->number_of_anonymous_view + 1;
				$recruitment->increment('number_of_anonymous_view');
			}
			$recruitment->update();

			
		}
		$this->storeRecruitment($recruitment);
	}

	private function isRecruitmentViewed($recruitment)
	{
		$viewed = $this->session->get('viewed_recruitments', []);

		return array_key_exists($recruitment->id, $viewed);
	}

	private function storeRecruitment($recruitment)
	{
		$key = 'viewed_recruitments.' . $recruitment->id;

		$this->session->put($key, time());
	}
}
