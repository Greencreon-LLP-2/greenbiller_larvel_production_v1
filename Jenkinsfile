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
                anyOf {
                    expression { fileExists('terraform') }
                    expression { fileExists('kubernetes') }
                }
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
                echo "📂 Check Jenkins artifacts tab for detailed JSON reports."
            }
        }
    }

    post {
        failure {
            emailext (
                to: "shilpigoyal7129@gmail.com",
                subject: "🚨 Jenkins Build Failed: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
                body: """
Hello Shilpi,

The Jenkins build *${env.JOB_NAME}* (#${env.BUILD_NUMBER}) has **FAILED** due to security scan issues.

🔎 You can review the reports here:
${env.BUILD_URL}artifact/${REPORT_DIR}/

Best Regards,  
🔐 Jenkins DevSecOps Pipeline
"""
            )
        }
        success {
            emailext (
                to: "shilpigoyal7129@gmail.com",
                subject: "✅ Jenkins Build Passed: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
                body: """
Hello Shilpi,

Good news! The Jenkins build *${env.JOB_NAME}* (#${env.BUILD_NUMBER}) has **PASSED**.

📂 Reports are available here:
${env.BUILD_URL}artifact/${REPORT_DIR}/

Regards,  
🔐 Jenkins DevSecOps Pipeline
"""
            )
        }
    }
}
