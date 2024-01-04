<?php
    include('connect.php');
    function insert_popup($usernameSend, $prenomSend, $nomSend, $telSend, $motdepasseSend,$statusSend,$genderSend,$countrySend,$citySend){
        $conn=connect();
        $sql = "INSERT INTO users (`id`, `user_name`, `prenom`, `nom`,`tel`, `mot_passe`,`status`,`gender_id`,`country_id`,`city_id`)
        VALUES (null, '$usernameSend', '$prenomSend', '$nomSend', '$telSend',MD5 ('$motdepasseSend'),'$statusSend','$genderSend','$countrySend','$citySend')";
        if($conn->query($sql) === TRUE){
            echo"Donnees enregistrees avec succes";
        }else{
            echo"Erour: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    function search($id){
        if(isset($id)){
            //connection database
            $conn = connect();
            //select data from database
             $sql = "SELECT users.id, users.user_name, users.prenom,users.nom, users.tel, users.mot_passe,users.status gender.nom AS 'name_gender',countries.country AS 'country',cities.city AS 'city'
                       FROM users JOIN gender  ON users.gender_id=gender.id
                       JOIN countries ON users.country_id=countries.id
                       JOIN cities ON users.city_id=cities.id HAVING id = '$id';";
            //$sql = "SELECT * FROM users WHERE id = '$id' ";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $myArray[] = $row;
            echo "<table class='table table-bordered'  style='text-align:center;'>";
            echo "<tr>";
            echo "<th>". "id"."</th>" ;
            echo "<th>". "user_name"."</th>" ;
            echo "<th>". "prenom" ."</th>";
            echo "<th>". "nom" ."</th>";
            echo "<th>". "tel"."</th>" ;
            echo "<th>". "mot_passe"."</th>" ;
            echo "<th>". "status"."</th>" ;
            echo "<th>". "gender"."</th>" ;
            echo "<th>". "country"."</th>" ;
            echo "<th>". "city"."</th>" ;
            echo "</tr><tr>";
            echo "<td>". $row["id"]. "</td>";
            echo "<td>". $row["user_name"]. "</td>";
            echo "<td>". $row["prenom"]. "</td>";
            echo "<td>". $row["nom"]. "</td>";
            echo "<td>". $row["tel"]. "</td>";
            echo "<td>". $row["mot_passe"]. "</td>";
            echo "<td>". $row["status"]. "</td>";
            echo "<td>". $row["name_gender"]. "</td>";
            echo "<td>". $row["country"]. "</td>";
            echo "<td>". $row["city"]. "</td>";
            echo "</tr>"; 
        }}else{ 
            echo "not found";
        }
        }
    }  

    function read($id){
        $sql = "SELECT * FROM users WHERE id = '$id' ";
        $conn = connect();
        $reselt = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($reselt);

        //$ar = array(
        //$row["id"], $row["user_name"], $row["prenom"], $row["nom"], $row["tel"], $row["mot_passe"], $row["gender_id"], $row["country_id"], $row["city_id"]);
        return $row;
    }

    function genders(){
        $myArray = array();
        $sql = "SELECT * FROM gender ";
        $conn = connect();
        $reselt = mysqli_query($conn, $sql);
        if ($reselt->num_rows > 0){
            // output data of each row
            while($row = $reselt->fetch_assoc()){
            $myArray[] = $row;
            }
            return $myArray;
        }
    }

    function countries(){
        $myArray = array();
        $sql = "SELECT * FROM countries ";
        $conn = connect();
        $reselt = mysqli_query($conn, $sql);
        if ($reselt->num_rows > 0){
            // output data of each row
            while($row = $reselt->fetch_assoc()){
            $myArray[] = $row;
            }
            return $myArray;
        }
    }

    function cities($id){
        $myArray = array();
        $sql = "SELECT * FROM cities WHERE country_id = '$id'";
        $conn = connect();
        $reselt = mysqli_query($conn, $sql);
        if ($reselt->num_rows > 0){
            // output data of each row
            while($row = $reselt->fetch_assoc()){
            $myArray[] = $row;
            }
            return $myArray;
        }
    }

    function update_users($id,$usernameSendUp, $prenomSendUp, $nomSendUp, $telSendUp, $motdepasseSendUp, $statusSendUp,$genderSendUp,$countrySendUp,$citySendUp){
            $conn=connect();
            $sql = "UPDATE users SET `user_name` = '$usernameSendUp',
            `prenom` = '$prenomSendUp', `nom` = '$nomSendUp', `tel` = '$telSendUp', 
            `mot_passe` = MD5('$motdepasseSendUp'), `status` = '$statusSendUp', `gender_id` = '$genderSendUp', `country_id` = '$countrySendUp', `city_id` = '$citySendUp' WHERE `id` = '$id';";
        if($conn->query($sql)=== TRUE){
                echo"Donnees update avec succes";
            }else{
                echo"Erour: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
    }

    function delete_user($id){
        $conn = connect();
        $sql = "DELETE FROM users WHERE id ='$id'";
        if($conn->query($sql)=== TRUE){
            //header("location:table.php?statue=1&id=".$id);
            //header("location:table.php");
            echo"Delete avec succes";
        }else{
            echo"Erour: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    function list_table(){
        $myArray = array();
        $conn = connect(); 
        $sql = "SELECT users.id, users.user_name, users.prenom,users.nom, users.tel, users.mot_passe,users.status, gender.nom AS 'name_gender',countries.country AS 'country',cities.city AS 'city'
                FROM users JOIN gender  ON users.gender_id=gender.id
                           JOIN countries ON users.country_id=countries.id
                           JOIN cities ON users.city_id=cities.id 
                           ORDER BY users.id ASC;";
        //$sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            // output data of each row
            while($row = $result->fetch_assoc()){
                $myArray[] = $row;
            }
            return $myArray;
        }else {
            return null;
        }
        $conn->close();
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function insertOptionCountry($countrySend){
        $conn=connect();
        $sql = "SELECT * FROM countries WHERE country='$countrySend'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == false){
            $sql = "INSERT INTO countries (id, country)
                VALUES (null, '$countrySend')";
                if($conn->query($sql) === TRUE){
                    //echo "<span style=color:green;>Donnees enregistrees avec succes</span>";
                    echo json_encode(array("status" => true,"message" => "Donnees enregistrees avec succes"));
                }else{
                    echo"Erour: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
        }else{ 
            //echo "<span style=color:red;>country exists</span>";
            echo json_encode(array("status" => false,"message" => "country exists"));

        }
    }

    function insertOptionCity($citySend,$countrySend){
        $conn=connect();
        $sql = "INSERT INTO cities (id, city, country_id)
        VALUES (null, '$citySend', '$countrySend')";
        if($conn->query($sql) === TRUE){
            echo"Donnees enregistrees avec succes";
        }else{
            echo"Erour: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    function status(){
        $id = $_POST['id'];
        $status = $_POST['status'];
        $conn = connect();
        $sql = "UPDATE users SET status = '$status' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
        echo json_encode(array('success' => true));
        } else {
        echo json_encode(array('success' => false));
        }
        $conn->close();
    }

?>