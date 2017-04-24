<?php

namespace Bitaac\Store\Models;

use Bitaac\Core\Database\Eloquent\Model;
use Bitaac\Contracts\StoreProduct as Contract;

class StoreProduct extends Model implements Contract
{
    protected $table = '__bitaac_store_products';

    public function imageIsLink()
    {
        return (bool) filter_var($this->image, FILTER_VALIDATE_URL);
    }
}
