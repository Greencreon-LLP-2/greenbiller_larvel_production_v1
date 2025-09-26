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
                  semgrep --config auto . --json > ${REPORT_DIR}/semgrep-report.json || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/semgrep-report.json", fingerprint: true
            }
        }

        stage('Dependency Scanning - Trivy (Filesystem)') {
            steps {
                sh """
                  trivy fs --exit-code 0 --severity HIGH,CRITICAL \
                  --format json -o ${REPORT_DIR}/trivy-fs-report.json . || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/trivy-fs-report.json", fingerprint: true
            }
        }

        stage('Secret Scanning - Gitleaks') {
            steps {
                sh """
                  gitleaks detect --source . \
                  --report-path=${REPORT_DIR}/gitleaks-report.json \
                  --report-format=json || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/gitleaks-report.json", fingerprint: true
            }
        }

        stage('Container Scanning - Trivy (Docker Image)') {
            when {
                expression { fileExists('Dockerfile') }
            }
            steps {
                sh """
                  trivy image --exit-code 0 --severity HIGH,CRITICAL \
                  --format json -o ${REPORT_DIR}/trivy-image-report.json myapp:latest || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/trivy-image-report.json", fingerprint: true
            }
        }

        stage('IaC Scanning - Checkov') {
            steps {
                sh """
                  checkov -d . -o json > ${REPORT_DIR}/checkov-report.json || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/checkov-report.json", fingerprint: true
            }
        }

        stage('Reporting Summary') {
            steps {
                script {
                    echo "All reports generated in ${REPORT_DIR}"
                    sh "ls -lh ${REPORT_DIR}"
                }
            }
        }
    }

    post {
        always {
            emailext(
                to: "shilpigoyal7129@gmail.com",
                subject: "DevSecOps Pipeline Report - ${currentBuild.currentResult}",
                body: """Hello Team,<br><br>
                The Jenkins DevSecOps pipeline has completed.<br>
                Status: ${currentBuild.currentResult}<br><br>
                Please find attached reports.<br><br>
                Regards,<br>Jenkins
                """,
                attachmentsPattern: "${REPORT_DIR}/*.json"
            )
        }
    }
}
