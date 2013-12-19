<?php

namespace Anchor\Core\Pagination;

use Illuminate\Pagination\Presenter as BasePresenter;

class Presenter extends BasePresenter {

    /**
     * Get HTML wrapper for a page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @return string
     */
    public function getPageLinkWrapper($url, $page)
    {
        return '<a href="'.$url.'">'.$page.'</a> ';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return string
     */
    public function getActivePageWrapper($text)
    {
        return '<strong>'.$text.'</strong> ';
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return string
     */
    public function getDisabledTextWrapper($text)
    {
        return '<strong'.$text.'</strong>';
    }

    /**
     * Render the Pagination contents.
     *
     * @return string
     */
    public function render()
    {
        $content = $this->getPageSlider();

        return $this->getPrevious().$content.$this->getNext();
    }

    /**
     * Get the previous page pagination element.
     *
     * @param  string  $text
     * @return string
     */
    public function getPrevious($text = 'Previous')
    {
        if ($this->currentPage > 1) {

            $url = $this->paginator->getUrl($this->currentPage - 1);
            $firstPage = $this->paginator->getUrl(1);

            $content = $this->getPageLinkWrapper($firstPage, 'First');
            $content .= $this->getPageLinkWrapper($url, $text);

            return $content;
        }
    }

    /**
     * Get the next page pagination element.
     *
     * @param  string  $text
     * @return string
     */
    public function getNext($text = 'Next')
    {
        if ($this->currentPage < $this->lastPage) {
            $url = $this->paginator->getUrl($this->currentPage + 1);
            $firstPage = $this->paginator->getUrl($this->lastPage);

            $content = $this->getPageLinkWrapper($url, $text);
            $content .= $this->getPageLinkWrapper($firstPage, 'Last');

            return $content;
        }
    }

    /**
     * Create a pagination slider link window.
     *
     * @return string
     */
    protected function getPageSlider()
    {
        if ($this->currentPage > 3) {
            $start = $this->currentPage - 3;
        } else {
            $start = 1;
        }

        if (($this->lastPage - $this->currentPage) > 4) {
            $end = $this->currentPage + 4;
        } else {
            $end = $this->lastPage;
        }

        return $this->getPageRange($start, $end);
    }
}
