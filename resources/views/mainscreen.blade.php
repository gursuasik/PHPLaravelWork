<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        


<?php
	class Agri extends Eloquent{
		protected $table='Agri';//Database table settings
	}

	$filename='agri.txt';
	if (File::exists($filename))
	{
		$contents = File::get($filename);//Read the file
		$contents = str_replace("\n", '  ', $contents);//Remove enter
		$contents = str_replace("  ", ',', $contents);//Replace comma instead of two space
		$arr = explode(",", $contents);//Virgüle göre array oluşturulur
		$arr = array_diff($arr, [""]);//Array içerisinde ki boşluklar atılır
		$arr = array_map('trim',$arr);//Delete spaces
		array_splice($arr, 0, 5);//Başlı isimleri kaldırılır
		$list = array(
		  array(),
		  array(),
		  array(),
		  array(),
		  array()
		);
		for($i=0; $i<count($arr); $i++){
			array_push($list[$i % 5], $arr[$i]);//Arrayde ki sütunlar ayrılır
		}
		for($i=0; $i<count($list[0]); $i++){
			if(trim($list[1][$i])=="HAMUR")//İlçe array i Hamur'a eşit olanlar ekrana yazılır
			echo $list[1][$i]."\t".$list[3][$i]."<br>";
		}
	}
	for($i=0; $i<count($list[0]); $i++){//Record to database
		$saveAgri=new Agri();
		$saveAgri->IL=$list[0][$i];
		$saveAgri->ILCE=$list[1][$i];
		$saveAgri->SEMT=$list[2][$i];
		$saveAgri->MAHALLE=$list[3][$i];
		$saveAgri->PK=$list[4][$i];
		$saveAgri->save();
	}
	echo "Record to database...";
?>

    </body>
</html>
