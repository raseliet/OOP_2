<?php //

require '../bootloader.php';

/**
 * Gėrimo objektas 1
 */
$drink_1 = new App\Drinks\Drink([
    'name' => 'Cola',
    'amount_ml' => 500,
    'abarot' => 0,
    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTz4qbe6qVW2OiyWY72D0MutT2B2rpd8y1VKsPPiLtu5QsChBD2'
        ]);

/**
 * Gėrimo objektas 2
 */
$drink_2 = new App\Drinks\Drink([
    'name' => 'Wisky coctails',
    'amount_ml' => 500,
    'abarot' => 11,
    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSCNQ0NQJxBWIsw6KGVBL5Emq15iz8HWMYwXzYMxjYvs5Ck9Lxk'
        ]);

/**
 * Gėrimo objektas 3
 */
$drink_3 = new App\Drinks\Drink([
    'name' => 'Spicy dark coctail',
    'amount_ml' => 500,
    'abarot' => 6,
    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRZorVQ3bqtPXk6rfsbpQX2SDMqlRpS3FLLT1eCzjPtzUfFYFw9'
        ]);

/**
 * Gėrimo objektas 4
 */
$drink_4 = new App\Drinks\Drink([
    'name' => 'Carlsberg',
    'amount_ml' => 750,
    'abarot' => 5,
    'image' => 'https://www.carlsbergwedelivermore.co.uk/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/u/n/unfiltered_pint_glass.png'
        ]);


/**
 * Isirašom gėrimus į duomenų bazę
 * (Įrašius vieną kartą 'insert' eilutes užkomentuoti)
 */
$modelDrinks = new App\Drinks\Model(); // Sukuriamas modelio objektas
$modelDrinks->insert($drink_1); // Į db įrašomas pirmas gėrimas
$modelDrinks->insert($drink_2); // Į db įrašomas antras gėrimas
$modelDrinks->insert($drink_3); // Į db įrašomas trečias gėrimas
$modelDrinks->insert($drink_4); // Į db įrašomas ketvirtas gėrimas

/**
 * Paupdate'inam Wisky coctails butelį
 */
$drinks = $modelDrinks->get(['name' => 'Wisky coctails']); // Grąžina objektų masyvą
$my_drink = $drinks[0]; // Pasirenkam mum reikiamą
$my_drink->setAmount(500); // Pakeičiam jo informaciją
$modelDrinks->update($my_drink); // Panaudojam update metodą
/**
 * Pasižiūrim kas įrašyta duomenų bazėj
 * (Duomenys pasimato tik po puslapio refresh'o)
 */
$db = new Core\FileDB(DB_FILE); // Užkraunama duomenų bazė
$my_data = $db->getData(); // Duomenų masyvas įkeliamas į variable'ą
var_dump($my_data); // dump'inam viską į ekraną
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .image {
                size: 55px;
                margin: auto;
            }
            .container {
                width: 200px;
                height: 400px;
                display: inline-block;
                margin-right: 5px;
                align-items: center;
            }

        </style>

    </head>
    <body>

        <h1 align="center">Drink catalogue</h1>

<?php foreach ($my_data['drinks'] as $drinks => $drink): ?>
            <div class='container'>

                <img src=<?php print $drink['image']; ?>>
                <h2 align="center"><?php print $drink['name']; ?></h2>
                <h3 align="center"><?php print $drink['amount_ml'] . ' ml'; ?><?php print ', ' . $drink['abarot'] . ' °'; ?></h3>

            </div>
<?php endforeach; ?>

    </body>
</html>


