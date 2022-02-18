<?php

namespace Tudublin;

class Application
{
    public function run()
    {
        $action = filter_input(INPUT_GET, 'action');
        $mainController = new MainController();

        switch ($action){
            case 'new_form':
                $mainController->form();
                break;

            case 'process_new':
                $title = filter_input(INPUT_POST, 'title');
                $category = filter_input(INPUT_POST, 'category');
                $price = filter_input(INPUT_POST, 'price');
                $voteTotal = filter_input(INPUT_POST, 'vote_total');
                $numVotes = filter_input(INPUT_POST, 'num_votes');

                $mainController->processNewMovie($title, $category, $price, $voteTotal, $numVotes);
                break;

            case 'delete':
                $id = filter_input(INPUT_GET, 'id');
                $mainController->delete($id);
                break;

            case 'about':
                $mainController->about();
                break;

            case 'contact':
                $mainController->contact();
                break;

            case 'sitemap':
                $mainController->sitemap();
                break;

            case 'list':
                $mainController->list();
                break;

            default:
                $mainController->index();
        }
    }
}