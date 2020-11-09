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
                echo "<td><input type='checkbox' name='cb$row[0]'></td>";
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
            echo '<script>window.location=document.URL</script>';
        }

        // обработчик удаление выбранных стран
        if(isset($_POST['delcountry'])) {
//            var_dump($_POST);
            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) === 'cb') {
                    $number = substr($k, 2); // получаем значение от cbN, т.е. 2, 3, 5...
                    $del = "DELETE FROM countries WHERE id=$number";
                    mysqli_query($link, $del);
                }
            }
            echo '<script>window.location=document.URL</script>';
        }
        ?>
    </div>

    <!-- SECTION B создание города, удаление и отображение в таблице-->
    <div class="col-6">
        <?php
        $res = mysqli_query($link, '
                    SELECT cities.id, cities.city, countries.country 
                    FROM cities, countries 
                    WHERE cities.countryid = countries.id
        ');
        echo '<form action="index.php?page=4" method="post" class="input-group" id="formcountry">';
        // вывод городов
        echo '<table class="table table-striped">';

        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo '<tr>';
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo "<td><input type='checkbox' name='cbc$row[0]'></td>";
            echo '</tr>';
        }
        echo '</table>';

        $res = mysqli_query($link, "SELECT * FROM countries");
        // добавление города
        echo '<select name="countryname">';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
        echo '</select>';

        echo '<input type="text" name="city" placeholder="Город">';
        echo '<input type="submit" name="addcity" value="Добавить" class="btn btn-sm btn-info">';
        echo '<input type="submit" name="delcity" value="Удалить" class="btn btn-sm btn-warning">';
        echo '</form>';

        // обработчик добавления города
        if(isset($_POST['addcity'])) {
            $city = trim(htmlspecialchars($_POST['city']));
            $countryid = $_POST['countryname'];
            if($city === '') exit;
//            $sel = "SELECT cities.city FROM countries, cities WHERE countries.id = $countryid AND cities.city = $city";
//            $res = mysqli_query($link, $sel);
//            var_dump($res);
//            $checkcountry = 0;
            mysqli_query($link, "INSERT INTO cities(city, countryid) VALUES ('$city', '$countryid')");
            echo '<script>window.location=document.URL</script>';
        }

        // обработчик удаление выбранных городов
        if(isset($_POST['delcity'])) {
            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 3) === 'cbc') {
                    $number = substr($k, 3); // получаем значение от cbcN, т.е. 2, 3, 5...
                    $del = "DELETE FROM cities WHERE id=$number";
                    mysqli_query($link, $del);
                }
            }
            echo '<script>window.location=document.URL</script>';
        }
        ?>
    </div>
</div>

<div class="row">
    <!-- SECTION C - отели-->
    <div class="col-6">
        <?php
        echo '<form action="index.php?page=4" method="post" class="input-group mt-5">';

        echo '<input type="text" class="w-50" name="hotel" placeholder="Название отеля">';
        echo '<input type="text" class="w-25" name="cost" placeholder="Цена за сутки">';
        echo '<input type="number" class="w-25" name="stars" min="1" max="5" placeholder="Кол-во звезд">';
        echo '<textarea name="info" class="w-100" rows="5" placeholder="Описание отеля"></textarea>';
        echo '<input type="submit" name="addhotel" value="Добавить" class="btn btn-sm btn-info">';
        echo '<input type="submit" name="delhotel" value="Удалить" class="btn btn-sm btn-warning">';
        echo '</form>';
        ?>
    </div>

    <!-- SECTION D-->
    <div class="col-6">

    </div>
</div>
