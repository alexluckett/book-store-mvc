<?php
$message = "";

if (!isset($_REQUEST["books"])) {
    $message = "<b>There are no books currently within the system.</b>";
} else if (isset($_REQUEST["message"])) {
    $message = $_REQUEST["message"];
}

$alertType = "danger";
if (isset($_REQUEST["alertType"])) {
    $alertType = $_REQUEST["alertType"];
}

if (strlen($message) != 0) {
    ?>
    <div class="alert alert-<?php echo $alertType; ?>">
        <?php echo $message; ?>
    </div>
    <?php
}
$books = $_REQUEST["books"];
$categories = $_REQUEST["categories"];
?>
<script type="text/javascript">
    function changeCategory(categoryId) {
        window.location = "?action=viewBooks&categoryId=" + categoryId;
    }
</script>

<div style="display: inline-block; width: 100%;">
    <div class="pull-right">
        <div class="pull-left">
            <select name="bookCategories" onchange="changeCategory(this.value);" class="form-control">
                <option value="0">All categories</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category->categoryId; ?>"
                    <?php if (isset($_REQUEST['categoryId']) && ($_REQUEST['categoryId'] == $category->categoryId)) { ?>
                                selected="true" 
                            <?php } ?>
                            ><?php echo $category->categoryName; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <?php if ($_SESSION['permission'] == 1) { ?>
            <a href="?action=viewAddBook">
                <button type="button" style="margin-left: 5px;" class="btn btn-success">Add new book</button>
            </a>
        <?php } ?>
    </div>
</div>
<div class="row">
    <?php if(sizeof($books) === 0) { ?>
        <div class="alert alert-danger">
           There are no books currently within BookStore.
        </div>
    <?php }
    foreach ($books as $book) {
        ?>
        <div class="col-md-4">
            <div class="panel panel-default" id="book<?php echo $book->isbn; ?>">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $book->title; ?></h3>
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <img src="view/images/bookcovers/<?php echo $book->isbn; ?>.png" 
                             alt="<?php echo $book->title; ?>'s cover photo" width="187.5px" height="300px" /><!-- 187.5x300 to conform to 1.6 aspect ratio for consistency -->
                    </div>
                    
                    <p><b>ISBN(13): </b><?php echo $book->isbn; ?></p>
                    <p><b>Author(s): </b><?php echo $book->author; ?></p>
                    <p><b>Price: </b>£<?php echo $book->price; ?></p>
                    <p><b>Quantity in stock: </b><?php echo $book->quantity; ?></p>
                    <p><b>Categories:</b>
                        <?php foreach($book->categories as $cat) { ?>
                        <?php   echo $cat->categoryName; ?>, 
                        <?php } ?>
                    </p>

                    <?php if ($_SESSION['permission'] == 1) { ?>
                        <div>
                            <p style="text-align: center;">
                                <a href="?action=viewEditBook&isbn=<?php echo $book->isbn; ?>" class="btn btn-default" role="button">Edit book</a>
                                <a href="?action=deleteBook&isbn=<?php echo $book->isbn; ?>" class="btn btn-danger" role="button">Delete book</a>
                            </p>
                        </div>
                    <?php } else { ?>
                        <div>
                            <p></p>
                            <p style="text-align: center;">
                                <a href="?action=addToBasket&isbn=<?php echo $book->isbn; ?>" class="btn btn-success" role="button">Add to basket</a>
                            </p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>