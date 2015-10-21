<div class="pagination-container">
    <ul class="pagination">
        <?php
            if ($this->Paginator->hasPrev()){
                $this->Paginator->prev('«');
            }
            $this->Paginator->numbers(['modulus' => 5]);
            if ($this->Paginator->hasNext()){
                $this->Paginator->next('»');
            }
        ?>
    </ul>
</div>
