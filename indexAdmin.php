<?php
   include("connection.php");
   include("tampletes/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
    <title>Project Bibliotheque</title>    
</head>

<body>

   <header>
         <h1> Welcome Page Admin </h1>
   </header>
    
    <div class="container my-5">
        <table class="table">
            <thead style="background-color: #C0C0C0; border: 3px solid black;">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Descriptions</th>
                    <th>Author</th>
                    <th>Stok</th>
                    <th>Action</th>
                    <th>Request</th>
                </tr>
            </thead>
            <tbody>
                <?php
                     $sql = "SELECT books.id, books.title, books.category, books.descriptions, authors.fullname, books.stock
                     FROM books
                     JOIN authors ON authors.id = books.id";             
                     $stmt = $pdo->query($sql);
                     if (!$stmt) {
                        die("Invalid query: ");
                     }
                     // lire les données de chaque ligne en ligne
                     while ($ligne = $stmt->fetch()) {
                          echo"<tr>
                                  <td>$ligne[title]</td>
                                  <td>$ligne[category]</td>
                                  <td>$ligne[descriptions]</td>
                                  <td>$ligne[fullname]</td>
                                  <td>$ligne[stock]</td>
                                  <td>
                                      <a class='btn btn-primary btn-sm' href='edit.php?id=$ligne[id]'>Edit</a>
                                      <a class='btn btn-danger btn-sm' href='delete.php?id=$ligne[id]'>Delete<br></a>
                                  </td>
                                  <td>
                                      <a class='btn btn-success btn-sm' href='request.php?id=$ligne[id]'>Request<br></a>
                                  </td>
                               </tr>";
                    }
                ?>     
            </tbody>
        </table>
    </div>
<?php
    include("tampletes/footer.php")
?>
</body>
</html>