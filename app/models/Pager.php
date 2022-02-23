<?php

class Pager
{

    public $links = [];
    public $offset = 0;
    public $page_number = 1;
    public $start = 1;
    public $end = 1;

    public function index($limit = 2)
    {
        $page_number = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $page_number = $page_number < 1 ? 1 : $page_number;

        $this->start = $page_number - 1;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $page_number + 1;

        $this->offset = ($page_number - 1) * $limit;
        $this->page_number = $page_number;

        $current_link = URLROOT . '/' . str_replace("url=", "", $_SERVER['QUERY_STRING']);
        $current_link = !strstr($current_link, "page") ? $current_link . "&page=1" : $current_link;
        $next_link = preg_replace('/page=[0-9]+/', 'page=' . ($page_number + 2), $current_link);
        $first_link = preg_replace('/page=[0-9]+/', 'page=1', $current_link);

        $this->links['first'] = $first_link;
        $this->links['next'] = $next_link;
        $this->links['current'] = $current_link;
    }

    public function display()
    {
?>
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="<?= $this->links['first']; ?>">First</a>
                </li>
                <?php for ($x = $this->start; $x <= $this->end; $x++) : ?>
                    <li class="page-item 
                        <?= ($x == $this->page_number) ? ' active' : ''; ?>
                    "><a class="page-link" href="<?= preg_replace('/page=[0-9]+/', "page=" . $x, $this->links['current']) ?>"><?= $x ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $this->links['next']; ?>">Next</a>
                </li>
            </ul>
        </nav>
<?php
    }
}
