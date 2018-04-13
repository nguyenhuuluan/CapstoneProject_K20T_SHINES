<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class Filter
{
   private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $recruitments = $this->getViewedRecruitments();

        if (!is_null($recruitments))
        {
            $recruitments = $this->cleanExpiredViews($recruitments);
            $this->storeRecruitments($recruitments);
        }

        return $next($request);
    }

    private function getViewedRecruitments()
    {
        return $this->session->get('viewed_recruitments', null);
    }

    private function cleanExpiredViews($recruitments)
    {
        $time = time();

        // Let the views expire after one hour.
        $throttleTime = 1800;

        return array_filter($recruitments, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storeRecruitments($recruitments)
    {
        $this->session->put('viewed_recruitments', $recruitments);
    }
}
