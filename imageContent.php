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
      max-width: 1000px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px 20px;
      margin: 20px auto;
    }

    i {
      cursor: pointer;
    }

    img {
      width: 100%;
      border-radius: 15px;
      object-fit: auto;
      cursor: pointer;
    }

    .liveReply {
      width: 50%;
      margin: 0 auto;
    }

    @media (max-width: 1800px) {
      .liveReply {
        width: 55%;
        margin: 0 auto;
      }
    }

    @media (max-width: 1500px) {
      .liveReply {
        width: 65%;
        margin: 0 auto;
      }
    }

    @media (max-width: 1200px) {
      .liveReply {
        width: 75%;
        margin: 0 auto;
      }
    }

    @media (max-width: 900px) {
      .liveReply {
        width: 85%;
        margin: 0 auto;
      }
    }


    @media (max-width: 600px) {
      .liveReply {
        width: 95%;
        margin: 0 auto;
      }
    }
    </style>

  </head>

  <body>

    <div style="margin:0 auto; width: 200px;">
      <a href="javascript:history.back();"><i class=" fa fa-arrow-left" aria-hidden="true"> 뒤로 가기</i></a>
    </div>

    <div id="imageBox">

    </div>

    <!-- 라이브리 시티 설치 코드 -->
    <div id="lv-container" data-id="city" data-uid="MTAyMC81NDE4Ni8zMDY1OA==" class="liveReply">
      <script type="text/javascript">
      // livereOptions에 refer 값을 따로 설정하지 않으면 영화 검색 페이지에서 선택한 영화가
      // 모두 같은 imageContent.php 사이트에 보여지기 때문에 

      // 라이브리 댓글을 작성하면 모든 영화 페이지에서 다른 영화 페이지에서 작성한 댓글도 같이 나오므로
      // 꼭 페이지를 구분 지을 수 있는 refer값을 설정해야만 
      // 해당 영화에 대한 댓글을 따로 볼 수 있다.
      window.livereOptions = {
        refer: '<?php echo $_GET['movie_name'] ?>'
      };

      (function(d, s) {
        var j, e = d.getElementsByTagName(s)[0];

        if (typeof LivereTower === 'function') {
          return;
        }

        j = d.createElement(s);
        j.src = 'https://cdn-city.livere.com/js/embed.dist.js';
        j.async = true;

        e.parentNode.insertBefore(j, e);
      })(document, 'script');
      </script>
      <noscript>라이브리 댓글 작성을 위해 JavaScript를 활성화 해주세요</noscript>
    </div>
    <!-- 시티 설치 코드 끝 -->

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
        // img.style = 'max-width: 400px'

        imageBox.appendChild(div1);
        imageBox.appendChild(div2);
        div1.appendChild(img)

        // div2.style = "margin: -300px 0 0 20px; width: 40%;"

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