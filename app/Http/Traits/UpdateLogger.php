<?php

namespace App\Http\Traits;

use App\Models\History;
use Auth;
use DB;

trait UpdateLogger
{
    protected static function boot()
    {
        parent::boot();
        /* * During a model create Eloquent will also update the updated_at field so * need to have the updated_by field here as well * */
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            $backupDate=DB::table($model->table)->where('id',$model->id)->first();
            $history=New History;
            $history->data=json_encode($backupDate);
            $history->table_name=$model->table;
            $history->primary_key=$model->id;
            $history->save();
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
        /*
         * Deleting a model is slightly different than creating or deleting. For
         * deletes we need to save the model first with the deleted_by field
         * */
        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });
    }


}
