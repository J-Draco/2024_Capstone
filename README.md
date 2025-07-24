# CodeXGuard

## 프로젝트 소개

CodeXGuard는 웹 보안 취약점을 학습하고 실습할 수 있는 교육용 플랫폼입니다. 사용자들이 안전한 환경에서 실제 웹 보안 취약점을 경험하고 이해함으로써 보안 의식을 높이고 개발 과정에서 보안을 고려할 수 있도록 설계되었습니다. 이 플랫폼은 실제 취약점 공격과 방어 기법을 직접 체험하며 학습할 수 있는 환경을 제공합니다.

- [CodeXGuard 발표 자료 (PDF)](./2024_CapStone.pdf)

## 주요 기능

### 사용자 관리 시스템

- **회원가입**: 아이디 중복 확인, 비밀번호 해싱 처리
- **로그인/로그아웃**: 세션 기반 인증, 타임아웃 관리
- **세션 관리**: 안전한 세션 저장 및 만료 처리

### 보안 취약점 학습 및 실습

- **SQL Injection**: 데이터베이스 공격 방지 기법 학습
- **XSS(Cross-Site Scripting)**: 악성 스크립트 삽입 공격 방어 학습
- **CSRF(Cross-Site Request Forgery)**: 사용자 의도와 무관한 요청 방어 학습
- **실습 환경**: 각 취약점을 안전하게 테스트할 수 있는 격리된 환경

### JWT 기반 인증 시스템

- **토큰 생성**: RSA 암호화를 통한 안전한 토큰 생성
- **토큰 검증**: 서명 검증을 통한 무결성 확인
- **공개키/개인키 암호화**: 비대칭 암호화 방식 적용

### 게시판 시스템

- **카테고리별 게시판**: 주제별로 분류된 게시판
- **글 작성/조회**: 사용자 게시글 관리
- **페이지네이션**: 효율적인 게시글 목록 표시
- **파일 업로드**: 이미지 등 파일 첨부 기능

### 점수 관리 시스템

- **문제 해결 점수**: 보안 문제 해결 시 점수 부여
- **사용자별 랭킹**: 획득 점수에 따른 사용자 순위 표시

## 기술 스택

### 백엔드

- **PHP**: 서버 사이드 로직 구현
- **MySQL**: 데이터베이스 관리

### 프론트엔드

- **HTML/CSS**: 웹 페이지 구조 및 스타일링
- **JavaScript**: 클라이언트 사이드 기능 구현
- **Bootstrap**: 반응형 UI 컴포넌트

### 보안 기술

- **JWT(JSON Web Tokens)**: 토큰 기반 인증
- **RSA 암호화**: 공개키/개인키 기반 암호화
- **비밀번호 해싱**: 안전한 비밀번호 저장
- **Prepared Statements**: SQL Injection 방지

### 아키텍처

- **MVC 패턴**: 모델-뷰-컨트롤러 구조로 코드 분리
- **RESTful API**: 리소스 기반 API 설계

## 설치 및 실행 방법

### 요구사항

- PHP 7.4 이상
- MySQL 5.7 이상
- Apache 또는 Nginx 웹 서버

### 설치 과정

1. 저장소 클론

```bash
git clone https://github.com/사용자명/CodeXGuard.git
cd CodeXGuard
```

2. 설정 파일 생성

```bash
# 설정 예제 파일을 복사하여 실제 설정 파일 생성
cp src/app/config/example/database.example.php src/app/config/database.php
```

3. 데이터베이스 설정

- `src/app/config/database.php` 파일에서 데이터베이스 연결 정보 수정:

```php
define('DB_HOST', '데이터베이스_호스트');
define('DB_USER', '데이터베이스_사용자');
define('DB_PASS', '데이터베이스_비밀번호');
define('DB_NAME', '데이터베이스_이름');
define('DB_PORT', 3306);
```

4. RSA 키 생성

```bash
# 개인키 생성
openssl genrsa -out src/app/config/private_key1.pem 2048
# 공개키 생성
openssl rsa -in src/app/config/private_key1.pem -pubout -out src/app/config/public_key.pem
```

5. 데이터베이스 테이블 생성

- 다음 테이블들을 생성해야 합니다:
  - `user_info`: 사용자 계정 정보
  - `sessions`: 세션 관리
  - `board`: 게시판 글
  - `user_scores`: 사용자 점수 관리

6. 웹 서버 설정

- 웹 서버의 문서 루트를 프로젝트 루트 디렉토리로 설정
- URL 재작성 규칙 설정 (필요한 경우)

7. 권한 설정

```bash
# uploads 디렉토리에 쓰기 권한 부여
chmod -R 755 src/uploads
```

