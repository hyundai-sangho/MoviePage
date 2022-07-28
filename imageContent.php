<?php

$MovieName = $_GET['movie_name'];

?>

<!DOCTYPE html>
<html lang="ko">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $MovieName ?></title>
  </head>

  <body>
    <div class="container">
      <div id="imageBox">

      </div>
    </div>
    <script>
    let imageBox = document.querySelector('#imageBox')
    let MovieName = '<?php echo $MovieName ?>'

    let div = document.createElement('div');
    let img = document.createElement('img');

    getMovieApi()

    async function getMovieApi() {
      await fetch(
        `https://api.themoviedb.org/3/search/movie?api_key=1c17a20b7447589ceae416940a866a8f&query=${MovieName}&language=ko-KR`
      ).then(function(받은값) {
        return 받은값.json();
      }).then(function(결과) {
        console.log(결과.results)
        console.log(결과.results[0].poster_path)

        img.src = `https://image.tmdb.org/t/p/w500/${결과.results[0].poster_path}`;

        imageBox.appendChild(div);
        div.appendChild(img)
      })
    }
    </script>
  </body>

</html>