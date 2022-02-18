<?php

namespace Tudublin;

class MainController
{
    public function index()
    {
        require_once __DIR__ . '/../templates/index.php';
    }

    public function about()
    {
        require_once __DIR__ . '/../templates/about.php';
    }

    public function contact()
    {
        require_once __DIR__ . '/../templates/contact.php';
    }

    public function sitemap()
    {
        require_once __DIR__ . '/../templates/sitemap.php';
    }

    public function form()
    {
        require_once __DIR__ . '/../templates/new_form.php';
    }

    public function list()
    {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findAll();

        require_once __DIR__ . '/../templates/list.php';
    }

    public function delete(int $id)
    {
        $movieRepository = new MovieRepository();
        $movieRepository->delete($id);

        $this->list();
    }

    public function processNewMovie(string $title, string $category, float $price, int $voteTotal, int $numVotes)
    {
        $m = new Movie();
        $m->setTitle($title);
        $m->setCategory($category);
        $m->setPrice($price);
        $m->setVoteTotal($voteTotal);
        $m->setNumVotes($numVotes);

        $movieRepository = new MovieRepository();
        $movieRepository->insert($m);

        $this->list();
    }
}