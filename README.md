# evote-movie-2022-09-crud-create

part of the evote-2022 project sequence

- [https://github.com/dr-matt-smith/evote-movie-2022](https://github.com/dr-matt-smith/evote-movie-2022)


## NOTES for this project step

CRUD - adding a form for a NEW Movie to be added to the database

![screenshot new Movie form](screenshots/new_movie_form.png)

- create new template `/templates/new_form.php` to display a form for a new Movie with a submission action of `/?action=process_new`

  ```php
        <?php
        $pageTitle = 'new movie form';
        require_once __DIR__ . '/_header.php';
        //---------------- footer ---------------
        ?>
        
        
        <h1>
            create a NEW Movie
        </h1>
        
        <form
                action="/?action=process_new"
                method="POST"
        >
        
            title
                <input name="title">
            <br> category
                <input name="category">
            <br> price
                <input name="price">
            <br> vote total
                <input name="vote_total">
            <br> num votes
                <input name="num_votes">
            <br>
                <input type="submit">
        </form>
        
        <?php
        //---------------- footer ---------------
        require_once __DIR__ . '/_footer.php';
        ?>
  ```

- add to `/templates/list.php` a link `create a NEW Movie` whose link URL is `/?action=new_form`

    ```php
        <p>
            <a href="/?action=new_form">
                create a NEW Movie
            </a>
        </p>
    ```

- add a new case to the front controller login in `/src/Application.php`. When the URL action is `new_form`, and whose action is to invoke method `form()` in `MainController`

  ```php
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
        
                    ...
  ```

- add to`/src/MainController.php` new method `form()` to display the new form template

  ```php
    public function form()
    {
        require_once __DIR__ . '/../templates/new_form.php';
    }
  ```

- add a new case to the front controller login in `/src/Application.php`. When the URL action is `process_new`, and whose action is to extract the POST form submitted variables, and pass them as arguments when invoking method `processNewMovie(...)` in a `MainController` object

  ```php
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
  ```

- add to`/src/MainController.php` new method `processNewMovie(...)`, which takes in the values received from the submitted form, creates a new `Movie` object, uses a `MovieRepository` object to insert the new record in the database, and then invokes the list method to list movies (including the new one)

  ```php
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
  ```
