<?php

namespace Anchor\Core\Pagination;

use Illuminate\Pagination\Presenter;

class SimplePresenter extends Presenter {

    /**
     * Get HTML wrapper for a page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @return string
     */
    public function getPageLinkWrapper($url, $page)
    {
        return '<a href="'.$url.'">'.$page.'</a>';
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return boolean
     */
    public function getDisabledTextWrapper($text)
    {
        return false;
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return boolean
     */
    public function getActivePageWrapper($text)
    {
        return false;
    }

}
