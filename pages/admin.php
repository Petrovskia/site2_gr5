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
            $sel = "SELECT cities.city FROM cities WHERE cities.countryid = '$countryid' AND cities.city = '$city'";
            $res = mysqli_query($link, $sel);
            if(!$res->num_rows) mysqli_query($link, "INSERT INTO cities(city, countryid) VALUES ('$city', '$countryid')");
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

        $res = mysqli_query($link, 'SELECT hotel, stars, cost FROM hotels');
        // вывод отелей
        echo '<table class="table table-striped">';
        echo '<tr><th>Имя</th><th>Звезды</th><th>Цена</th></tr>';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo '<tr>';
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo '</tr>';
        }
        echo '</table>';

        $sel = 'SELECT ci.id, ci.city, co.country, co.id FROM countries co, cities ci WHERE co.id = ci.countryid';
        $res = mysqli_query($link, $sel);
        $co_id = []; // ассоциативный массив, который мы будем использовать для хранения id страны, у выбранного города
        echo '<select name="hcity" class="w-100 mb-2">';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1] | $row[2]</option>";
            $co_id[$row[0]] = $row[3]; // присваиваеваем в качестве ключа id города, а в качестве значения id страны
        }
        echo '</select>';

        echo '<input type="text" class="w-50" name="hotel" placeholder="Название отеля" required>';
        echo '<input type="text" class="w-25" name="cost" placeholder="Цена за сутки" required pattern="[0-9]{0,7}">';
        echo '<input type="number" class="w-25" name="stars" min="1" max="5" placeholder="Кол-во звезд" required>';
        echo '<textarea name="info" class="w-100" rows="5" placeholder="Описание отеля" required></textarea>';
        echo '<input type="submit" name="addhotel" value="Добавить" class="btn btn-sm btn-info">';
        echo '<input type="submit" name="delhotel" value="Удалить" class="btn btn-sm btn-warning">';
        echo '</form>';

        // добавление отеля
        if(isset($_POST['addhotel'])) {
            $hotel = trim(htmlspecialchars($_POST['hotel']));
            $cost = intval(trim(htmlspecialchars($_POST['cost']))); // intval() - преобразует в число
            $stars = intval(trim(htmlspecialchars($_POST['stars'])));
            $info = trim(htmlspecialchars($_POST['info']));
            if(!$hotel || !$cost|| !$info || !$stars) {
                exit;
            }
            $cityid = $_POST['hcity'];
            $countryid = $co_id[$cityid]; // получаем данные по ключу(id города). данные -> id(страны)

            $ins = "INSERT INTO hotels(hotel, cityid, countryid, stars, cost, info) VALUES ('$hotel', '$cityid', '$countryid', '$stars', '$cost', '$info')";
            mysqli_query($link, $ins);

            if(mysqli_error($link)) {
                echo "Error text" . mysqli_error($link);
                exit;
            }
            echo '<script>window.location=document.URL</script>';
        }
        ?>
    </div>

    <!-- SECTION D - hotel images-->
    <div class="col-6">
        <?php
        echo '<form action="index.php?page=4" method="post" enctype="multipart/form-data" class="input-group mt-5">';

        $sel = "SELECT ho.id, co.country, ci.city, ho.hotel FROM countries co, cities ci, hotels ho WHERE ho.cityid = ci.id AND ho.countryid = co.id";
        $res = mysqli_query($link, $sel);
        echo '<select name="hotelid">';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1] | $row[2] | $row[3]</option>";
        }
        echo '</select>';
        mysqli_free_result($res); // очищает выборку данных

        echo '<input type="file" name="file[]" multiple accept="image/*">';
        echo '<input type="submit" name="addimage" value="Добавить" class="btn btn-sm btn-info">';
        echo '</form>';

        if(isset($_POST['addimage'])) {
            $hotelid = $_POST['hotelid'];
            foreach ($_FILES['file']['name'] as $k => $v) {
                if($_FILES['file']['error'][$k] !== 0) {
                    echo '<script>alert("Upload file error"'.$v.')</script>';
                    continue; // при ошибке пропустить код ниже (move_uploaded_file)
                    // подумать, может ли быть прерывание!
                }
                if(move_uploaded_file($_FILES['file']['tmp_name'][$k], 'images/'.$v)) {
                    $ins = "INSERT INTO images(imagepath, hotelid) VALUES('images/$v', '$hotelid')";
                    mysqli_query($link, $ins);
                }

            }
        }
        ?>

    </div>
</div>
