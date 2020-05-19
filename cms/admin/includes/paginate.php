<?php 

class Paginate {

    public $current_page;
    public $items_per;
    public $total;

    public function __construct($page=1, $items=12, $count=0) {
        $this->current_page = (int)$page;
        $this->items_per = (int)$items;
        $this->total = (int)$count;
    }

    public function next() {
        return $this->current_page + 1;
    } // End of next

    public function previous() {
        return $this->current_page - 1;
    } // End of previous

    public function total_pages() {
        return ceil($this->total/$this->items_per);
    } // End of total_pages

    public function has_previous() {
        return $this->previous() >= 1 ? true : false;
    } // End of has_previous

    public function has_next() {
        return $this->next() <= $this->total_pages() ? true : false;
    } // End of has_next

    public function offset() {
        return ($this->current_page - 1) * $this->items_per;
    } // End of offset
}



?>