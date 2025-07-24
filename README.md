# CodeXGuard

## 프로젝트 소개

CodeXGuard는 클라우드 기반의 웹 애플리케이션으로, 웹 보안 테스트와 학습을 위한 혁신적인 플랫폼입니다. 사용자는 다양한 웹 보안 취약점을 직접 경험하고 실습할 수 있으며, 이를 통해 보안에 대한 깊은 이해를 쌓을 수 있습니다. 클라우드 환경을 통해 언제 어디서나 쉽게 접근할 수 있어, 보안 테스트를 보다 효율적으로 수행할 수 있습니다.

## 주요 기능

- **사용자 관리 시스템**: 회원가입, 로그인, 세션 관리
- **보안 취약점 실습**: SQL Injection, XSS, CSRF 등 다양한 웹 취약점 학습
- **게시판 시스템**: 카테고리별 게시글 작성 및 조회
- **JWT 기반 인증**: 공개키/개인키 암호화 방식의 보안 토큰 시스템
- **점수 관리 시스템**: 문제 해결 시 사용자별 점수 기록
- **실시간 보안 취약점 경험**: 안전한 환경에서 실제 취약점 공격 및 방어 체험

## 기술 스택

- **백엔드**: PHP, MySQL
- **프론트엔드**: HTML, CSS, JavaScript, Bootstrap
- **보안 기술**: JWT, RSA 암호화, 비밀번호 해싱
- **아키텍처**: MVC 패턴

## 교육적 가치

- 초보자부터 전문가까지 모두에게 유용한 학습 도구 제공
- 웹 보안의 이론과 실제를 동시에 학습 가능
- 보안 취약점에 대한 인식 제고 및 방어 기법 습득
- 실무에 적용 가능한 보안 지식 함양

## 설치 및 실행 방법

1. 저장소 클론

```
git clone https://github.com/사용자명/2024_Capstone.git
```

2. 웹 서버 설정

- PHP가 설치된 웹 서버(Apache, Nginx 등)에 프로젝트 파일 배포
- MySQL 데이터베이스 설정 (src/app/config/database.php 파일 참조)

3. 데이터베이스 테이블 생성

- user_info, sessions, board, user_scores 테이블 필요

4. 실행

- 웹 브라우저에서 서버 주소로 접속

## 프로젝트 구조

```
2024_Capstone/
├── index.php              # 메인 진입점
├── src/                   # 소스 코드 루트 디렉토리
│   ├── app/               # 애플리케이션 코드
│   │   ├── config/        # 설정 파일
│   │   ├── controllers/   # 컨트롤러
│   │   ├── models/        # 모델
│   │   └── views/         # 뷰 템플릿
│   ├── public/            # 정적 파일
│   │   ├── css/           # CSS 파일
│   │   │   └── vendor/    # 외부 CSS 라이브러리
│   │   ├── js/            # JavaScript 파일
│   │   │   └── vendor/    # 외부 JS 라이브러리
│   │   └── resources/     # 이미지 등 리소스
│   └── uploads/           # 사용자 업로드 파일
└── README.md              # 프로젝트 설명
```

## 보안 학습 내용

- SQL Injection 방어 기법
- XSS(Cross-Site Scripting) 취약점 이해
- CSRF(Cross-Site Request Forgery) 방어
- 안전한 인증 시스템 구현
- 웹 보안 모범 사례 적용

## 프로젝트 발표 자료

- [CodeXGuard 프로젝트 발표 PPT](https://www.miricanvas.com/v/13r5a5q)
