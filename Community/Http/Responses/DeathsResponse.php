<?php

namespace Bitaac\Community\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class DeathsResponse implements Responsable
{
    /**
     * Get deaths per page.
     *
     * @return integer
     */
    public function perPage()
    {
        return config('bitaac.community.deaths-per-page', 10);
    }

    /**
     * Get all the deaths.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function deaths()
    {
        $deaths = app('death')->orderBy('time', 'desc');

        return config('bitaac.community.deaths-pagination', true) ? $deaths->paginate($this->perPage()) : $deaths->limit($this->perPage())->get();
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return view('bitaac::community.deaths')->with([
            'deaths' => $this->deaths(),
        ]);
    }
}
