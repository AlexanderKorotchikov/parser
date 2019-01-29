<?php
require_once 'simple_html_dom.php';

function curl_get($url, $referer = 'https://www.google.ru/'){
    $req = curl_init();
    $opt = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_AUTOREFERER => true,
        CURLOPT_REFERER => $referer,
        CURLOPT_USERAGENT => 'Mozilla/0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
    );
    curl_setopt_array($req, $opt);
    $returns = curl_exec($req);
    curl_close($req);
    return $returns;
}

function parseOLX($url)
{
    $dbh = new PDO('mysql:host=localhost;dbname=olx', 'root', '');
    $html = curl_get($url);
    $start = microtime(true);

    $dom = str_get_html($html);
    $count_page = $dom->find('.pager .fleft span');
    $count_all_page = $count_page[count($count_page) - 1]->innertext;
    $i_count_pages = 1;
    $cuont_insert_db = 0;

    while ($i_count_pages != $count_all_page) {

        $html = curl_get($url . "?page=$i_count_pages");
        $dom = str_get_html($html);
        $offers = $dom->find('#offers_table tbody tr.wrap');
        $count_offer = count($offers);
        $i = 0;
        foreach ($offers as $offer) {
            $a = $offer->find('a', 0);
            $html1 = curl_get($a->href);
            $dom1 = str_get_html($html1);
            $offer_i = $dom1->find('.offer-user__details  a.user-offers');
            $names = $dom1->find('.offer-user__details  h4 a');
            $name = $names[0]->innertext;
            $all_product_user = $offer_i[0]->href; // Ссылка на продовца
            if ($all_product_user != '') {
                $needle = '/list/user/';
                $pos = strripos($all_product_user, $needle);
                if ($pos <> '') {
                    $html2 = curl_get($all_product_user);
                    $dom2 = str_get_html($html2);
                    $offers_user = $dom2->find('#offers_table>tbody>tr.wrap'); // count($offers_user) - кол товаров
                    $count_page = $dom2->find('.pager .fleft span');
                    $count_all_page = $count_page[count($count_page) - 1]->innertext;
                    if ($count_all_page != 0) {
                        $count_products = count($offers_user) * $count_all_page;
                    } else {
                        $count_products = count($offers_user);
                    }

                } else {
                    $html2 = curl_get($all_product_user);
                    $dom2 = str_get_html($html2);
                    $offers_user = $dom2->find('.rel>#listContainer>table.offers>tbody>tr>td.offer');
                    $count_page = $dom2->find('.pager .fleft span');
                    $count_all_page = $count_page[count($count_page) - 1]->innertext;
                    if ($count_all_page != 0) {
                        $count_products = count($offers_user) * $count_all_page;
                    } else {
                        $count_products = count($offers_user);
                    }
                    //$phone = $dom2->find('.inner span.block');
                    $phone = '-';
                    $site = '-';
                    //$site = $dom2->find('.inner a');
                }
                //echo $count_products . ' name - '.$name . ' '. $all_product_user . '<br>';
                if ($count_products>=5) {
                    $stmt = $dbh->prepare('SELECT EXISTS(SELECT * FROM customers WHERE customer_url = :customer_url LIMIT 1)');
                    $stmt->bindValue(':customer_url', $all_product_user);
                    $stmt->execute();
                    $count_zap_db = $stmt->fetch(PDO::FETCH_NUM)[0];
                    //echo $count_zap_db . '<br>';
                    if ($count_zap_db == 0) {
                        //insert
                        $stmt = $dbh->prepare('INSERT INTO customers(name_u, customer_url, site, phone, count_products) VALUES(:name_u, :customer_url, :site, :phone, :count_products)');
                        $stmt->bindValue(':name_u', $name);
                        $stmt->bindValue(':customer_url', $all_product_user);
                        $stmt->bindValue(':site', $site);
                        $stmt->bindValue(':phone', $phone);
                        $stmt->bindValue(':count_products', $count_products);
                        $stmt->execute();
                        $cuont_insert_db++;
                    }
                }
            }
            /*$i++;
            if ($i == 10){
                break;
            }*/

        }
        //echo '<br>Записей добавленно в БД: '.$cuont_insert_db . '<br>';
        $time = microtime(true) - $start;
        //echo '<br>Время выполнения скрипта - ' . $time;

        $i_count_pages++;
        if ($i_count_pages == 3){
            $i_count_pages = $count_all_page;
        }
    }
    return $cuont_insert_db;
}

if (isset($_POST["name"])) {

    $cuont_insert_db = parseOLX($_POST["name"]);

    // Формируем массив для JSON ответа
    $result = array(
        '$cuont_insert_db' => $cuont_insert_db,
    );

    // Переводим массив в JSON
    echo json_encode($result);
}
