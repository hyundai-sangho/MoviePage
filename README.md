1. TMDB MOVIE API를 이용해서 영화 데이터를 fetch로 받아와서
화면에 뿌려주는 아주 간단한 페이지

+ 추가 = 검색한 영화 클릭시 상세 정보 페이지 
+ 추가 = 라이브리 소셜 댓글 기능 달기
+ 추가 예정 = 로그인 기능

2. http://teha007.dothome.co.kr/movie/

3. 깃허브 페이지스(정적 페이지 호스팅) 이용하다 php 페이지 추가 후 서버단이 필요하므로
-> 닷홈 무료 웹 호스팅 사용으로 변경(Composer 실행 문제로 닷홈 무료 웹 호스팅 대신에)
-> Aws Free Tier EC2 우분투 서버에 직접 설치 후 실행

4. MoviePage 폴더 다운로드 후 실행시 composer install 실행
composer install 실행해야지 .gitignore에서 제거했던 vendor 파일들 설치 가능