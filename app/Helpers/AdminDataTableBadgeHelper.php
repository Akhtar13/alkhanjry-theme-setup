<?php

namespace App\Helpers;


class AdminDataTableBadgeHelper
{
    public static function statusBadge($object): string
    {
        $status = '';
        if ((string)$object->status === 'Active') {
            $status = '<span class="badge badge-soft-success status-change cursor-pointer" data-status="InActive" data-id="' . $object->id . '" >' . trans('messages.active') . '</span>';
        } elseif ((string)$object->status === 'InActive') {
            $status = '<span class="badge badge-soft-danger status-change cursor-pointer" data-status="Active" data-id="' . $object->id . '" >' . trans('messages.inactive') . '</span>';
        } elseif ((string)$object->status === 'active') {
            $status = '<span class="badge badge-soft-success status-change cursor-pointer" data-status="inActive" data-id="' . $object->id . '" >' . trans('messages.active') . '</span>';
        } elseif ((string)$object->status === 'inActive') {
            $status = '<span class="badge badge-soft-danger status-change cursor-pointer" data-status="active" data-id="' . $object->id . '" >' . trans('messages.inactive') . '</span>';
        }
        return $status;
    }
}