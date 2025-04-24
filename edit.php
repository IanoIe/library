<?php
    
    include("connect.php");
    include("tampletes/header.php");

    $id = "";
    $title = "";
    $category = "";
    $descriptions = "";
    $stock = "";

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // GET method: Afficher les données des livres
        if (!isset($_GET["id"])) {
            header("location: indexAdmin.php");
            exit;
        } 
        $id = $_GET["id"];

        // lire la ligne de livre sélectionné à partir de la table de base de données
        $sql = "SELECT * FROM books WHERE id=$id";
        $stmt = $pdo->query($sql);
        $ligne = $stmt->fetch();

        if (!$ligne) {
            header("location: indexAdmin.php");
            exit;
        }

        $title = $ligne["title"];
        $category = $ligne["category"];
        $descriptions = $ligne["descriptions"];
        $stock = $ligne["stock"];

    } else {
        // POST method: mettre à jour la données des livres
        $id = $_POST["id"];
        $title = $_POST["title"];
        $category = $_POST["category"];
        $descriptions = $_POST["descriptions"];
        $stock = $_POST["stock"];

        do {
            if (empty($id) || empty($title) || empty($category) || empty($descriptions) || empty($stock)){
                $errorMessage = "Tous les champs sont obligatoires";
                break;
            }

            $sql = "UPDATE books SET title = '$title', category = '$category', descriptions = '$descriptions', stock = '$stock' WHERE id = $id";
            
            $stmt = $pdo->query($sql);

            if (!$stmt) {
                $errorMessage = "Query invalide: " .$pod->error;
                break;
            }

            $successMessage = "Livre mis à jour correctement";
            header("location: indexAdmin.php");

        } while (false);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <title> Edit </title>
</head>

<style>

 
    
</style>
<body>
    <div class="container my-5">
        <h2>Edit une Livre</h2>
        <?php
            if (!empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' rol='alert'>
                     <strong>$errorMessage</strong>
                     <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button>
                </div>";
            }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Title of books</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="category" value="<?php echo $category; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">descriptions</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="descriptions" value="<?php echo $descriptions; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Stock</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="stock" value="<?php echo $stock; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/bibliotheque" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

<?php
    include("tampletes/footer.php")
?>
</body>
</html>