<?php

namespace spec\Anchor\Core\Pagination;

use Spec\ObjectBehavior;
use Prophecy\Argument;

use Illuminate\Pagination\Paginator;

class PresenterSpec extends ObjectBehavior
{
    public function let(Paginator $paginator)
    {
        $this->beConstructedWith($paginator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Anchor\Core\Pagination\Presenter');
    }

    function it_renders_a_page_link()
    {
        $url = 'http://test.example.com';
        $page = 'Page 1';

        $expected = '<a href="http://test.example.com">Page 1</a>&nbsp;';

        $this->getPageLinkWrapper($url, $page)->shouldReturn($expected);
    }

    function it_renders_the_active_page_number_with_strong_and_no_link()
    {
        $this->getActivePageWrapper('Page 1')->shouldReturn('<strong>Page 1</strong>&nbsp;');
    }

    function it_renders_a_paginator_correctly(Paginator $paginator)
    {
        $paginator->getCurrentPage()->willReturn(5);
        $paginator->getLastPage()->willReturn(10);
        $paginator->getUrl(Argument::type('integer'))->will(function($args) {
            return 'http://example.com?page='.$args[0];
        });

        $expected =
            '<a href="http://example.com?page=1">First</a>&nbsp;'.
            '<a href="http://example.com?page=4">Previous</a>&nbsp;'.
            '<a href="http://example.com?page=2">2</a>&nbsp;'.
            '<a href="http://example.com?page=3">3</a>&nbsp;'.
            '<a href="http://example.com?page=4">4</a>&nbsp;'.
            '<strong>5</strong>&nbsp;'.
            '<a href="http://example.com?page=6">6</a>&nbsp;'.
            '<a href="http://example.com?page=7">7</a>&nbsp;'.
            '<a href="http://example.com?page=8">8</a>&nbsp;'.
            '<a href="http://example.com?page=9">9</a>&nbsp;'.
            '<a href="http://example.com?page=6">Next</a>&nbsp;'.
            '<a href="http://example.com?page=10">Last</a>&nbsp;';

        $this->render()->shouldReturn($expected);
    }

    function it_should_not_show_first_previous_links_on_first_page(Paginator $paginator)
    {
        $paginator->getCurrentPage()->willReturn(1);
        $paginator->getLastPage()->shouldBeCalled();

        $this->getPrevious()->shouldReturn(null);
    }

    function it_should_not_show_next_last_on_last_page(Paginator $paginator)
    {
        $paginator->getCurrentPage()->willReturn(5);
        $paginator->getLastPage()->willReturn(5);

        $this->getNext()->shouldReturn(null);
    }
}
