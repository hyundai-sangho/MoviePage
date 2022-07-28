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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
      integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    #imageBox {
      position: relative;
      display: flex;
      flex-wrap: nowrap;
      flex-direction: row;
      /*수평 정렬*/
      align-items: center;
      justify-content: center;
      margin-top: 3%;
      margin-left: 3%;
    }

    i {
      cursor: pointer;
    }
    </style>

  </head>

  <body>
    <div style="margin:0 auto; width: 200px;">
      <a href="http://localhost:8111/"><i class="fa fa-arrow-left" aria-hidden="true"> 뒤로 가기</i></a>
    </div>

    <div id="imageBox">

    </div>
    <script>
    let imageBox = document.querySelector('#imageBox')
    let MovieName = '<?php echo $MovieName ?>'

    let div1 = document.createElement('div');
    let div2 = document.createElement('div');
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

        let original_title = 결과.results[0].original_title
        let overview = 결과.results[0].overview
        let release_date = 결과.results[0].release_date
        let title = 결과.results[0].title
        let vote_average = 결과.results[0].vote_average

        img.src = `https://image.tmdb.org/t/p/w500/${결과.results[0].poster_path}`;
        img.style = 'max-width: 400px'

        imageBox.appendChild(div1);
        imageBox.appendChild(div2);
        div1.appendChild(img)

        div2.style = "margin: 0 20px 0 20px; width: 40%; position: relative; top: -150px;"

        div2.innerHTML = `
        <h3><span style="color:orange">제목:</span> ${title}</h3>
        <h3><span style="color:orange">개요:</span> ${overview}</h3>
        <h3><span style="color:orange">출시일:</span> ${release_date}</h3>
        <h3><span style="color:orange">평점:</span> ${vote_average}</h3>
        `
      })
    }
    </script>
  </body>

</html>