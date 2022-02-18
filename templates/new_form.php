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