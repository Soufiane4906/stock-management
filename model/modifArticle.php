<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'connexion.php';
if (
    !empty($_POST['nom_article'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])
    && !empty($_POST['date_fabrication'])
    && !empty($_POST['date_expiration'])
    && !empty($_POST['id'])
) {

    // Check if a new image is uploaded
    if (!empty($_FILES['images']['name'])) {
        $name = $_FILES['images']['name'];
        $tmp_name = $_FILES['images']['tmp_name'];
        
        $folder = "../public/images/";
        $destination = "../public/images/$name";
        
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        
        if (move_uploaded_file($tmp_name, $destination)) {
            $sql = "UPDATE article SET nom_article=?, id_categorie=?, quantite=?, prix_unitaire=?, 
                    date_fabrication=?, date_expiration=?, images=? WHERE id=?";
            $req = $connexion->prepare($sql);
            
            $req->execute(array(
                $_POST['nom_article'],
                $_POST['id_categorie'],
                $_POST['quantite'],
                $_POST['prix_unitaire'],
                $_POST['date_fabrication'],
                $_POST['date_expiration'],
                $destination,
                $_POST['id']
            ));
        } else {
            $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'importation de l'image";
            $_SESSION['message']['type'] = "danger";
            header('Location: ../vue/article.php');
            exit();
        }
    } else {
        // No new image, update without image
        $sql = "UPDATE article SET nom_article=?, id_categorie=?, quantite=?, prix_unitaire=?, 
                date_fabrication=?, date_expiration=? WHERE id=?";
        $req = $connexion->prepare($sql);
        
        $req->execute(array(
            $_POST['nom_article'],
            $_POST['id_categorie'],
            $_POST['quantite'],
            $_POST['prix_unitaire'],
            $_POST['date_fabrication'],
            $_POST['date_expiration'],
            $_POST['id']
        ));
    }
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "Article modifié avec succès";
        $_SESSION['message']['type'] = "success";
    }else {
        $_SESSION['message']['text'] = "Rien a été modifié";
        $_SESSION['message']['type'] = "warning";
    }

} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/article.php');