8. 웹 브라우저에서 접속

- 웹 브라우저에서 설정한 서버 주소로 접속

## 프로젝트 구조

```
CodeXGuard/
├── index.php                      # 메인 진입점, 라우팅 담당
├── src/                           # 소스 코드 루트 디렉토리
│   ├── app/                       # 애플리케이션 코드
│   │   ├── config/                # 설정 파일 (DB 연결 정보, 보안 키 등)
│   │   │   └── example/           # 설정 파일 예제 및 가이드
│   │   ├── controllers/           # 컨트롤러 (사용자 인증, 게시판 등 처리)
│   │   │   └── UserController.php # 사용자 관련 컨트롤러
│   │   ├── models/                # 모델 (DB 연결, JWT 토큰 처리 등)
│   │   │   └── UserModel.php      # 사용자 관련 모델
│   │   └── views/                 # 뷰 템플릿 (사용자 인터페이스)
│   │       ├── main.php           # 메인 페이지
│   │       ├── nav.php            # 네비게이션 바
│   │       ├── footer.php         # 푸터
│   │       ├── login.php          # 로그인 페이지
│   │       ├── loginpage.php      # 로그인 페이지 템플릿
│   │       ├── signup.php         # 회원가입 페이지
│   │       ├── board.php          # 게시판 목록
│   │       ├── write.php          # 게시글 작성
│   │       └── read.php           # 게시글 조회
│   ├── public/                    # 정적 파일
│   │   ├── css/                   # CSS 파일
│   │   ├── js/                    # JavaScript 파일
│   │   └── resources/             # 이미지 등 리소스
│   └── uploads/                   # 사용자 업로드 파일
│       └── .gitkeep               # 빈 디렉토리 유지용 파일
└── README.md                      # 프로젝트 설명
```

## 파일별 주요 기능

### 핵심 파일

- **index.php**: 메인 진입점으로 모든 요청을 처리하고 적절한 컨트롤러로 라우팅합니다.
- **UserController.php**: 사용자 인증, 세션 관리, 게시판 기능, 보안 문제 풀이 등을 처리합니다.
- **UserModel.php**: 데이터베이스 연결, JWT 토큰 처리, 사용자 인증, 게시판 데이터 관리 등을 담당합니다.

### 뷰 파일

- **main.php**: 사이트 메인 페이지로 주요 기능 소개 및 사용자 상태에 따른 콘텐츠를 표시합니다.
- **nav.php**: 네비게이션 바로 사이트 메뉴와 로그인 상태에 따른 기능을 제공합니다.
- **board.php**: 게시판 목록을 표시하고 카테고리별 필터링 및 페이지네이션을 지원합니다.
- **write.php**: 게시글 작성 기능을 제공하며 이미지 업로드를 지원합니다.
- **read.php**: 게시글 상세 내용을 표시하고 권한에 따른 수정/삭제 기능을 제공합니다.

## 보안 학습 내용

### SQL Injection

- **취약점 설명**: 사용자 입력을 통해 악의적인 SQL 쿼리를 삽입하는 공격
- **방어 기법**: Prepared Statements 사용, 입력값 검증, 최소 권한 원칙 적용
- **실습 예제**: 로그인 폼, 검색 기능에서의 SQL Injection 테스트

### XSS(Cross-Site Scripting)

- **취약점 설명**: 웹 페이지에 악성 스크립트를 삽입하여 사용자 정보를 탈취하는 공격
- **방어 기법**: 출력 데이터 이스케이프 처리, Content-Security-Policy 설정
- **실습 예제**: 게시판 글 작성에서의 스크립트 삽입 테스트

### CSRF(Cross-Site Request Forgery)

- **취약점 설명**: 사용자의 의도와 무관하게 요청을 전송하는 공격
- **방어 기법**: CSRF 토큰 사용, SameSite 쿠키 설정
- **실습 예제**: 사용자 정보 변경, 게시글 작성에서의 CSRF 방어

### JWT 보안

- **토큰 구조**: Header, Payload, Signature로 구성된 JWT 이해
- **암호화 방식**: RSA 공개키/개인키 암호화 방식 학습
- **실습 예제**: JWT 토큰 생성, 검증, 취약점 테스트

## 교육적 가치

- **실무 적용 가능 기술**: 실제 개발 환경에서 사용되는 보안 기법 학습
- **단계별 학습**: 초보자부터 전문가까지 수준별 학습 가능
- **실습 중심 교육**: 이론과 실습을 병행하여 효과적인 학습 경험 제공
- **보안 의식 향상**: 개발 과정에서 보안을 고려하는 습관 형성
