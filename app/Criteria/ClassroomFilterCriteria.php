<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ClassroomFilterCriteria
 * @package namespace App\Criteria;
 */
class ClassroomFilterCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        // 筛选 面积大小 &square=?,?
        $square = request()->get('square');
        $from = $to = null;
        try {
            list($from, $to) = explode(',', $square);
        } catch (\ErrorException $e) {
           // Undefined offset
        }
        if (empty($from) && empty($to)) {
            // Not filter
        } elseif (empty($from)) {
            $model = $model->where('square', '<=', $to);
        } elseif (empty($to)) {
            $model = $model->where('square', '>=', $from);
        } else {
            $model = $model->whereBetween('square', [$from, $to]);
        }


        // 筛选 教学楼 &teachingBuilding=?
        $teachingBuilding = request()->get('teachingBuilding');
        if (empty($teachingBuilding)) {
           // Not filter
        } else {
            $model = $model->where('building_name', 'like', '%'.$teachingBuilding.'%');
        }

        // 筛选 时间段 &freeTime=?,?
        $freeTime = request()->get('freeTime');
        $from = $to = null;
        try {
            list($from, $to) = explode(',', $freeTime);
        } catch (\ErrorException $e) {
            // Undefined offset
        }
        if (empty($from) && empty($to)) {
            // Not filter
        } elseif (empty($from)) {
            $model = $model->whereDoesntHave('reservations')
                ->orWhereHas('reservations', function ($q) use ($from) {
                    $q->where('end_time', '<', $from);
                })
            ;
        } elseif (empty($to)) {
            $model = $model->whereDoesntHave('reservations')
                ->orWhereHas('reservations', function ($q) use ($to) {
                    $q->where('begin_time', '>', $to);
                })
            ;
        } else {
            $model = $model
                ->whereDoesntHave('reservations')
                ->orWhereHas('reservations', function ($q) use ($from, $to) {
                    $q->where('end_time', '<=', $from)
                        ->orWhere('begin_time', '>=', $to)
                    ;
                })
            ;
        }

        return $model;
    }
}
