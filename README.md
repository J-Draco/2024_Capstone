# CodeXGuard

## 프로젝트 소개

CodeXGuard는 웹 보안 취약점을 학습하고 실습할 수 있는 교육용 플랫폼입니다. 사용자들이 실제 취약점을 안전한 환경에서 경험하고 이해함으로써 보안 의식을 높이고 개발 과정에서 보안을 고려할 수 있도록 돕습니다.

## 주요 기능

- 사용자 인증 시스템 (회원가입, 로그인, 세션 관리)
- 보안 취약점 학습 및 실습 환경
- JWT(JSON Web Token) 기반 인증 시스템
- 게시판 기능
- 사용자 점수 관리 및 랭킹 시스템

## 기술 스택

- **백엔드**: PHP
- **프론트엔드**: HTML, CSS, JavaScript, Bootstrap
- **데이터베이스**: MySQL
- **보안 기술**: JWT, RSA 암호화(공개키/개인키), 비밀번호 해싱

## 설치 및 실행 방법

1. 저장소를 클론합니다.

```bash
git clone https://github.com/yourusername/CodeXGuard.git
```

2. 필요한 설정 파일을 생성합니다.

   - `src/app/config/example/` 디렉토리의 예제 파일을 참고하여 `src/app/config/` 디렉토리에 설정 파일을 생성합니다.
   - 데이터베이스 연결 정보를 `database.php`에 입력합니다.
   - RSA 키 쌍을 생성하고 적절한 위치에 저장합니다.

3. 웹 서버를 설정하고 실행합니다.
   - 웹 서버의 루트 디렉토리를 프로젝트 폴더로 지정합니다.
   - 브라우저에서 `http://localhost/` 또는 설정한 도메인으로 접속합니다.

## 프로젝트 구조

```
2024_Capstone/
├── index.php              # 메인 진입점 (라우팅 처리)
├── src/                   # 소스 코드 루트 디렉토리
│   ├── app/               # 애플리케이션 코드
│   │   ├── config/        # 설정 파일 (데이터베이스 연결 정보, 보안 키 등)
│   │   │   └── example/   # 설정 파일 예제 및 가이드
│   │   ├── controllers/   # 컨트롤러 (사용자 인증, 게시판 등 처리)
│   │   ├── models/        # 모델 (데이터베이스 연결, JWT 토큰 처리 등)
│   │   └── views/         # 뷰 템플릿 (사용자 인터페이스)
│   ├── public/            # 정적 파일
│   │   ├── css/           # CSS 파일
│   │   ├── js/            # JavaScript 파일
│   │   └── resources/     # 이미지 등 리소스
│   └── uploads/           # 사용자 업로드 파일
└── README.md              # 프로젝트 설명
```

## 파일별 기능 설명

### 핵심 파일

- **index.php**: 메인 웹 진입점, 라우팅 담당

  - 사용자 요청에 따라 컨트롤러 액션 호출
  - 로그인, 로그아웃, 회원가입, 게시판 등 기능 라우팅
  - 세션 타임아웃 체크 기능

- **src/app/controllers/UserController.php**: 사용자 관련 컨트롤러

  - 사용자 인증 및 세션 관리
  - 게시판 기능 처리
  - 보안 문제 풀이 및 채점 기능

- **src/app/models/UserModel.php**: 데이터베이스 상호작용
  - 사용자 인증 및 회원가입 처리
  - JWT 토큰 생성, 암호화, 검증
  - 게시판 데이터 처리
  - 사용자 점수 관리

### 뷰 파일

- **src/app/views/main.php**: 메인 페이지 뷰
- **src/app/views/nav.php**: 네비게이션 바 컴포넌트
- **src/app/views/footer.php**: 푸터 컴포넌트
- **src/app/views/login.php**: 로그인 페이지
- **src/app/views/signup.php**: 회원가입 페이지
- **src/app/views/board.php**: 게시판 목록 페이지
- **src/app/views/write.php**: 게시글 작성 페이지
- **src/app/views/read.php**: 게시글 조회 페이지

## 보안 학습 내용

이 프로젝트에서는 다음과 같은 웹 보안 취약점에 대해 학습하고 실습할 수 있습니다:

1. **SQL 인젝션**: 사용자 입력을 통한 데이터베이스 공격 방지 기법
2. **XSS(Cross-Site Scripting)**: 웹 페이지에 악성 스크립트를 삽입하는 공격 방어 기법
3. **CSRF(Cross-Site Request Forgery)**: 사용자의 의도와 무관하게 요청을 전송하는 공격 방어 기법
4. **인증 및 세션 관리**: 안전한 사용자 인증과 세션 관리 방법
5. **암호화 및 해싱**: 민감한 데이터 보호를 위한 암호화 기법

## 교육적 가치

- 실제 취약점을 안전한 환경에서 경험하며 학습
- 코드 분석을 통한 보안 취약점 이해
- 보안 모범 사례 학습 및 적용
- 웹 개발 과정에서의 보안 의식 향상

## 프로젝트 발표 자료

더 자세한 프로젝트 소개는 다음 링크에서 확인할 수 있습니다:

- [CodeXGuard 발표 자료](https://www.miricanvas.com/v/13r5a5q)
