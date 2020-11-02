<div class="row">
    <!-- SECTION A - страны(добавление/удаление) и отображение-->
    <div class="col-6">
        <?php
        $link = connect();
        $res = mysqli_query($link, 'SELECT * FROM countries ORDER BY id');
        echo '<form action="index.php?page=4" method="post" class="input-group" id="formcountry">';
            // вывод стран
            echo '<table class="table table-striped">';

            while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                echo '<tr>';
                echo "<td>$row[0]</td>";
                echo "<td>$row[1]</td>";
                echo '</tr>';
            }
            echo '</table>';


            // добавление страны
            echo '<input type="text" name="country" placeholder="Страна">';
            echo '<input type="submit" name="addcountry" value="Добавить" class="btn btn-sm btn-info">';
            echo '<input type="submit" name="delcountry" value="Удалить" class="btn btn-sm btn-warning">';
        echo '</form>';

        // обработчик добавления страны
        if(isset($_POST['addcountry'])) {
            $country = trim(htmlspecialchars($_POST['country']));
            if($country === '') exit;
            mysqli_query($link, "INSERT INTO countries(country) VALUES ('$country')");
        }
        ?>
    </div>

    <!-- SECTION B-->
    <div class="col-6">

    </div>
</div>

<div class="row">
    <!-- SECTION C-->
    <div class="col-6">

    </div>

    <!-- SECTION D-->
    <div class="col-6">

    </div>
</div>
