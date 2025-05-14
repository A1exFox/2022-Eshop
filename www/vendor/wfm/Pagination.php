<?php

declare(strict_types=1);

namespace wfm;

use Exception;

class Pagination
{
    public int $currentPage;
    public int $perpage;
    public int $total;
    public int $countPages;
    public string $uri;

    public function __construct(int $page, int $perpage, int $total)
    {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function getHtml(): string
    {
        $curpage = $this->currentPage;
        $back = '';
        $forward = '';
        $startpage = '';
        $endpage = '';
        $page2left = '';
        $page1left = '';
        $page2right = '';
        $page1right = '';
        $pageActive = '';

        $format = '<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>';

        if ($curpage > 1) {
            $prev1 = $curpage - 1;
            $back = sprintf($format, '', $this->getLink($prev1), "&lt;");
            $page1left = sprintf($format, '', $this->getLink($prev1), "$prev1");
        }
        if ($curpage > 2) {
            $back2 = $curpage - 2;
            $page2left = sprintf($format, '', $this->getLink($back2), "$back2");
        }
        if ($curpage > 3) {
            $startpage = sprintf($format, '', $this->getLink(1), "&laquo;");
        }

        if ($curpage < $this->countPages) {
            $next1 = $curpage + 1;
            $forward = sprintf($format, '', $this->getLink($next1), "&gt;");
            $page1right = sprintf($format, '', $this->getLink($next1), "$next1");
        }
        if ($curpage < ($this->countPages - 1)) {
            $next2 = $curpage + 2;
            $page2right = sprintf($format, '', $this->getLink($next2), "$next2");
        }
        if ($curpage < ($this->countPages - 2)) {
            $endpage = sprintf($format, '', $this->getLink($this->countPages), "&raquo;");
        }

        $pageActive = sprintf($format, 'active', $this->getLink($curpage), "$curpage");

        $elements = $startpage . PHP_EOL
            . $back . PHP_EOL
            . $page2left . PHP_EOL
            . $page1left . PHP_EOL
            . $pageActive . PHP_EOL
            . $page1right . PHP_EOL
            . $page2right . PHP_EOL
            . $forward . PHP_EOL
            . $endpage . PHP_EOL;

        $html = '<nav aria-label="Page navigation example">
                        <ul class="pagination">
                            %s
                        </ul>
                    </nav>';

        $html = sprintf($html, $elements);
        return $html;
    }

    public function getLink(int $page): string
    {
        if ($page === 1) {
            return rtrim($this->uri, '?&');
        }

        if (str_contains($this->uri, '&')) {
            return sprintf('%spage=%d', $this->uri, $page);
        }

        if (str_contains($this->uri, '?')) {
            return sprintf('%spage=%d', $this->uri, $page);
        }

        return sprintf('%s?page=%d', $this->uri, $page);
    }

    public function getCurrentPage(int $page): int
    {
        if ($page < 1) {
            $page = 1;
        }
        if ($page > $this->countPages) {
            $page = $this->countPages;
        }
        return $page;
    }

    public function getStart(): int
    {
        $startItem = ($this->currentPage - 1) * $this->perpage;
        return $startItem;
    }

    public function getParams(): string
    {
        // $url = "/category/kompyutery?bar=true&page=11&var=test";
        $url = $_SERVER['REQUEST_URI'];
        $parts = explode('?', $url);
        $uri = $parts[0];
        if (count($parts) === 1 || empty($parts[1])) {
            return $uri;
        }

        $uri .= '?';
        $params = explode('&', $parts[1]);

        foreach ($params as $param) {
            if (false === (bool) preg_match('#page=#', $param)) {
                $uri .= $param . '&';
            }
        }

        return $uri;
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getCountPages(): int
    {
        if ($this->perpage === 0) {
            throw new Exception("Division by zero");
        }

        $count = (int) ceil($this->total / $this->perpage);

        if ($count === 0) {
            $count = 1;
        }
        return $count;
    }
}
