<?php
Route::post(config('jraty.route'), function()
{
    $data = [
        'item_id'    => Request::get('item_id'),
        'score'      => Request::get('score'),
        'added_on'   => DB::raw('NOW()'),
        'ip_address' => Request::getClientIp()
    ];
    Jraty::add($data);
});

