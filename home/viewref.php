<?php

//include both the dbconnect and sescheck files
require('../conf/dbconnect.php');
require('../conf/sescheck.php');

$email = $_SESSION['email'];
$bid = $_GET["id"];
$rid = $_GET["rid"];

$viewQry = "SELECT * FROM reference WHERE rid = $rid";
$refSql_getRef = mysqli_query($conn,$viewQry) or die("You do not have permissions to read this bibliography.");
$row = mysqli_fetch_assoc($refSql_getRef);

// $refQry_newRef = "INSERT INTO reference (bibliography, reftype, authors) VALUES ('$bid', '$reftype', '$authors')";
// $refSql_newRef = mysqli_query($conn,$refQry_newRef) or die("Could not create reference. ".mysqli_error($conn));

// if($_SERVER['REQUEST_METHOD'] == "POST"){
//   $refName = mysqli_real_escape_string($conn,$_POST['authors']);
//   $refType = mysqli_real_escape_string($conn,$_POST['refType']);
//   $refQry_createRef = "INSERT INTO reference (bibliography, reftype, authors) VALUES ('$bid', '$refType', '$refName')";
//   mysqli_query($conn,$refQry_createRef) or die("Could not create reference. $insert".mysqli_error($conn));
//   header("Refresh:0 url=../home/bibliography?id=$bid");
// }

?>

<html>
    <head>
        <link rel="stylesheet" href="../assets/style/style.css">
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <title><?php echo($row['refname']); ?> ~ Citation Needed</title>
        <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    </head>
    <body>

        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">View Reference: <em><?php echo($row['refname']); ?></em></span>
                    <div class="mdl-layout-spacer"></div>
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                          <!-- <a class="mdl-navigation__link" href="#">Create Bibliography</a> -->
                          <!-- <button id="btnNewBib" class="mdl-button mdl-button--raised mdl-js-button dialog-button">New Bibliography</button> -->
                        </nav>
                    <!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp">
                            <i class="material-icons">search</i>
                        </label>
                        <div class="mdl-textfield__expandable-holder">
                            <input class="mdl-textfield__input" type="text" name="sample" id="fixed-header-drawer-exp">
                        </div>
                    </div> -->
                </div>
            </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Citation Needed</span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="../home">Home</a>
                <a class="mdl-navigation__link" href="../account/settings">Account Settings</a>
                <a class="mdl-navigation__link" href="../account/logout">Logout</a>
            </nav>
        </div>
            <main class="mdl-layout__content">
                <div class="page-content">
                <h3>This currently only works correctly for websites.</h3>
                    <div id="refButtons">
                        <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="../home/bibliography?id=<?php echo($bid); ?>"> Go Back </a>
                    </div>
                    <div>
                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                        <thead>
                            <tr>
                            <th class="mdl-data-table__cell--non-numeric">Type</th>
                            <th class="mdl-data-table__cell--non-numeric">Name</th>
                            <th class="mdl-data-table__cell--non-numeric">Authors</th>
                            <th class="mdl-data-table__cell--non-numeric">Year</th>
                            <th class="mdl-data-table__cell--non-numeric">Access Date</th>
                            <th class="mdl-data-table__cell--non-numeric">URL</th>
                            <th class="mdl-data-table__cell--non-numeric">Edition</th>
                            <th class="mdl-data-table__cell--non-numeric">Place of Publication</th>
                            <th class="mdl-data-table__cell--non-numeric">Publisher</th>
                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['reftype']); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['refname']); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['authors']); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['year']); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['refdate']); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['refurl']); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['refedition']); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['refpop']); ?></td>
                                    <td class="mdl-data-table__cell--non-numeric"><?php echo($row['refpub']); ?></td>
                                </tr>
                        </tbody>
                    </table>
                    <br>
                    </div>
                    <div class="divCitation">
                        <div class="demo-card-event mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--expand divCitationTitle">
                            <h4>In-Text Citation:</h4>
                            <br>
                            <p class="citation">(<?php echo($row['authors']) ?>, <?php echo($row['year']); ?>)</p>
                        </div>
                        </div>

                        <div class="demo-card-event mdl-card mdl-shadow--2dp divCitationCard">
                        <div class="mdl-card__title mdl-card--expand divCitationTitle">
                            <h4>Bibliography Citation:</h4>
                            <br>
                            <p class="citation">
                                <?php echo($row['authors']) ?> (<?php echo($row['year']); ?>) <em><?php echo($row['refname']); ?>.</em>
                                <?php if ($row['reftype'] == "Website") { ?>
                                    Available at: <?php echo($row['refurl']); ?>
                                    [Accessed <?php echo($row['refdate']); ?>].
                                <?php } ?>
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include("../scripts/footer.php"); ?>
        </div>
    </body>
</html>
