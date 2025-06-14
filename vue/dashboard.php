<?php
include 'entete.php';
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Commande</div>
                <div class="number"><?php echo getAllCommande()['nbre'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bx-cart-alt cart"></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Vente</div>
                <div class="number"><?php echo getAllVente()['nbre'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Article</div>
                <div class="number"><?php echo getAllArticle()['nbre'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bx-cart cart three"></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">CA</div>
                <div class="number"><?php echo number_format(getCA()['prix'], 0, ',', ' ') ?></div>
                <div class="indicator">
                    <i class="bx bx-down-arrow-alt down"></i>
                    <span class="text">Aujourd'hui</span>
                </div>
            </div>
            <i class="bx bxs-cart-download cart four"></i>
        </div>
    </div>

    <div class="sales-boxes">
        <div class="recent-sales box">
            <div class="title">Vente recentes</div>
            <?php
            $ventes = getLastVente();
            ?>
            <div class="sales-details">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Article</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ventes as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo date('d M Y', strtotime($value['date_vente'])) ?></td>
                                <td><?php echo $value['nom'] . " " . $value['prenom'] ?></td>
                                <td><?php echo $value['nom_article'] ?></td>
                                <td><?php echo number_format($value['prix'], 0, ",", " ") . " MAD" ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="button">
                <a href="#">Voir Tout</a>
            </div>
        </div>
        <div class="top-sales box">
            <div class="title">Article le plus vendu</div>
            <ul class="top-sales-details">
                <?php
                $article = getMostVente();
                foreach ($article as $key => $value) {
                ?>
                    <li>
                        <a href="#">
                            <!--<img src="images/sunglasses.jpg" alt="">-->
                            <span class="product"><?php echo $value['nom_article'] ?></span>
                        </a>
                        <span class="price"><?php echo number_format($value['prix'], 0, ",", " ") . " MAD" ?></span>
                    </li>
                <?php
                }
                ?>
                
            </ul>
        </div>
    </div>
</div>
</section>

<?php
include 'pied.php';
?>