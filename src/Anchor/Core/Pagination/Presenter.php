<?php

namespace Anchor\Core\Pagination;

use Illuminate\Pagination\Presenter as BasePresenter;

class Presenter extends BasePresenter
{
    const FIRST_PAGE = 1;
    const RANGE_PREV = 3;
    const RANGE_NEXT = 4;
    const RANGE_PAGE = 1;

    /**
     * Get HTML wrapper for a page link.
     *
     * @param  string  $url
     * @param  int     $page
     * @return string
     */
    public function getPageLinkWrapper($url, $page)
    {
        return "<a href=\"$url\">$page</a>&nbsp;";
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return string
     */
    public function getActivePageWrapper($text)
    {
        return "<strong>$text</strong>&nbsp;";
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return string
     */
    public function getDisabledTextWrapper($text)
    {
        return "<strong>$text</strong>&nbsp;";
    }

    /**
     * Render the Pagination contents.
     *
     * @return string
     */
    public function render()
    {
        return $this->getPrevious() . $this->getPageSlider() . $this->getNext();
    }

    /**
     * Get the previous page pagination element.
     *
     * @param  string  $prevTitle
     * @param  string  $firstTitle
     * @return string|null
     */
    public function getPrevious($prevTitle = 'Previous', $firstTitle = 'First')
    {
        if ($this->currentPage > self::FIRST_PAGE) {
            $prevPage  = $this->paginator->getUrl($this->currentPage - self::RANGE_PAGE);
            $firstPage = $this->paginator->getUrl(self::FIRST_PAGE);

            $firstPageLink = $this->getPageLinkWrapper($firstPage, $firstTitle);
            $prevPageLink  = $this->getPageLinkWrapper($prevPage, $prevTitle);

            return $firstPageLink . $prevPageLink;
        }
    }

    /**
     * Get the next page pagination element.
     *
     * @param  string  $nextTitle
     * @param  string  $lastTitle
     * @return string|null
     */
    public function getNext($nextTitle = 'Next', $lastTitle = 'Last')
    {
        if ($this->currentPage < $this->lastPage) {
            $nextPage = $this->paginator->getUrl($this->currentPage + self::RANGE_PAGE);
            $lastPage = $this->paginator->getUrl($this->lastPage);

            $nextPageLink = $this->getPageLinkWrapper($nextPage, $nextTitle);
            $lastPageLink = $this->getPageLinkWrapper($lastPage, $lastTitle);

            return $nextPageLink . $lastPageLink;
        }
    }

    /**
     * Create a pagination slider link window.
     *
     * @return string
     */
    protected function getPageSlider()
    {
        if ($this->currentPage > self::RANGE_PREV) {
            $start = $this->currentPage - self::RANGE_PREV;
        } else {
            $start = self::FIRST_PAGE;
        }

        if (($this->lastPage - $this->currentPage) > self::RANGE_NEXT) {
            $end = $this->currentPage + self::RANGE_NEXT;
        } else {
            $end = $this->lastPage;
        }

        return $this->getPageRange($start, $end);
    }
}
