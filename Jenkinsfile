pipeline {
    agent any

    environment {
        REPORT_DIR = "security-reports"
        IMAGE_NAME = "greenbiller_app"
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
                    trivy fs --exit-code 0 --severity HIGH,CRITICAL --format json -o ${REPORT_DIR}/trivy-fs-report.json . || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/trivy-fs-report.json", fingerprint: true
            }
        }

        stage('Secret Scanning - Gitleaks') {
            steps {
                sh """
                    gitleaks detect --source . --report-path=${REPORT_DIR}/gitleaks-report.json --report-format=json || true
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
                    docker build -t ${IMAGE_NAME}:${BUILD_ID} . || true
                    trivy image --exit-code 0 --severity HIGH,CRITICAL --format json -o ${REPORT_DIR}/trivy-image-report.json ${IMAGE_NAME}:${BUILD_ID} || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/trivy-image-report.json", fingerprint: true
            }
        }

        stage('IaC Scanning - Checkov') {
            when {
                expression { fileExists('terraform') || fileExists('kubernetes') }
            }
            steps {
                sh """
                    checkov -d . -o json > ${REPORT_DIR}/checkov-report.json || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/checkov-report.json", fingerprint: true
            }
        }

        stage('Reporting Summary') {
            steps {
                echo "✅ All scans completed. Reports are stored in: ${REPORT_DIR}"
                echo "Review JSON reports in Jenkins artifacts for detailed findings."
            }
        }
    }
}
