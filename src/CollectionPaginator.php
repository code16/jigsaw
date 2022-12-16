<?php

namespace Code16\Jigsaw;

use TightenCo\Jigsaw\IterableObject;

class CollectionPaginator extends \TightenCo\Jigsaw\Collection\CollectionPaginator
{
    public function paginate($file, $items, $perPage, $prefix)
    {
        if(!count($items)) { // we still want to render a page if there is no item
            return parent::paginate($file, [null], $perPage, $prefix)
                ->map(function (IterableObject $pagination) {
                    $pagination->set('items', []);
                    return $pagination;
                });
        }

        return parent::paginate($file, $items, $perPage, $prefix);
    }
}
