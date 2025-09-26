pipeline {
    agent any

    environment {
        REPORT_DIR = "security-reports"
    }

    stages {
        stage('Prepare Workspace') {
            steps {
                sh "mkdir -p ${REPORT_DIR}"
            }
        }

        stage('SAST - Semgrep') {
            steps {
                sh """
                    semgrep --config auto . --json > ${REPORT_DIR}/semgrep-report.json
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/semgrep-report.json", fingerprint: true
            }
        }

        stage('Dependency Scanning - Trivy (Filesystem)') {
            steps {
                sh """
                    trivy fs --exit-code 1 --severity HIGH,CRITICAL \
                    --format json -o ${REPORT_DIR}/trivy-fs-report.json .
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/trivy-fs-report.json", fingerprint: true
            }
        }

        stage('Secret Scanning - Gitleaks') {
            steps {
                sh """
                    gitleaks detect --source . \
                    --report-path=${REPORT_DIR}/gitleaks-report.json \
                    --report-format=json --exit-code 1
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/gitleaks-report.json", fingerprint: true
            }
        }

        stage('IaC Scanning - Checkov') {
            when {
                anyOf {
                    expression { fileExists('terraform') }
                    expression { fileExists('kubernetes') }
                }
            }
            steps {
                sh """
                    checkov -d . -o json > ${REPORT_DIR}/checkov-report.json
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/checkov-report.json", fingerprint: true
            }
        }

        stage('Reporting Summary') {
            steps {
                echo "✅ All scans completed. Reports are stored in: ${REPORT_DIR}"
                echo "📂 Check Jenkins artifacts tab for detailed JSON reports."
            }
        }
    }

    post {
        failure {
            emailext (
                to: "shilpigoyal7129@gmail.com",
                subject: "🚨 Jenkins Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
                body: """
Hello Shilpi,

The Jenkins build *${env.JOB_NAME}* (#${env.BUILD_NUMBER}) has **FAILED** due to security scan issues.

🔎 Reports are available here:
- Semgrep: ${env.BUILD_URL}artifact/${REPORT_DIR}/semgrep-report.json
- Trivy FS: ${env.BUILD_URL}artifact/${REPORT_DIR}/trivy-fs-report.json
- Gitleaks: ${env.BUILD_URL}artifact/${REPORT_DIR}/gitleaks-report.json
- Checkov: ${env.BUILD_URL}artifact/${REPORT_DIR}/checkov-report.json

🔗 Build Details: ${env.BUILD_URL}

Best Regards,  
🔐 Jenkins DevSecOps Pipeline
"""
            )
        }
        success {
            emailext (
                to: "shilpigoyal7129@gmail.com",
                subject: "✅ Jenkins Build PASSED: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
                body: """
Hello Shilpi,

Good news! The Jenkins build *${env.JOB_NAME}* (#${env.BUILD_NUMBER}) has **PASSED** with no HIGH/CRITICAL issues.

📂 Reports are available here:
- Semgrep: ${env.BUILD_URL}artifact/${REPORT_DIR}/semgrep-report.json
- Trivy FS: ${env.BUILD_URL}artifact/${REPORT_DIR}/trivy-fs-report.json
- Gitleaks: ${env.BUILD_URL}artifact/${REPORT_DIR}/gitleaks-report.json
- Checkov: ${env.BUILD_URL}artifact/${REPORT_DIR}/checkov-report.json

🔗 Build Details: ${env.BUILD_URL}

Regards,  
🔐 Jenkins DevSecOps Pipeline
"""
            )
        }
    }
}
