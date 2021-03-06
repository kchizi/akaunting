<?php

namespace App\Http\Transformers\Expense;

use App\Http\Transformers\Banking\Account;
use App\Models\Expense\BillPayment as Model;
use League\Fractal\TransformerAbstract;

class BillPayments extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = ['account'];

    /**
     * @param Model $model
     * @return array
     */
    public function transform(Model $model)
    {
        return [
            'id' => $model->id,
            'company_id' => $model->company_id,
            'bill_id' => $model->bill_id,
            'account_id' => $model->account_id,
            'paid_at' => $model->paid_at->toIso8601String(),
            'amount' => $model->amount,
            'currency_code' => $model->currency_code,
            'currency_rate' => $model->currency_rate,
            'description' => $model->description,
            'payment_method' => $model->payment_method,
            'reference' => $model->reference,
            'attachment' => $model->attachment,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }

    /**
     * @param Model $model
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccount(Model $model)
    {
        return $this->item($model->account, new Account());
    }
}
