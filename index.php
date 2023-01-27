<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WanderSets Manager</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>

        <div class="container">

            <h1>WumS WanderSets Manager</h1>
            <div class="alert alert-light" role="alert">
                Diese Seite zeigt eine Übersicht der WanderSets vom WumS und ermöglicht es diese Personen zuzuordnen.
            </div>
            <div class='alert alert-warning'>
                Bitte <strong>nur Vornamen</strong> aufgrund von Datenschutz verwenden! Bei Problemen oder Spam in den Daten bitte <a href="mailto:it@wandernumstuttgart.de">per Mail</a> melden.
            </div>
            <?php
                // validate input for security
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if(isset($_POST['id']) && isset($_POST['holder']) && empty($_POST['hp']))
                    {
                        $id = test_input($_POST['id']);
                        $holder = test_input($_POST['holder']);
                        $query = "UPDATE wl_set SET holder='$holder' WHERE id='$id'";
                        require_once 'connection.php';
                        if(mysqli_query($conn, $query))
                        {
                            // pop up message
                            echo "<div class='alert alert-success'>
                                    <strong>Erfolg!</strong> Wanderleitungs Set $id wurde erfolgreich $holder zugeordnet.
                                </div> ";
                        }else{
                            echo "<div class='alert alert-danger'>
                                    <strong>Error!</strong> Wanderleitungs Set $id konnte nicht auf $holder geändert werden.
                                </div>";
                        }
                    }
                }
            ?>

            <?php
                require_once 'connection.php';
                $query = "SELECT * FROM wl_set";
                if($result = mysqli_query($conn, $query))
                {
                    if(mysqli_num_rows($result) > 0)
                    {
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Nr</th>";
                                    echo "<th>aktuell bei</th>";
                                    echo "<th>Zuordnung ändern</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result))
                            {
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['holder'] . "</td>";
                                    // include hidden field to prevent bots from submitting the form
                                    echo "<td>
                                        <form class='form-inline' action='index.php' method='POST'>
                                            <input name='hp' class='visually-hidden' tabindex='-1' autocomplete='off'>
                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                            <input type='text' name='holder' class='form-control' placeholder='Übergeben an Vorname' value=''>
                                            <input type='submit' class='btn btn-primary' value='Update'>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "Keine Wanderleitungs Sets in der Datenbank hinterlegt.";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                }
            ?>

        </div>
    </body>
</html>