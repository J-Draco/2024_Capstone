# 설정 파일 안내

이 디렉토리에는 애플리케이션 실행에 필요한 설정 파일 예제가 포함되어 있습니다.
실제 사용 시에는 이 파일들을 상위 디렉토리(`src/app/config/`)에 복사하고 실제 환경에 맞게 수정해야 합니다.

## 필요한 설정 파일

1. **database.php**: 데이터베이스 연결 정보

   - `database.example.php`를 참고하여 생성

2. **private_key1.pem**: RSA 개인 키

   - 다음 명령어로 생성할 수 있습니다:

   ```
   openssl genrsa -out private_key1.pem 2048
   ```

3. **public_key.pem**: RSA 공개 키
   - 다음 명령어로 생성할 수 있습니다:
   ```
   openssl rsa -in private_key1.pem -pubout -out public_key.pem
   ```

## 주의사항

보안을 위해 이러한 설정 파일들은 절대 버전 관리 시스템(Git)에 포함되어서는 안 됩니다.
`.gitignore` 파일에 이러한 파일들이 포함되어 있는지 확인하세요.
