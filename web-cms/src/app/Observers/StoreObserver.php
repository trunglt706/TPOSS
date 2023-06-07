<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Stores\Entities\Stores;

class StoreObserver
{

    public function creating(Stores $store)
    {
        $store->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $store->code = $store->code ?? Stores::get_code_default();
        $store->status = $store->status ?? Stores::STATUS_UN_ACTIVE;
        if (!$store->currency) {
            $store->currency = get_option('currency-default', Stores::CURRENCY_VN);
        }
        if (!$store->admin_area_id) {
            $store->admin_area_id = get_option('admin-area-default');
        }
        if (!$store->assigned_id) {
            $customer = AdminCustomer::find($store->customer_id ?? 0);
            if ($customer) {
                $store->assigned_id = $customer->assigned_id ?? 0;
            } else {
                $store->assigned_id = get_option('store-assigned-default');
            }
        }
    }

    public function created(Stores $store)
    {
        // add to store_permission
    }

    public function updating(Stores $store)
    {
    }

    public function updated(Stores $store)
    {
    }

    public function deleted(Stores $store)
    {
    }

    public function restored(Stores $store)
    {
        // check and delete logo in s3
    }

    public function forceDeleted(Stores $store)
    {
        //
    }
}
