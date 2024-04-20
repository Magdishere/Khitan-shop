<?php

namespace App\Services;

class PriorityQueue
{
    protected $heap = [];

    public function insert($order)
    {
        // Add the order to the end of the heap.
        $this->heap[] = $order;
        $index = count($this->heap) - 1;

        // Maintain the heap property by moving the order up.
        while ($index > 0) {
            $parentIndex = floor(($index - 1) / 2);
            if ($this->compare($this->heap[$index], $this->heap[$parentIndex]) <= 0) {
                break;
            }

            // Swap the order with its parent.
            [$this->heap[$index], $this->heap[$parentIndex]] = [$this->heap[$parentIndex], $this->heap[$index]];
            $index = $parentIndex;
        }
    }

    public function extractMax()
    {
        if (empty($this->heap)) {
            return null; // Return null if the priority queue is empty.
        }

        // Extract the order with the highest priority (at the root of the heap).
        $maxOrder = $this->heap[0];

        // Replace the root with the last order and maintain the heap property.
        $lastOrder = array_pop($this->heap);
        if (!empty($this->heap)) {
            $this->heap[0] = $lastOrder;
            $this->heapify(0);
        }

        return $maxOrder;
    }

    protected function heapify($index)
    {
        $leftChild = 2 * $index + 1;
        $rightChild = 2 * $index + 2;
        $largest = $index;

        // Compare with left child.
        if ($leftChild < count($this->heap) && $this->compare($this->heap[$leftChild], $this->heap[$largest]) > 0) {
            $largest = $leftChild;
        }

        // Compare with right child.
        if ($rightChild < count($this->heap) && $this->compare($this->heap[$rightChild], $this->heap[$largest]) > 0) {
            $largest = $rightChild;
        }

        // Swap if needed and recursively heapify the affected sub-tree.
        if ($largest != $index) {
            [$this->heap[$index], $this->heap[$largest]] = [$this->heap[$largest], $this->heap[$index]];
            $this->heapify($largest);
        }
    }

    protected function compare($order1, $order2)
    {
        // Adjust the comparison logic based on your order priority criteria.
        // For example, you might compare based on the 'order_priority' field.
        return $order1['order_priority'] - $order2['order_priority'];
    }

    // You can add other methods for additional heap operations as needed.
}
