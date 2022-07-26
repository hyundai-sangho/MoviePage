<!DOCTYPE html>
<html lang="ko">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>
    #img {
      width: 300px;
      height: 200px;
      border-radius: 15px;
      cursor: pointer;
      margin-bottom: 2px;
    }

    #imageBox {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      margin-top: 100px;
    }

    #title {
      display: block;
      padding-top: 10px;
    }

    @media (max-width: 600px) {
      #tmdbLogo {
        display: none;
      }
    }
    </style>
  </head>

  <body>
    <nav class="navbar bg-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" id="tmdbLogo"><span
            style="color:orange; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            TMDB
          </span>
          영화 검색</a>
        <form class="d-flex" role="search" onsubmit="return false" style="margin-top:10px">
          <input class="form-control m-2" type="search" placeholder="영화" aria-label="Search" id="searchText">
          <button class="btn btn-success m-2" type="submit" id="getMovie" style="word-break: keep-all;">검색</button>
          <button class="btn btn-danger m-2" type="submit" id="register" style="word-break: keep-all;">회원가입</button>
          <button class="btn btn-primary m-2" type="submit" id="login" style="word-break: keep-all;">로그인</button>
        </form>
      </div>
    </nav>

    <div id="imageBox"></div>
    <script>
    let imageBox = document.querySelector('#imageBox')
    let inputValue = document.querySelector('#searchText')
    let getMovieButton = document.querySelector('#getMovie')
    let registerButton = document.querySelector('#register')
    let loginButton = document.querySelector('#login')

    loginButton.addEventListener('click', () => {
      location.href = 'login.php'
    })

    registerButton.addEventListener('click', () => {
      location.href = 'register.php'
    })

    inputValue.addEventListener('keypress', (event) => {
      if (event.keyCode == 13 && inputValue.value != '') {
        getMovieApi(inputValue.value.trim())
        inputValue.value = ''
      }
    })

    getMovieButton.addEventListener('click', (event) => {
      if (inputValue.value != '') {
        getMovieApi(inputValue.value.trim())
        inputValue.value = ''
      }
    })

    async function getMovieApi(inputValue) {
      await fetch(
        `https://api.themoviedb.org/3/search/movie?api_key=1c17a20b7447589ceae416940a866a8f&query=${inputValue}&language=ko-KR`
      ).then(function(받은값) {
        return 받은값.json();
      }).then(function(결과) {
        console.log(결과.results)
        console.log(결과.results.length)

        if (document.querySelector('#img')) imageBox.innerHTML = ''

        for (let i = 0; i < 결과.results.length; i++) {

          let img = document.createElement('img');
          let div = document.createElement('div');
          let aTag = document.createElement('a');
          let title = document.createElement('span');

          title.id = 'title'

          // TMDB movie api에서 받아온 데이터 안에 배경화면 이미지가 주소가 없는 경우는 no Image로 화면 출력
          if (결과.results[i].backdrop_path == null) {
            img.src = './noImage.png'
            img.id = 'img'

            div.style = "margin:10px auto;"
            aTag.href = `imageContent.php?movie_name=${결과.results[i].title}`
            imageBox.appendChild(div);
            div.appendChild(aTag);
            aTag.appendChild(img);

            if (결과.results[i].title.length > 20) {
              title.innerText = 결과.results[i].title.substring(0, 20) + '...';
            } else {
              title.innerText = 결과.results[i].title;
            }

            // title.innerText = 결과.results[i].title;
            div.appendChild(title);
          } else {
            img.src = `https://image.tmdb.org/t/p/original/${결과.results[i].backdrop_path}`
            img.id = 'img'

            div.style = "margin:10px auto;"
            aTag.href = `imageContent.php?movie_name=${결과.results[i].title}`
            imageBox.appendChild(div);
            div.appendChild(aTag);
            aTag.appendChild(img);

            // 영화 제목이 20자를 넘어가면 잘라서 출력
            if (결과.results[i].title.length > 20) {
              title.innerText = 결과.results[i].title.substring(0, 20) + '...';
            } else {
              title.innerText = 결과.results[i].title;
            }
            // title.innerText = 결과.results[i].title;
            div.appendChild(title);
          }
        }
      });
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
      integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
      integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
  </body>

</html>