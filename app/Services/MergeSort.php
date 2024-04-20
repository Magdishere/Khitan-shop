<?php

namespace App\Services;

class MergeSort
{
    public function mergeSort($arr, $key, $order)
    {
        if (count($arr) <= 1) {
            return $arr;
        }

        $middle = (int)(count($arr) / 2);
        $left = array_slice($arr, 0, $middle);
        $right = array_slice($arr, $middle);

        $left = $this->mergeSort($left, $key, $order);
        $right = $this->mergeSort($right, $key, $order);

        return $this->merge($left, $right, $key, $order);
    }

    public function merge($left, $right, $key, $order)
    {
        $result = [];
        $i = $j = 0;

        while ($i < count($left) && $j < count($right)) {
            if (($order === 'asc' && $left[$i][$key] < $right[$j][$key]) ||
                ($order === 'desc' && $left[$i][$key] > $right[$j][$key])) {
                $result[] = $left[$i++];
            } else {
                $result[] = $right[$j++];
            }
        }

        while ($i < count($left)) {
            $result[] = $left[$i++];
        }

        while ($j < count($right)) {
            $result[] = $right[$j++];
        }

        return $result;
    }
}
